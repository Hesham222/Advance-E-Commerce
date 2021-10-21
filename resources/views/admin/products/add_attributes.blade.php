@extends('layouts.admin_layout.admin_layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Attributes</li>
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
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
            <form class="productForm" id="productForm"
            @if (empty($productdata['id']))
            action="{{ url('admin/add-edit-product') }}"
            @else
            action="{{ url('admin/add-edit-product',$productdata['id']) }}"
            @endif
            method="post" enctype="multipart/form-data">
                @csrf
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>

                    {{-- @if ($errors->any())
                        <div class="alert alert-danger" style="margin-top: 10px;"></div>

                    @endif --}}

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name: {{ $productdata['product_name'] }} </label>
                                </div>
                                <div class="form-group">
                                    <label>Product Code: {{ $productdata['product_code'] }} </label>
                                </div>
                                <div class="form-group">
                                    <label>Product Color: {{ $productdata['product_color'] }}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <img src="{{ asset('images/products_images/'.$productdata['main_image']) }}" width="150px" height="150px" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
            <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit </button>
            </div>
          </div>
        </form>

      </div>
    </section>
  </div>
@endsection
