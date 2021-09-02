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
                  <h3 class="card-title">Update Password</h3>
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
                <form role="form" method="post" action="{{ route('admin.update-password') }}" name="updatepassword" id="updatepassword">
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
                      <label for="exampleInputPassword1">Current Password</label>
                      <input  class="form-control" id="current_password" name="current_password"  type="password" placeholder="Enter Current Password">
                      <span id="checkCuurentPassword"></span>
                    </div>
                    <span id="checkCuurentPassword"></span>
                    <div class="form-group">
                      <label for="exampleInputPassword1">New Password</label>
                      <input type="password" id="new_password" name="new_password" class="form-control"  placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm New Password">
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
