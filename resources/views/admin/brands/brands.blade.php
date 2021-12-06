@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sections</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
            </ol>
          </div>
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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Brands</h3>
              <a href="{{ url('admin/add-edit-brand') }}" style="max-width: 150px; float: right; display:inline-block" class="btn btn-block btn-success">Add Brand</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="sections" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand ->id }}</td>
                        <td>{{ $brand ->name }} </td>
                        <td>
                            <a title="Edit brand" href="{{ url('admin/add-edit-brand',$brand ->id) }}"><i class="fas fa-edit"></i>
                            </a>
                            &nbsp;&nbsp;
                            &nbsp;&nbsp;
                            <a title="Delete brand" href="javascript:void(0)"  class="confirmDelete" record="brand" recordid="{{ $brand ->id }}"
                                {{-- href="{{ url('admin/delete-brand',$brand ->id) }}" --}}
                                ><i class="fas fa-trash"></i>
                            </a>
                            &nbsp;&nbsp;
                            &nbsp;&nbsp;
                            @if($brand ->status ==1)
                               <a class="updateBrandStatus" id="brand-{{ $brand ->id }}" brand_id="{{ $brand ->id }}"
                                href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status = "Active"></i>

                            </a>
                            @else
                                <a class="updateBrandStatus" id="brand-{{ $brand ->id }}" brand_id="{{ $brand ->id }}"
                                href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status = "Inactive"></i>

                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
