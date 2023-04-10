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
                        <tr v-for="(value,index) in categories2" :key="index">
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
                                    <input type="text" class="form-control" maxlength="25" v-model="sub_cat_name" id="defaultconfig">
                                </div>
                                <div>
                                    <label class="mb-1">Category Name</label>
                                    <input type="hidden" class="form-control" maxlength="25" v-model="edit_categories_id" id="defaultconfig">
                                    <select v-model="cat_id" class="form-control">
                                        <option selected>Choose Category</option>
                                        <option v-for="categories in categories" v-bind:value="categories.id" :selected="categories.id === cat_id" >{{ categories.cat_name }}</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label class="mb-1">Sub Category Description</label>
                                    <textarea id="textarea" class="form-control" maxlength="225" rows="3" v-model="sub_cat_des"></textarea>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary btn-sm" data-dismiss="modal" @click.prevent="formSubmit(sub_cat_id)">Submit</button>
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
            categories2 : '',
            sub_cat_id:'',
            sub_cat_name:'',
            sub_cat_des:'',
            cat_id:'',
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
               currentObj.categories2 = response.data;
            });

        },
        // edit category 
        edit(id){
            let currentObjedit = this;
            axios.get('edit-return-sub-category/'+id)
            .then(function (response) {
                currentObjedit.sub_cat_id = response.data.sub_cat[0].id;
                currentObjedit.cat_id = response.data.sub_cat[0].cat_id;
                currentObjedit.sub_cat_name = response.data.sub_cat[0].sub_cat_name;
                currentObjedit.sub_cat_des = response.data.sub_cat[0].sub_cat_des;
                currentObjedit.categories = response.data.cat_list;
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
                axios.post('/sub-category-update', { 
                    id:id,
                    sub_cat_name: this.sub_cat_name,  
                    cat_id: this.cat_id,
                    sub_cat_des: this.sub_cat_des
                })  
                .then(response => {  
                    currentObj.output = response.data;
                    this.onload();
                })
            }
       }
	}
</script>