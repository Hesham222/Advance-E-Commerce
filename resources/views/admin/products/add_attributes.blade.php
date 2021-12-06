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
            <form class="addAttributeForm" id="addAttributeForm" method="post" action="{{ url('admin/add-attributes',$productdata['id']) }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productdata['id'] }}">
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
                                        <label>Product Name:</label>&nbsp;
                                        {{ $productdata['product_name'] }}
                                    </div>
                                    <div class="form-group">
                                        <label>Product Code:</label>&nbsp;
                                        {{ $productdata['product_code'] }}
                                    </div>
                                    <div class="form-group">
                                        <label>Product Color:</label>&nbsp;
                                        {{ $productdata['product_color'] }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="{{ asset('images/products_images/'.$productdata['main_image']) }}" width="120px"  alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="field_wrapper">
                                            <div>
                                                <input type="text" id="size" name="size[]" value="" placeholder="Size" style="width:120px" required=""/>
                                                <input type="number" id="price" name="price[]" value="" placeholder="price" style="width:120px" required=""/>
                                                <input type="number" id="stock" name="stock[]" value="" placeholder="stock" style="width:120px" required=""/>
                                                <input type="text" id="sku" name="sku[]" value="" placeholder="Sku" style="width:120px" required=""/>
                                                <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> Add Attributes </button>
                    </div>
                </div>
            </form>
        </div>

        <form name="editAttributeForm" id="editAttributeForm" method="post" action="{{ url('admin/edit-attributes/'.$productdata['id']) }}">
            @csrf
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Addedd Product Attributes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="products" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Size </th>
                      <th>Price </th>
                      <th>Stock</th>
                      <th>Sku</th>
                      <th>Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($productdata->attributes as $attribute)
                        <input type="hidden" name="attrId[]" value="{{ $attribute->id }}">
                        <tr>
                            <td>{{ $attribute->id }}</td>
                            <td>{{ $attribute->size}} </td>
                            <td>
                                <input type="number" name="price[]" value="{{ $attribute->price }}" required="">
                            </td>
                            <td>
                                <input type="number" name="stock[]" value="{{ $attribute->stock }}" required="">
                            </td>
                            <td>{{ $attribute->sku }}</td>
                            <td>

                                <div class="row">
                                    <div>
                                        @if($attribute ->status ==1)
                                        <a class="updateAttributeStatus" id="attribute-{{ $attribute ->id }}" attribute_id="{{ $attribute ->id }}"
                                         href="javascript:void(0)">Active</a>
                                        @else
                                         <a class="updateAttributeStatus" id="attribute-{{ $attribute ->id }}" attribute_id="{{ $attribute ->id }}"
                                         href="javascript:void(0)">Inactive</a>
                                        @endif
                                    </div>
                                    <div>
                                        &nbsp;&nbsp;
                                        <a title="Delete attribute" href="javascript:void(0)"  class="confirmDelete" record="attribute" recordid="{{ $attribute ->id }}"
                                            {{-- href="{{ url('admin/delete-attribute',$attribute ->id) }}" --}}
                                            ><i class="fas fa-trash"></i>
                                        </a>
                                        
                                    </div>

                                </div>



                            </td>

                        </tr>
                    @endforeach


                    </tbody>

                  </table>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Attributes </button>
                 </div>
                <!-- /.card-body -->
              </div>

            </div>
        </form>

    </div>


    </section>
  </div>
@endsection
