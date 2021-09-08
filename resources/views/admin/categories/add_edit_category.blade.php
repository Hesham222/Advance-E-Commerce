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
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Category</h3>

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
                    <input class="form-control" id="admin_name" name="admin_name" type="text" placeholder="Enter Admin Name ">
                </div>
                <div class="form-group">
                    <label>Select Category Level</label>
                  <select name="parent_id" class="form-control select2" style="width: 100%;">
                    <option value="0">Main Category</option>
                    </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label>Select Section</label>
                  <select name="section_id" class="form-control select2" style="width: 100%;">
                      @foreach ($getSections as $getSection)
                          <option selected="selected">{{ $getSection ->name }}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label for="exampleInputFile">Category Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Category Discount </label>
                    <input class="form-control" id="admin_name" name="admin_name" type="text" placeholder="Enter Admin Name ">
                </div>
                <div class="form-group">
                    <label>Category Description </label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label>Meta Description </label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Category URL </label>
                    <input class="form-control" id="admin_name" name="admin_name" type="text" placeholder="Enter Admin Name ">
                </div>
                <div class="form-group">
                    <label>Meta Title </label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label>Meta Keywords </label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit </button>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
