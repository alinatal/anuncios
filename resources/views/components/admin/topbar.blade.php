<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <form action="{{route('logout')}}" method="POST">
                @method('POST')
                @csrf
                <button class="btn btn-primary">Cerrar sesión</button>
            </form>
        </li>
    </ul>

</nav>
<!-- End of Topbar -->
