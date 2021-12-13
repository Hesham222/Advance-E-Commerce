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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Categories</h3>
              <a href="{{ url('admin/add-edit-category') }}" style="max-width: 150px; float: right; display:inline-block" class="btn btn-block btn-success">Add Category</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Category </th>
                  <th>Parent Category </th>
                  <th>Section</th>
                  <th>URL</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    @if (!isset($category ->parentcategory->category_name))
                        <?php $parent_category = "Root"; ?>
                        @else
                        <?php $parent_category = $category ->parentcategory->category_name; ?>
                    @endif
                    <tr>
                        <td>{{ $category ->id }}</td>
                        <td>{{ $category ->category_name }} </td>
                        <td>{{ $parent_category}} </td>
                        <td>{{ $category ->section->name }}</td>
                        <td>{{ $category ->url }} </td>
                        <td>
                            @if($category ->status ==1)
                               <a class="updateCategoryStatus" id="category-{{ $category ->id }}" category_id="{{ $category ->id }}"
                                href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status = "Active"></i></a>
                            @else
                                <a class="updateCategoryStatus" id="category-{{ $category ->id }}" category_id="{{ $category ->id }}"
                                href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status = "Inactive"></i></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/add-edit-category',$category ->id) }}"><i class="fas fa-edit"></i></a>
                            &nbsp;&nbsp;
                            <a href="javascript:void(0)"  class="confirmDelete" record="category" recordid="{{ $category ->id }}"
                                {{-- href="{{ url('admin/delete-category',$category ->id) }}" --}}
                                ><i class="fas fa-trash"></i></a>

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
