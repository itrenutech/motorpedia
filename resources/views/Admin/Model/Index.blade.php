@extends('Admin.Layout.Main')
@section('other_css')
<!-- DataTables -->
<link href="{{ URL::asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Model List </h4>
                <a href="{{route('model.create')}}" class="btn btn-primary btn-sm">+ Add Model</a>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert" id="erroralert">
            <strong>{{Session::get('error')}}</strong>
        </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($data as $row)
                            <tr>
                                <td>@php echo $i; @endphp</td>
                                <td width="60%">{{$row->model_name}}</td>
                                <td width="60%">{{$row->getBrand->brand_name}}</td>
                                <td><img src="{{URL::asset('models')}}/{{$row->model_pic}}" width="50%"></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{route('model.edit',[$row])}}" class="dropdown-item"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>
                                            <li>
                                                <a href="#" class="dropdown-item remove-item" data-id="{{ $row->id }}" data-action="{{ route('model.destroy',[$row]) }}"><i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> Inactive</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- end row -->

</div> <!-- container-fluid -->
@stop


@section('other_js')
<script src="{{ URL::asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ URL::asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection