<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Data Tables | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        @include('admin.include.header-with-nav')

    </head>

    <body data-sidebar="dark" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
        @include('admin.include.topbar')
            
           

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.include.sidebar')
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            @yield('content')
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
       
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
       @include('admin.include.footer')

    </body>
</html>
