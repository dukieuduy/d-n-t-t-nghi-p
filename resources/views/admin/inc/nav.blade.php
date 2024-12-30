<!-- Sidebar -->
<ul
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    id="accordionSidebar"
>
    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="index.html"
    >
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0"/>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
        >
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider"/>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseTwo"
            aria-expanded="true"
            aria-controls="collapseTwo"
        >
        <i class="fas fa-fw fa-folder"></i>
            <span>Bán hàng</span>
        </a>
        <div
            id="collapseTwo"
            class="collapse"
            aria-labelledby="headingTwo"
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý sản phẩm</h6>
                <a class="collapse-item" href="{{route('admin.products.index')}}">Danh sách sản phẩm</a>
                <a class="collapse-item" href="{{route('admin.products.create')}}">Thêm sản phẩm</a>
            </div>
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý danh mục</h6>
                <a class="collapse-item" href="{{route('admin.categories.index')}}">Danh sách danh mục</a>
                <a class="collapse-item" href="{{route('admin.categories.create')}}">Thêm danh mục</a>
            </div>
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý phí vận chuyển</h6>
                <a class="collapse-item" href="{{ route('admin.shipping_fees.index') }}">Danh sách Phí Ship</a>
                <a class="collapse-item" href="{{route('admin.shipping_fees.create')}}">Thêm mới</a>
            </div>
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý đơn hàng</h6>
                <a class="collapse-item" href="{{ route('admin.orders.index') }}">Danh sách đơn hàng</a>
                {{-- <a class="collapse-item" href="{{route('admin.shipping_fees.create')}}">Thêm mới</a> --}}
            </div>
           
        </div>
    </li>

    <li class="nav-item">
        <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapsePages"
            aria-expanded="true"
            aria-controls="collapsePages"
        >
            <i class="fas fa-fw fa-folder"></i>
            <span>Blogs</span>
        </a>
        <div
            id="collapsePages"
            class="collapse"
            aria-labelledby="headingPages"
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản Lý Blogs</h6>
                <a class="collapse-item" href="{{route('admin.blogs.index')}}">Danh Sách</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a
        >
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block"/>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img
            class="sidebar-card-illustration mb-2"
            src="img/undraw_rocket.svg"
            alt="..."
        />
        <p class="text-center mb-2">
            <strong>SB Admin Pro</strong> is packed with premium features,
            components, and more!
        </p>
        <a
            class="btn btn-success btn-sm"
            href="https://startbootstrap.com/theme/sb-admin-pro"
        >Upgrade to Pro!</a
        >
    </div>
</ul>
