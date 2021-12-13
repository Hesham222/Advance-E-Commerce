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
                          @foreach ($categories as $section)
                            <optgroup label="{{ $section->name }}"></optgroup>
                            @foreach ($section->categories as $category)
                            <option value="{{ $category->id }}"
                                    {{-- Edit --}}
                                    @if (isset($productdata['category_id']) && $productdata['category_id']== $category->id)
                                    selected =""
                                    @endif
                                    {{-- for validation --}}
                                    {{-- ديه عشان انت لو اختارت الكاتورجري ودوست سابميت الفالديشن يشتغل ع كل ويفضل سايبلك اختيارك ميروحش --}}
                                    @if (!empty(@old('category_id')) && $category->id == @old('category_id'))
                                    selected =""
                                    @endif


                                >&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;
                                {{ $category->category_name }}</option>
                                @foreach ($category->subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"
                                    @if (!empty(@old('category_id')) && $subcategory->id == @old('category_id'))
                                    selected =""
                                    @endif

                                    @if (isset($productdata['category_id']) && $productdata['category_id']== $subcategory->id)
                                    selected =""
                                    @endif
                                    {{-- @if (isset($productdata['category_id']) && $productdata['category_id']== $subcategory->id)
                                    selected =""
                                @endif --}}
                                    >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;
                                    {{ $subcategory->category_name }}</option>
                                @endforeach
                            @endforeach
                          @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Select Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control select2" style="width: 100%;">
                          <option value="">Select</option>
                          @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                @if (isset($productdata['brand_id']) && $productdata['brand_id']== $brand->id)
                                selected =""
                                @endif
                                >{{ $brand->name }}</option>
                          @endforeach
                        </select>
                        @error('brand')
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
                        <input class="form-control" id="product_code" name="product_code" type="text" placeholder="Enter product code "
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
                        <input class="form-control" id="product_color" name="product_color" type="text" placeholder="Enter product Name "
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
                    <div class="form-group">
                        <label>Product Price </label>
                        <input class="form-control" id="product_price" name="product_price" type="text" placeholder="Enter product Price "
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
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label>Product Discount (%) </label>
                        <input class="form-control" id="product_discount" name="product_discount" type="text" placeholder="Enter product Discount "
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
                    <div class="form-group">
                        <label>Product Weight </label>
                        <input class="form-control" id="product_weight" name="product_weight" type="text" placeholder="Enter product Weight "
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
                </div>
                <div class="col-md-6">


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

                      @if (!empty($productdata['main_image']))
                      <div style="height: 100px; margin-top:5px">
                          <img src="{{ asset('images/products_images/'.$productdata['main_image']) }}" width="100px" height="100px" alt="">
                          &nbsp;
                          <a record="product-image" recordid="{{ $productdata['id']}}"  href="javascript:void(0)"  class="confirmDelete"
                          {{-- href="{{ url('admin/delete-category-image',$categorydata['id']) }}" --}}

                          > Delete Image</a>
                      </div>
                  @endif
                    </div>
                    <div class="form-group">
                        <label for="product_video">Product Video</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-label" name="product_video" id="product_video">
                            <label class="custom-file-label" for="product_video">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div>
                        </div>
                        @if (!empty($productdata['product_video']))
                        <div>
                            <a href="{{ url('videos/product_videos/'.$productdata['product_video']) }}" download>Download</a>
                            &nbsp;|&nbsp;
                            <a record="product-video" recordid="{{ $productdata['id']}}"  href="javascript:void(0)"  class="confirmDelete"
                            {{-- href="{{ url('admin/delete-category-image',$categorydata['id']) }}" --}}

                            > Delete Video</a>
                        </div>
                        @endif
                      </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6">

                  <div class="form-group">
                    <label>product Description </label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter ...">
                      @if (!empty($productdata['description']))
                     {{$productdata['description']}}
                      @else
                      {{ old('description') }}
                    @endif
                    </textarea>

                  </div>
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
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="wash_care">Wash Care </label>
                  <textarea class="form-control" name="wash_care" id="wash_care" rows="3" placeholder="Enter ...">
                    @if (!empty($productdata['wash_care']))
                   {{$productdata['wash_care']}}
                    @else
                    {{ old('wash_care') }}
                  @endif
                  </textarea>

                </div>
                <div class="form-group">
                    <label>Select Fabric</label>
                    <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach ($fabricArray as $fabric)
                            <option value="{{ $fabric }}"
                            @if (isset($productdata['fabric']) && $productdata['fabric']== $fabric)
                            selected =""
                            @endif
                            >{{ $fabric }}</option>
                      @endforeach
                    </select>
                    @error('fabric')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Select Sleeve</label>
                    <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach ($sleeveArray as $sleeve)
                            <option value="{{ $sleeve }}"
                            @if (isset($productdata['sleeve']) && $productdata['sleeve']== $sleeve)
                            selected =""
                            @endif
                            >{{ $sleeve }}</option>
                      @endforeach
                    </select>
                    @error('sleeve')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Select Pattern</label>
                    <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach ($patternArray as $pattern)
                            <option value="{{ $pattern }}"
                            @if (isset($productdata['pattern']) && $productdata['pattern']== $pattern)
                            selected =""
                            @endif
                            >{{ $pattern }}</option>
                      @endforeach
                    </select>
                    @error('pattern')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>

            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Select Fit</label>
                    <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach ($fitArray as $fit)
                            <option value="{{ $fit }}"
                            @if (isset($productdata['fit']) && $productdata['fit']== $fit)
                            selected =""
                            @endif
                            >{{ $fit }}</option>
                      @endforeach
                    </select>
                    @error('fit')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Select Occasion</label>
                    <select name="occassion" id="occassion" class="form-control select2" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach ($occassionArray as $occassion)
                            <option value="{{ $occassion }}"
                            @if (isset($productdata['occassion']) && $productdata['occassion']== $occassion)
                            selected =""
                            @endif
                            >{{ $occassion }}</option>
                      @endforeach
                    </select>
                    @error('occassion')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>

            </div>



            </div>




                </div>
                <div class="row">
                  <div class="col-12 col-sm-6">
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
                        <label for="meta_keywords">Meta Keywords </label>
                        <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ...">
                              @if (!empty($productdata['meta_keywords']))
                                  {{$productdata['meta_keywords']}}
                              @else
                                  {{old('meta_keywords')}}
                              @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">Is_featured</label>
                        <input type="checkbox" name="is_featured" id="is_featured" value="yes"
                        @if (!empty($productdata['is_featured']) && $productdata['is_featured'] == "Yes")
                        checked =""
                         @endif
                         >
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
