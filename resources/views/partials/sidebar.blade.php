@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan

                </ul>
            </li>@endcan
            
            @can('product_category_access')
            <li>
                <a href="{{ route('admin.product_categories.index') }}">
                    <i class="fa fa-folder"></i>
                    <span>@lang('global.product-categories.title')</span>
                </a>
            </li>@endcan

            @can('product_tag_access')
            <li>
                <a href="{{ route('admin.product_tags.index') }}">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.product-tags.title')</span>
                </a>
            </li>@endcan

            @can('product_access')
            <li>
                <a href="{{ route('admin.products.index') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span>@lang('global.products.title')</span>
                </a>
            </li>
            @endcan

            @can('product_category_access')
                <li>
                    <a href="{{ route('admin.reviews.index') }}">
                        <i class="fa fa-folder"></i>
                        <span>@lang('global.reviews.title')</span>
                    </a>
                </li>@endcan

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

