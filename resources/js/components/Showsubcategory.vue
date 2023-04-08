<template>
    <div class="page-content">
        <div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Category List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Category List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>
                        <tr v-for="(value,index) in categories" :key="index">
                            <td>{{ value.sub_cat_name }}</td>
                            <td>{{ value.cat_name }}</td>
                            <td>{{ value.sub_cat_slug }}</td>
                            <td>{{ value.sub_cat_des }}</td>
                            <td>61</td>
                            <td>
                                <a @click.prevent="edit(value.id)" type="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit" title="Edit"></i></a> 
                                <a @click.prevent="deleteCategory(value.id)" class="btn btn-danger" href="#" ><i class="fa fa-trash" title="Delete"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

</div>
    </div>
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form>
                            <div class="card-body">
                                <div>
                                    <label class="mb-1">Sub Category Name</label>
                                    <input type="hidden" class="form-control" maxlength="25" v-model="edit_categories_id" id="defaultconfig">
                                    <input type="text" class="form-control" maxlength="25" v-model="edit_categories_name" id="defaultconfig">
                                </div>
                                <div>
                                    <label class="mb-1">Category Name</label>
                                    <input type="hidden" class="form-control" maxlength="25" v-model="edit_categories_id" id="defaultconfig">
                                    <input type="text" class="form-control" maxlength="25" v-model="edit_categories_name" id="defaultconfig">
                                </div>
                                <div class="mt-3">
                                    <label class="mb-1">Sub Category Description</label>
                                    <textarea id="textarea" class="form-control" maxlength="225" rows="3" v-model="edit_categories_des"></textarea>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary btn-sm" data-dismiss="modal" @click.prevent="formSubmit(edit_categories_id)">Submit</button>
                                </div>
                                <div class="mt-3">
                                    <span class="mb-1">{{output}}</span>
                                </div>
                            </div>
                        </form> 
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
</template>
<script>
	export default {
       data(){
         return {
            categories : '',
            edit_categories_name:'',
            edit_categories_des:'',
            output:'',
         }
       },
        mounted:function(){
            this.onload() //method1 will execute at pageload
        },

       methods : {
        onload(){ 
            let currentObj = this;
            axios.get('/return-sub-category')
            .then(function (response) {  
               currentObj.categories = response.data;
            });

        },
        // edit category 
        edit(id){
            let currentObjedit = this;
            axios.get('edit-return-sub-category/'+id)
            .then(function (response) {  
                currentObjedit.edit_sub_categories_id = response.data.id;
                currentObjedit.edit_categories_name = response.data.cat_name;
                currentObjedit.edit_categories_des = response.data.cat_des;
                currentObjedit.output = '';
            });
            // EventBus.$emit('update-category',id);
        },
        // delete category 
        deleteCategory(id){
        let currentObjj = this;
        Swal.fire({
            title: 'Are you sure ?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        },() => {
        }).then((result) => {
            if (result.value) {
                axios.get('sub-category-delete/'+id)
                .then(response => {
                currentObjj.categories = response.data;
                this.onload();
                })
            }
        }) 
       },
        formSubmit(id) {
                let currentObj = this;  
                axios.post('/category-update', { 
                    id:id,
                    cat_name: this.edit_categories_name,  
                    cat_des: this.edit_categories_des
                })  
                .then(response => {  
                    currentObj.output = response.data;
                    this.onload();
                })
            }
       }
	}
</script>