<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif " href="{{route('dashboard')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Resources</div>
                    <a class="nav-link collapsed @if(request()->routeIs('books.*')) active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#books" aria-expanded="{{request()->routeIs('books.*')}}" aria-controls="books">
                        <div class="sb-nav-link-icon"><i  class="fas fa-columns"></i></div>
                        Books
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="books" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link  @if(request()->routeIs("books.create")) active @endif" href="{{route('books.create')}}">Create Books</a>
                            <a class="nav-link  @if(request()->routeIs("books.index")) active @endif" href="{{route('books.index')}}" >Book List</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed @if(request()->routeIs('users.*')) active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false" aria-controls="users">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="users" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link @if(request()->routeIs("users.create")) active @endif" href="{{route('users.create')}}">Create Users</a>
                            <a class="nav-link   @if(request()->routeIs("users.index")) active @endif" href="{{route('users.index')}}">User List</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Application</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#application" aria-expanded="false" aria-controls="application">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Issue
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="application" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Book Issue</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Issue History</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Return Book</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <small><div class="small">Logged in as:</div></small>
                {{$loggedUser->name}}
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        {{$slot}}
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>