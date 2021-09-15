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
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <form class="categoryForm" id="categoryForm"
        @if (empty($categorydata['id']))
        action="{{ url('admin/add-edit-category') }}"
        @else
        action="{{ url('admin/add-edit-category',$categorydata['id']) }}"
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
                      <label>Category Name </label>
                      <input class="form-control" id="category_name" name="category_name" type="text" placeholder="Enter category Name "
                      @if (!empty($categorydata['category_name']))
                        value="{{ $categorydata['category_name'] }}"
                        @else
                         value="{{ old('category_name') }}"
                      @endif
                      >
                      @error('category_name')
                      <span class="text-danger"> {{$message}}</span>
                      @enderror
                  </div>
                  <div id="appendCategoriesLevel">
                      @include('admin.categories.append_categories_level')
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Select Section</label>
                      <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        @foreach ($getSections as $getSection)
                            <option value="{{ $getSection ->id }} "
                                @if (!empty($categorydata['section_id']) && $categorydata['section_id']== $getSection->id )
                                    selected
                                @endif
                                >{{ $getSection ->name }}</option>
                        @endforeach
                      </select>
                      @error('section_id')
                      <span class="text-danger"> {{$message}}</span>
                      @enderror
                    </div>
                  <div class="form-group">
                      <label for="exampleInputFile">Category Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-label" name="category_image" id="category_image">
                          <label class="custom-file-label" for="category_image">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text" id="">Upload</span>
                        </div>
                      </div>
                      @error('category_image')
                      <span class="text-danger"> {{$message}}</span>
                      @enderror
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                      <label>Category Discount </label>
                      <input class="form-control" id="category_discount" name="category_discount" type="text" placeholder="Enter Admin Name "
                      @if (!empty($categorydata['category_discount']))
                      value="{{ $categorydata['category_discount'] }}"
                      @else
                       value="{{ old('category_discount') }}"
                    @endif
                      >

                    </div>
                  <div class="form-group">
                      <label>Category Description </label>
                      <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter ..."
                      @if (!empty($categorydata['description']))
                      value="{{ $categorydata['description'] }}"
                      @else
                       value="{{ old('description') }}"
                    @endif
                      ></textarea>

                    </div>
                  <div class="form-group">
                      <label>Meta Description </label>
                       <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Enter ..."
                       @if (!empty($categorydata['meta_description']))
                       value="{{ $categorydata['meta_description'] }}"
                       @else
                        value="{{ old('meta_description') }}"
                     @endif
                       ></textarea>
                 </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                      <label>Category URL </label>
                      <input class="form-control" id="url" name="url" type="text" placeholder="Enter Admin Name "
                      @if (!empty($categorydata['url']))
                      value="{{ $categorydata['url'] }}"
                      @else
                       value="{{ old('url') }}"
                    @endif
                      >
                      @error('url')
                      <span class="url"> {{$message}}</span>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label>Meta Title </label>
                      <textarea class="form-control" name="meta_title" id="meta_title" rows="3" placeholder="Enter ..."
                      @if (!empty($categorydata['meta_title']))
                      value="{{ $categorydata['meta_title'] }}"
                      @else
                       value="{{ old('meta_title') }}"
                    @endif
                      ></textarea>
                  </div>
                  <div class="form-group">
                      <label>Meta Keywords </label>
                      <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3" placeholder="Enter ..."
                      @if (!empty($categorydata['meta_keywords']))
                      value="{{ $categorydata['meta_keywords'] }}"
                      @else
                       value="{{ old('meta_keywords') }}"
                    @endif
                      ></textarea>
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
