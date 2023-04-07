@include('admin.master')
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data Tables</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                        <div>
                        
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-brand-modal">
                                                Add
                                            </button>
                        </div>
                        

                    <div id="app">
                    <Create_brand></Create_brand>    
                    <List_brand></List_brand>
                   
                    </div>
                    
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

     
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © Skote.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by Themesbrand
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<script src="{{ mix('js/app.js') }}"></script>










<script src="{{ mix('js/app.js') }}"></script>