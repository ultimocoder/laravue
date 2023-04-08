<template>
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Add Sub Category</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Sub Category</li>
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
                                <label class="mb-1">Sub Category Name</label>
                                <input type="text" class="form-control" maxlength="25" v-model="sub_cat_name" id="defaultconfig">
                            </div>
                            <div>
                                <label class="mb-1">Select Category Name</label>
                                <select v-model="cat_id" class="form-control">
                                    <option selected>Choose Category</option>
                                    <option v-for="categories in categories" v-bind:value="categories.id" >{{ categories.cat_name }}</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label class="mb-1">Category Description</label>
                                <textarea id="textarea" class="form-control" maxlength="225" rows="3" v-model="sub_cat_des"></textarea>
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
          categories: '',
          output: '', 
        };  
    },  
    mounted:function(){
            this.onload() //method1 will execute at pageload
        },
    methods: {  
        onload(){ 
            let currentObj = this;
            axios.get('/return-category')
            .then(function (response) {  
               currentObj.categories = response.data;
            });

        },
        formSubmit(e) {
                e.preventDefault();  
                let currentObj = this;  
                axios.post('/subcategoryformSubmit', {  
                    sub_cat_name: this.sub_cat_name,  
                    cat_id: this.cat_id,  
                    sub_cat_des: this.sub_cat_des
                })  
                .then(function (response) {  
                    currentObj.output = response.data;
                })  
                .catch(function (error) {  
                    currentObj.output = error;  
                }); 
                this.sub_cat_name = '';
                this.cat_id = '';
                this.sub_cat_des = '';
                e.target.reset(); 
            }  
    }  
}  
</script>  