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

                    <a class="nav-link  @if(request()->routeIs("books.index")) active @endif" href="{{route('books.index')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Book List
                    </a>
                    <a class="nav-link  @if(request()->routeIs("books.create")) active @endif" href="{{route('books.create')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Add a new book
                    </a>
                    <a class="nav-link   @if(request()->routeIs("users.index")) active @endif" href="{{route('users.index')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        User List
                    </a>
                    <a class="nav-link @if(request()->routeIs("users.create") active @endif" href="{{route('users.create')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Add new user
                    </a>
                    <a class="nav-link   @if(request()->routeIs("book_Issue.create")) active @endif" href="{{route('book_Issue.create')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Issue Books
                    </a>
                    <a class="nav-link   @if(request()->routeIs("book_Issue.index")) active @endif" href="{{route('book_Issue.index')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Book Issued List
                    </a>
                 
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