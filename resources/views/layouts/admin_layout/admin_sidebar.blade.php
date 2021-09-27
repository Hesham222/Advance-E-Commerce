
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('images/admin_images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/admin_images/IMG-20210126-WA0053.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (Session::get('page')=="dashboard")
                    <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
            <li class="nav-item">

                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $active }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    Dashboard
                  </p>
                </a>
            </li>
            <!-- Settings -->
            @if (Session::get('page')=="settings" || Session::get('page')=="update-admin-details")
            <?php $active = "active"; ?>
            @else
            <?php $active = ""; ?>
            @endif
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @if (Session::get('page')=="settings" )
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
              <li class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update password </p>
                </a>
              </li>
              @if (Session::get('page')=="update-admin-details")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{ url('/admin/update-admin-details') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>

            </ul>
          </li>
            <!-- Catalouge -->
            @if (Session::get('page')=="sections" || Session::get('page')=="categories")
            <?php $active = "active"; ?>
            @else
            <?php $active = ""; ?>
            @endif
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Catalougues
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @if (Session::get('page')=="sections")
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
              <li class="nav-item">
                <a href="{{ route('admin.sections') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sections </p>
                </a>
              </li>
              @if (Session::get('page')=="categories")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{ route('categories') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              @if (Session::get('page')=="products")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{ route('products') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>

            </ul>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
