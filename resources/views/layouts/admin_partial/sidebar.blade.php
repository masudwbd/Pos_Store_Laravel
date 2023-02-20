  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @php
              $settings = DB::table('settings')->first();
          @endphp
          <img src="{{asset($settings->company_logo)}}" class="img-circle" alt="User Image">
        </div>
        <div class="info">
          <a href="" style="text-decoration:none" class="d-block"> <h6 class="text-light" >{{$settings->company_name}}</h6> </a>
        </div>
      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
   
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="{{route('dashboard.index')}}" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('pos.index')}}" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Pos
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Employes
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('add_employe')}}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Add Employe</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('employe.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Employer</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Customers
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('customer.add')}}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Add Customer</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('customer.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Customers</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Suppliers
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('supplier.add')}}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Add Supplier</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('supplier.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Supplier</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Advance Salaries
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('salary.add')}}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Add Advance Salary</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('salary.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Advance Supplier</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Products
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('product.add')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Add Product</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('product.import_products')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Import Products</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('product.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Products</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Attendance
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('present.add')}}" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Today Attendance</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('present.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>All Attendance</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="{{route('orders.index')}}" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Orders
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('settings.index')}}" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Settings
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('admin.logout')}}" class="nav-link">
          <i class="nav-icon fas fa-copy text-light" ></i>
          <p class="text-light"> 
            Logout
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
          </p>
        </a>
      </li>
    </ul>
  </nav>
</aside>