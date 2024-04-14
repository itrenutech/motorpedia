<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | MotorPedia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="#" name="description" />
    <meta content="#" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
    <!-- Bootstrap Css -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ URL::asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    @yield('other_css')
    <script src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <!-- toastr plugin -->
    <script src="{{ URL::asset('assets/libs/toastr/build/toastr.min.js') }}"></script>

    <!-- toastr init -->
    <script src="{{ URL::asset('assets/js/pages/toastr.init.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('Admin.Layout.Header')
        <!-- ========== Left Sidebar Start ========== -->
        @include('Admin.Layout.Menu')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @include('Admin.Layout.toastr')
            <div class="page-content">
                @yield('content')
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('Admin.Layout.Footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->

    <script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
    @yield('other_js')
    <!-- App js -->
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        $("body").on("click", ".remove-item", function() {
            var current_object = $(this);
            swal({
                title: "Are you sure?",
                text: "You want to delete this record.",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Delete!',
            }, function(result) {
                if (result) {
                    var action = current_object.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var id = current_object.attr('data-id');

                    $('body').html("<form class='form-inline remove-form' method='post' action='" + action + "'></form>");
                    $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' + token + '">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id + '">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
        $("body").on("click", ".active-item", function() {
            var current_object = $(this);
            swal({
                title: "Are you sure?",
                text: "You want to active this record.",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Active!',
            }, function(result) {
                if (result) {
                    var action = current_object.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var id = current_object.attr('data-id');

                    $('body').html("<form class='form-inline remove-form' method='post' action='" + action + "'></form>");
                    $('body').find('.remove-form').append('<input name="_method" type="hidden" value="get">');
                    $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' + token + '">');
                    $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id + '">');
                    $('body').find('.remove-form').submit();
                }
            });
        });
    </script>
</body>

</html>