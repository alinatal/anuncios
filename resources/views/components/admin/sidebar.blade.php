<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">AL Panel <sup>1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->is('admin')) active @endif">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Contenido
    </div>

    <li class="nav-item @if(request()->is('admin/ad*')) active @endif">
        <a class="nav-link" href="{{route('admin.ad.index')}}">
            <i class="fa fa-address-card" aria-hidden="true"></i>
            <span>Anuncios</span></a>
    </li>

    <li class="nav-item @if(request()->is('admin/category*')) active @endif">
        <a class="nav-link" href="{{route('admin.category.index')}}">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>Categorías</span>
        </a>
    </li>

    <li class="nav-item @if(request()->is('admin/sponsor*')) active @endif">
        <a class="nav-link" href="{{route('admin.sponsor.index')}}">
            <i class="fas fa-briefcase"></i>
            <span>Patrocinadores</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Ajustes
    </div>


    <!-- Nav Item - Charts -->
    <li class="nav-item @if(request()->is('admin/user*')) active @endif">
        <a class="nav-link" href="{{route('admin.user.index')}}">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>Usuarios</span>
        </a>
    </li>

    <li class="nav-item @if(request()->is('admin/page*')) active @endif">
        <a class="nav-link" href="{{route('admin.pages.index')}}">
            <i class="fa fa-file" aria-hidden="true"></i>
            <span>Páginas</span>
        </a>
    </li>

    <li class="nav-item @if(request()->is('admin/settings*')) active @endif">
        <a class="nav-link" href="{{route('admin.settings.edit')}}">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <span>General</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
