<template>
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Caategory</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form ref="form_1" @submit="formSubmit">
                            <div class="card-body">
                                <div>
                                    <label class="mb-1">Category Name</label>
                                    <input type="text" class="form-control" maxlength="25" v-model="cat_name" id="defaultconfig">
                                </div>
                                <div class="mt-3">
                                    <label class="mb-1">Category Description</label>
                                    <textarea id="textarea" class="form-control" maxlength="225" rows="3" v-model="cat_des"></textarea>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary btn-sm">Submit</button>
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
</template>
<script>  
    export default {  
        data() {  
            return { 
              cat_name: '',
              cat_des: '',
              output: ''  
            };  
        },  
        methods: {  
            formSubmit(e) {
                e.preventDefault();  
                let currentObj = this;  
                axios.post('/categoryformSubmit', {  
                    cat_name: this.cat_name,  
                    cat_des: this.cat_des
                })  
                .then(function (response) {  
                    currentObj.output = response.data;
                })  
                .catch(function (error) {  
                    currentObj.output = error;  
                }); 
                this.cat_name = '';
                this.cat_des = '';
                e.target.reset(); 
            }  
        }  
    }  
</script>  