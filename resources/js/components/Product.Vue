<template>
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Product</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form ref="form_1" @submit="formSubmit" enctype="multipart/form-data">
                        <div class="card-body">
                            <div>
                                <label class="mb-1">Product Name</label>
                                <input type="text" class="form-control" maxlength="25" v-model="pro_name" id="defaultconfig">
                            </div>
                            <div>
                                <label class="mb-1">Product Category</label>
                                <select v-model="pro_cat_id" class="form-control" v-on:change="onChangesub(this.pro_cat_id)">
                                    <option selected>Choose Category</option>
                                    <option v-for="categories in categories" v-bind:value="categories.id" >{{ categories.cat_name }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="mb-1">Product Sub Category</label>
                                <select v-model="pro_sub_cat" class="form-control">
                                    <option selected>Choose Sub Category</option>
                                    <option v-for="sub_cat in sub_cat" v-bind:value="sub_cat.id" >{{ sub_cat.sub_cat_name }}</option>
                                </select>
                            </div>
                            <!-- <div>
                                <label class="mb-1">Product Feture Image</label>
                                <input type="file" class="form-control" maxlength="25" v-model="pro_f_img" id="defaultconfig">
                            </div> -->
                            <div>
                                <label class="mb-1">Product Images</label>
                                <input type="file" class="form-control" v-on:change="onChange">
                            </div>
                            <div class="mt-3">
                                <label class="mb-1">Product Description</label>
                                <textarea id="textarea" class="form-control" maxlength="225" rows="3" v-model="pro_des"></textarea>
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
          pro_name: '',
          pro_cat_id: '',
          pro_sub_cat: '',
          pro_f_img: '',
          pro_img: '',
          pro_des: '',
          categories: '',
          sub_cat: '',
          output:'',
        };  
    },
    mounted:function(){
            let currentObj = this;
            axios.get('/return-category')
            .then(function (response) {  
               currentObj.categories = response.data;
            });
    },
    methods: {
            onChangesub(id){
            let currentObjedit = this;
            axios.get('product-return-sub-category/'+id)
            .then(function (response) {
                currentObjedit.sub_cat = response.data;
                alert(sub_cat);
            });
            },
            onChange(e) {
                this.file1 = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let data = new FormData();
                data.append('file1', this.file1);
                data.append('pro_name', this.pro_name);
                data.append('pro_cat_id', this.pro_cat_id);
                data.append('pro_sub_cat', this.pro_sub_cat);
                data.append('pro_des', this.pro_des);
                axios.post('/product-save', data, config)
                    .then(function (res) {
                        existingObj.output = res.data;
                    })
                    .catch(function (err) {
                        existingObj.output = err;
                    });
                    this.file1 = '';
                    this.pro_name = '';
                    this.pro_cat_id = '';
                    this.pro_sub_cat = '';
                    this.pro_des = '';
                    e.target.reset();
            }
        }  
}  
</script>  