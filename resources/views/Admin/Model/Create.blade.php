@extends('Admin.Layout.Main')

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Model </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div id="kyc-verify-wizard">
                <div class="card">
                    <div class="card-body">
                        <!-- Personal Info -->
                        <section>
                            @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert" id="erroralert">
                                <strong>{{Session::get('error')}}</strong>
                            </div>
                            @endif
                            <form method="post" action="{{route('model.submit')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="name-input" class="form-label">Brand</label>
                                            <select class="form-select" name="brand_id">
                                                <option value="">Select</option>
                                                @foreach($brand as $row)
                                                <option value="{{$row->id}}"@if($row->id==old('brand_id')) selected @endif>{{$row->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name-input" class="form-label">Model Name</label>
                                            <input type="text" class="form-control" id="name-input" placeholder="Enter Model Name" name="model_name" value="{{old('model_name')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="logo-input" class="form-label">Model Pic</label>
                                            <input type="file" class="form-control" id="logo-input" placeholder="Select Model Pic" name="model_pic">
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

</div> <!-- container-fluid -->
@stop