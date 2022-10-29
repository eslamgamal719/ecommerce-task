<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">{{-- auth()->user()->name --}}</p>
            <p class="app-sidebar__user-designation">{{-- implode(',', auth()->user()->roles->pluck('name')->toArray()) --}}</p>
        </div>
    </div>

    <ul class="app-menu">
        <li><a class="app-menu__item" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>



        @can('products_list')
             <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">Products</span><i class="treeview-indicator fa fa-angle-right"></i></a>
               <ul class="treeview-menu">
                   <li><a class="treeview-item" href="{{ route('admin.products.index') }}"><i class="icon fa fa-list"></i> Products List </a></li>
                   <li><a class="treeview-item" href="{{ route('admin.products.create') }}"><i class="icon fa fa-plus"></i> Add New Product </a></li>
               </ul>
             </li>
        @endif

        @can('brands_list')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">Brands</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{ route('admin.brands.index') }}"><i class="icon fa fa-list"></i> Brands List </a></li>
                    <li><a class="treeview-item" href="{{ route('admin.brands.create') }}"><i class="icon fa fa-plus"></i> Add New Brand </a></li>
                </ul>
            </li>
        @endif

        @can('orders_list')
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">Orders</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{ route('admin.orders.index') }}"><i class="icon fa fa-list"></i> Orders List </a></li>
                    <li><a class="treeview-item" href="{{ route('admin.orders.create') }}"><i class="icon fa fa-plus"></i> Add New Order </a></li>
                </ul>
            </li>
        @endif


    </ul>

</aside>
