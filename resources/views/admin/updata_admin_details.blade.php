@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Admin Details</h3>
                </div>

                @if (Session::has('error_message'))
                <div class="class alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px">
                    {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismissible="alert" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('success_message'))
            <div class="class alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px">
                {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismissible="alert" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{ url('/admin/update-admin-details') }}" name="updateAdminDetails" id="updateAdminDetails" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Admin Name </label>
                            <input type="text" value="{{ $admindetails->name }}" class="form-control"placeholder="Enter Admin Name/Sub Admin Name" id="admin_name" nmae="admin_name">
                        </div> --}}
                        <div class="form-group">
                        <label for="exampleInputEmail1">Admin Email </label>
                        <input value="{{ $admindetails->email }}" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Admin Type </label>
                        <input value="{{ $admindetails->type }}" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Admin Name</label>
                        <input  class="form-control" id="admin_name" name="admin_name"  type="text" placeholder="Enter Admin Name ">
                        @error('admin_name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                        </div>
                        <span id="checkCuurentPassword"></span>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Mobile </label>
                        <input type="text" id="admin_mobile" name="admin_mobile" class="form-control"  placeholder="Enter Admin Mobile">
                        @error('admin_mobile')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                        </div>
                        {{-- <div class="form-group">
                        <label for="exampleInputPassword1">Image</label>
                        @if (!empty(Auth::guard('admin')->user()->image)))
                            <a href="">View Image</a>
                            <input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
                        @endif
                        <input type="file" class="form-control" id="admin_image" name="admin_image" >

                        @error('admin_image')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Admin Image</label>
                            @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{url(Auth::guard('admin')->user()->image)}}">View Image</a>
                                <input type="hidden" name="currentAdminImage" value="{{Auth::guard('admin')->user()->image}}">
                            @endif
                            <input name="adminImage" type="file" class="form-control"
                                id="adminImage" placeholder="{{Auth::guard('admin')->user()->image}}">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
              <!-- /.card -->







            </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>


@endsection
