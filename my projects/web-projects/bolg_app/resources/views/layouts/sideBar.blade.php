<div id="sidebar-wrapper">
        <ul class="nav flex-column">
            <!--search bar -->
            <li class="nav-item">
                <div id="search-bar" class="mb-3 ml-3 mr-3">
                    <form class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon1">
                            <span class="input-group-append" id="basic-addon1">
                                <button class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>

                        </div>
                    </form>
                </div>
            </li>
            <!-- end search bar -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <!--users-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#listContent1" aria-expanded="true" aria-controls="collapseOne" href="#"><i class="fa fa-users fa-fw"></i> Users <span class="fa fa-angle-left"></span></a>
                <ul class="collapse" id="listContent1">
                    <li>
                        <a href="{{ route('users.index') }}">All Users</a>
                    </li>
                    <li>
                        <a href="{{ route('users.create') }}">Create User</a>
                    </li>
                </ul>
            </li>
            <!--posts-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#listContent2" aria-expanded="true" aria-controls="collapseOne" href="#"><i class="fa fa-wrench fa-fw"></i> Posts <span class="fa fa-angle-left"></span></a>
                <ul class="collapse" id="listContent2">
                    <li>
                        <a href="{{route('posts.index')}}">All Posts</a>
                    </li>
                    <li>
                        <a href="{{route('posts.create')}}">Create Post</a>
                    </li>
                    <li>
                        <a href="{{route('comments.index')}}">All Comments</a>
                    </li>
                </ul>
            </li>

            <!--Categories-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#listContent3" aria-expanded="true" aria-controls="collapseOne" href="#"><i class="fa fa-wrench fa-fw"></i> Categories <span class="fa fa-angle-left"></span> </a>
                <ul class="collapse" id="listContent3">
                    <li>
                        <a href="{{route('categories.index')}}">All Categories</a>
                    </li>
                    <li>
                        <a href="admin/categories/create">Create Category</a>
                    </li>
                </ul>
            </li>
            <!--Media-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#listContent4" aria-expanded="true" aria-controls="collapseOne" href="#"><i class="fa fa-wrench fa-fw"></i> Media <span class="fa fa-angle-left"></span> </a>
                <ul class="collapse" id="listContent4">
                    <li>
                        <a href="{{route('media.index')}}">All Media</a>
                    </li>
                    <li>
                        <a href="{{route('media.create')}}">Upload Media</a>
                    </li>
                </ul>
            </li>
            <!--Charts-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#listContent5" aria-expanded="true" aria-controls="collapseOne" href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts <span class="fa fa-angle-left"></span> </a>
                <ul class="collapse" id="listContent5">
                    <li>
                        <a href="flot.html">Flot Charts</a>
                    </li>
                    <li>
                        <a href="morris.html">Morris.js Charts</a>
                    </li>
                </ul>
            </li>
            <!--Tables-->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-table fa-fw"></i> Tables</a>
            </li>
            <!--Forms-->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-edit fa-fw"></i> Forms</a>
            </li>
            <!--UI Elements-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#listContent6" aria-expanded="true" aria-controls="collapseOne" href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements <span class="fa fa-angle-left"></span> </a>
                <ul class="collapse" id="listContent6">
                    <li>
                        <a href="panels-wells.html">Panels and Wells</a>
                    </li>
                    <li>
                        <a href="buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="notifications.html">Notifications</a>
                    </li>
                    <li>
                        <a href="typography.html">Typography</a>
                    </li>
                    <li>
                        <a href="icons.html"> Icons</a>
                    </li>
                    <li>
                        <a href="grid.html">Grid</a>
                    </li>
                </ul>
            </li>
            <!--Multi-Level Dropdown-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#listContent7" aria-expanded="true" aria-controls="collapseOne" href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown <span class="fa fa-angle-left"></span> </a>
                <ul class="collapse" id="listContent7">
                    <li>
                        <a href="panels-wells.html">Panels and Wells</a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="collapse" data-target="#listContent8" aria-expanded="true" aria-controls="collapseOne" href="#">Third Level <span class="fa fa-angle-left"></span> </a>
                        <ul class="collapse" id="listContent8">
                            <li>
                                <a href="panels-wells.html">Panels and Wells</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!--Sample Pages-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#listContent9" aria-expanded="true" aria-controls="collapseOne" href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages <span class="fa fa-angle-left"></span> </a>
                <ul class="collapse" id="listContent9">
                    <li>
                        <a class="active" href="blank.html">Blank Page</a>
                    </li>
                    <li>
                        <a href="login.html">Login Page</a>
                    </li>
                </ul>
            </li>

        </ul>

</div>