<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="AirPos Logo" class="brand-image img elevation-3"
             style="width:90%; opacity: .8">
        <span class="brand-text font-weight-light">&nbsp;</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->getAvatar() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->getFullname() }}</a>
            </div>
        </div>
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
  
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{route('home')}}" class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ (request()->is('admin/products') || request()->is('admin/products/create')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        Inventory
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('products.create') }}" class="nav-link {{ (request()->is('admin/products/create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New Product</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ (request()->is('admin/products')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Products</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ (request()->is('admin/orders') || request()->is('admin/cart')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-basket-shopping"></i>
                    <p>
                    Sales
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link {{ (request()->is('admin/cart')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New Sale</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link {{ (request()->is('admin/orders'))? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Sales</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ (request()->is('admin/cart2') || request()->is('admin/purchases/awaitapprv') 
                    || request()->is('admin/purchases/intransit') || request()->is('admin/purchases/onhold')
                    || request()->is('admin/purchases/completed') ) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cart-plus"></i>
                    <p>
                    Purchases
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cart2.index') }}" class="nav-link {{ (request()->is('admin/cart2')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>New Purchase</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/awaitapprv'))? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Awaiting Approval</p>
                            </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/intransit'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>In Transit</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/onhold'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>On Hold</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/completed'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Completed</p>
                          </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ (request()->is('admin/customers') || request()->is('admin/customers/create')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Customers
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('customers.create') }}" class="nav-link {{ (request()->is('admin/customers/create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New Customer</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('customers.index') }}" class="nav-link {{ (request()->is('admin/customers')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Customers</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ (request()->is('admin/suppliers') || request()->is('admin/suppliers/active')|| request()->is('admin/suppliers/inactive')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Suppliers
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!--<li class="nav-item">
                        <a href="{{ route('suppliers.create') }}" class="nav-link {{ (request()->is('admin/suppliers/create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New Supplier</p>
                        </a>
                        </li>-->
                        <li class="nav-item">
                        <a href="{{ route('suppliers.index') }}" class="nav-link {{ (request()->is('admin/suppliers')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Suppliers</p>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('suppliers.active') }}" class="nav-link {{ (request()->is('admin/suppliers/active')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Verified Suppliers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('suppliers.inactive') }}" class="nav-link {{ (request()->is('admin/suppliers/inactive')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Unverified Suppliers</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ (request()->is('admin/merchants') || request()->is('admin/merchants/active')|| request()->is('admin/merchants/inactive')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Merchants
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!--<li class="nav-item">
                        <a href="{{ route('merchants.create') }}" class="nav-link {{ (request()->is('admin/merchants/create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New Supplier</p>
                        </a>
                        </li>-->
                        <li class="nav-item">
                        <a href="{{ route('merchants.index') }}" class="nav-link {{ (request()->is('admin/merchants')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Merchants</p>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('merchants.active') }}" class="nav-link {{ (request()->is('admin/merchants/active')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Verified Merchants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('merchants.inactive') }}" class="nav-link {{ (request()->is('admin/merchants/inactive')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Unverified Merchants</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ (request()->is('admin/products') || request()->is('admin/products/create')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New Sale</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Sales</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ (request()->is('admin/settings')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                        <form action="{{route('logout')}}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  