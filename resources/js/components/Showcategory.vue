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
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>
                        <tr v-for="(value,index) in categories" :key="index">
                            <td>{{ value.cat_name }}</td>
                            <td>{{ value.cat_sulg }}</td>
                            <td>{{ value.cat_des }}</td>
                            <td>61</td>
                            <td>
                                <a @click.prevent="edit(value.id)" class="btn btn-primary" href="#"><i class="fa fa-edit" title="Edit"></i></a> 
                                <a @click.prevent="deleteCategory(value.id)" class="btn btn-danger" href="#"><i class="fa fa-trash" title="Delete"></i></a>
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
</template>
<script>
	export default {
       data(){
         return {
            categories : '',
         }
       },
        mounted:function(){
            this.onload() //method1 will execute at pageload
        },

       methods : {
        onload(){ 
            let currentObj = this;
            axios.get('/return-category')
            .then(function (response) {  
               currentObj.categories = response.data;
            });

        },
        // edit category 
        edit(id){
            EventBus.$emit('update-category',id);
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
                axios.get('category-delete/'+id)
                .then(response => {
                currentObjj.categories = response.data;
                this.onload();
                })
            }
        }) 
       },
       }
	}
</script>