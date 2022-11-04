<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="AirPos Logo" class="brand-image img elevation-3"
             style="width:90%; opacity: .8">
        <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <?php

        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }
    ?>
  
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
                        <?php
                         $all_active_products_count = App\Models\Product::where("status","=",1)->where("account_id", "=", $account_id)->count();
                        ?>
                        <p>All Products<span class="badge badge-info right">{{$all_active_products_count}}</span></p>
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
                        <?php
                         $all_sales_count = App\Models\Order::where("deleted","=",0)->where("supplier_id", "=", $account_id)->count();
                        ?>
                        <p>All Sales<span class="badge badge-info right">{{$all_sales_count}}</span></p>
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
                    Purchase Orders
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/awaitapprv'))? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Awaiting Approval</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/onhold'))? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>On Hold</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/awaitapprv'))? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Approved</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/awaitapprv'))? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Rejected</p>
                            </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('purchases.index') }}" class="nav-link {{ (request()->is('admin/purchases/intransit'))? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>In Transit</p>
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
                    <a href="#" class="nav-link {{ (request()->is('admin/contacts') || request()->is('admin/contacts/create')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Contacts
                    <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('contacts.create') }}" class="nav-link {{ (request()->is('admin/contacts/create')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>New Contact</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('contacts.index') }}" class="nav-link {{ (request()->is('admin/contacts')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <?php
                        $all_active_contacts_count = App\Models\Contact::where("deleted","=",0)->where("account_id", "=", $account_id)->count();
                        ?>
                        <p>Contacts<span class="badge badge-info right">{{$all_active_contacts_count}}</span></p>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supplier.contacts') }}" class="nav-link {{ (request()->is('admin/supplier_contacts')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <?php
                            $all_supplier_contacts_count = App\Models\Contact::where("deleted","=",0)->where("contact_type","=","supplier")->where("account_id", "=", $account_id)->count();
                            ?>
                            <p>Suppliers<span class="badge badge-info right">{{$all_supplier_contacts_count}}</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.contacts') }}" class="nav-link {{ (request()->is('admin/customer_contacts')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <?php
                            $all_customer_contacts_count = App\Models\Contact::where("deleted","=",0)->where("contact_type","=","customer")->where("account_id", "=", $account_id)->count();
                            ?>
                            <p>Customers<span class="badge badge-info right">{{$all_customer_contacts_count}}</span></p>
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
  