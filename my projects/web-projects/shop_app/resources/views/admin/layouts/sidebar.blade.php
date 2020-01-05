<div class="sidebar" data-background-color="white" data-active-color="danger">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">ShopApp Admin</a>
        </div>

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/products/create') }}" class="nav-link">
                    <i class="ti-archive"></i>
                    <p>Add Product</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/products') }}" class="nav-link">
                    <i class="ti-view-list-alt"></i>
                    <p>View Products</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/orders') }}" class="nav-link">
                    <i class="ti-calendar"></i>
                    <p>Orders</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/users') }}" class="nav-link">
                    <i class="fa fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
        </ul>
    </div>
</div>