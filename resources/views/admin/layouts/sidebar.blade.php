<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/dashboard') }}" style="background-color: #4B49AC !important; color: #fff !important;">
              <i class="icon-grid menu-icon" style="background-color: #4B49AC !important; color: #fff !important;"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(Auth::guard('admin')->user()->type == "vendor")
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#vendor" aria-expanded="false" aria-controls="vendor">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Vendor Details</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="vendor">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/update-vendor-details/personal') }}">Personal Details</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/update-vendor-details/business') }}">Business Details</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/update-vendor-details/bank') }}">Bank Details</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#catalogue_management" aria-expanded="false" aria-controls="catalogue_management">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Catalogues</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="catalogue_management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/vendor/genres') }}">Genres</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/vendor/authors') }}">Authors</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/vendor/books') }}">Books</a></li>
              </ul>
            </div>
          </li>
          @elseif(Auth::guard('admin')->user()->type == "admin")
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings"
            @if(Session::get('page') == "passwords" || Session::get('page') == "details") 
            style="background-color: #4B49AC !important; color: #fff !important;" @endif>
              <i class="icon-layout menu-icon" style="color: #fff !important;"></i>
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-settings">
              <ul class="nav flex-column sub-menu" style="background-color: #fff !important; color: #4B49AC !important;">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/update-admin-password') }}"
                @if(Session::get('page') == "passwords") 
                  style="background-color: #4B49AC !important; color: #fff !important;" 
                  @else style="background-color: #fff !important; color: #4B49AC !important;" 
                  @endif>
                 Update Password</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/update-admin-details') }}"
                @if(Session::get('page') == "details") 
                  style="background-color: #4B49AC !important; color: #fff !important;" 
                  @else style="background-color: #fff !important; color: #4B49AC !important;" 
                  @endif>
                 Update Details</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#admin_management" aria-expanded="false" aria-controls="admin_management">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Admin Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="admin_management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/admin') }}">Admins</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/subadmin') }}">Sub Admins</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/vendor') }}">Vendors</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins') }}">All</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#catalogue_management" aria-expanded="false" aria-controls="catalogue_management"
            @if(Session::get('page') == "categories" || Session::get('page') == "sections" || Session::get('page') == "brands" || Session::get('page') == "pages"
            || Session::get('page') == "products") 
            style="background-color: #4B49AC !important; color: #fff !important;" @endif>
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Catalogues Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="catalogue_management">
              <ul class="nav flex-column sub-menu" style="background-color: #fff !important; color: #4B49AC !important;">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/sections') }}" @if(Session::get('page') == "sections") 
                  style="background-color: #4B49AC !important; color: #fff !important;" 
                  @else style="background-color: #fff !important; color: #4B49AC !important;" 
                  @endif>Sections</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/categories') }}" @if(Session::get('page') == "categories") 
                  style="background-color: #4B49AC !important; color: #fff !important;" 
                  @else style="background-color: #fff !important; color: #4B49AC !important;" 
                  @endif>Categories</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/brands') }}" @if(Session::get('page') == "brands") 
                  style="background-color: #4B49AC !important; color: #fff !important;" 
                  @else style="background-color: #fff !important; color: #4B49AC !important;" 
                  @endif>Brands</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products') }}" @if(Session::get('page') == "products") 
                  style="background-color: #4B49AC !important; color: #fff !important;" 
                  @else style="background-color: #fff !important; color: #4B49AC !important;" 
                  @endif>Products</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user_management" aria-expanded="false" aria-controls="user_management">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">User Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user_management">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/user') }}">Users</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/subscriber') }}">Subscribers</a></li>
              </ul>
            </div>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#banner_management" aria-expanded="false" aria-controls="user_management"
             @if(Session::get('page') == "banners") 
            style="background-color: #4B49AC !important; color: #fff !important;" @endif>
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Banners Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="banner_management">
              <ul class="nav flex-column sub-menu" style="background-color: #fff !important; color: #4B49AC !important;">
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/banners') }}" @if(Session::get('page') == "banners") 
                  style="background-color: #4B49AC !important; color: #fff !important;" 
                  @else style="background-color: #fff !important; color: #4B49AC !important;" 
                  @endif>Home Page Banners</a></li>
              </ul>
            </div>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Form elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Charts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Icons</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="icon-ban menu-icon"></i>
              <span class="menu-title">Error pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
</nav>