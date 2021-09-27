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
              <li class="breadcrumb-item active">Products</li>
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
                        <label>Select Category</label>
                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                          <option value="">Select</option>
                        </select>
                        @error('section_id')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                  </div>
                  <div class="form-group">
                      <label>Product Name </label>
                      <input class="form-control" id="product_name" name="product_name" type="text" placeholder="Enter product Name "
                      @if (!empty($productdata['product_name']))
                        value="{{ $productdata['product_name'] }}"
                        @else
                         value="{{ old('product_name') }}"
                      @endif
                      >
                      @error('product_name')
                      <span class="text-danger"> {{$message}}</span>
                      @enderror
                  </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Code </label>
                        <input class="form-control" id="product_code" name="product_code" type="text" placeholder="Enter product Code "
                        @if (!empty($productdata['product_code']))
                          value="{{ $productdata['product_code'] }}"
                          @else
                           value="{{ old('product_code') }}"
                        @endif
                        >
                        @error('product_code')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Color </label>
                        <input class="form-control" id="product_color" name="product_color" type="text" placeholder="Enter product Color "
                        @if (!empty($productdata['product_color']))
                          value="{{ $productdata['product_color'] }}"
                          @else
                           value="{{ old('product_color') }}"
                        @endif
                        >
                        @error('product_color')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label>Product Price </label>
                        <input class="form-control" id="product_price" name="product_price" type="text" placeholder="Enter product price "
                        @if (!empty($productdata['product_price']))
                          value="{{ $productdata['product_price'] }}"
                          @else
                           value="{{ old('product_price') }}"
                        @endif
                        >
                        @error('product_price')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Product Discount (%)</label>
                        <input class="form-control" id="product_discount" name="product_discount" type="text" placeholder="Enter product discount "
                        @if (!empty($productdata['product_discount']))
                          value="{{ $productdata['product_discount'] }}"
                          @else
                           value="{{ old('product_discount') }}"
                        @endif
                        >
                        @error('product_discount')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                        <label>Product Weight</label>
                        <input class="form-control" id="product_weight" name="product_weight" type="text" placeholder="Enter product weight "
                        @if (!empty($productdata['product_weight']))
                          value="{{ $productdata['product_weight'] }}"
                          @else
                           value="{{ old('product_weight') }}"
                        @endif
                        >
                        @error('product_weight')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                  </div>
                  <div class="form-group">
                      <label for="main_image">Product Main Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-label" name="main_image" id="main_image">
                          <label class="custom-file-label" for="main_image">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                      @error('main_image')
                      <span class="text-danger"> {{$message}}</span>
                      @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_video">Product Main Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-label" name="product_video" id="product_video">
                            <label class="custom-file-label" for="product_video">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div>
                        </div>
                        @error('product_video')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>

                </div>
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                      <label>Product Description </label>
                      <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter ...">
                        @if (!empty($productdata['description']))
                       {{$productdata['description']}}
                        @else
                        {{ old('description') }}
                      @endif
                      </textarea>

                    </div>
                  <div class="form-group">
                      <label>Meta Description </label>
                       <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ...">
                        @if (!empty($productdata['meta_description']))
                       {{$productdata['meta_description']}}
                        @else
                         {{old('meta_description')}}
                      @endif
                       </textarea>
                 </div>
                </div>
                <div class="col-12 col-sm-6">

                  <div class="form-group">
                      <label>Meta Title </label>
                      <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ...">
                        @if (!empty($productdata['meta_title']))
                         {{$productdata['meta_title']}}
                        @else
                          {{old('meta_title')}}
                      @endif
                    </textarea>
                  </div>
                  <div class="form-group">
                      <label>Meta Keywords </label>
                      <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ...">
                            @if (!empty($productdata['meta_keywords']))
                                {{$productdata['meta_keywords']}}
                            @else
                                {{old('meta_keywords')}}
                            @endif
                      </textarea>
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
@endsection
