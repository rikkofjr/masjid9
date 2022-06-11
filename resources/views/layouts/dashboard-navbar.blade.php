<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('admin.index')}}"><i class="fas fa-home"></i></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('admin.index')}}"><i class="fas fa-home"></i></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            @can('dkm-create')    
            <li class="menu-header">DKM</li>
            <!--Jamaah-->
            
            @endcan
            @can('bendahara-create')
            <!--Bendahara-->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i> <span>Bendhara</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.kas-penerimaan.index')}}">Penerimaan</a></li>
                    <li><a class="nav-link" href="{{route('admin.kas-pengeluaran.index')}}">Pengeluaran</a></li>
                    <li><a class="nav-link" href="{{route('admin.zis.dashboard')}}">Zis</a></li>
                </ul>
            </li>
            @endcan
            @can('outsource-create')
            <li class="menu-header">Outsource Input</li>
            <!--Zis-->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i> <span>ZIS</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.zis.create')}}">Tambah Penerimaan ZIS</a></li>
                    <li><a class="nav-link" href="{{route('admin.zis.index')}}">Penerimaan Tahun Ini</a></li>
                    <li><a class="nav-link" href="{{route('admin.zis.dashboard')}}">Management ZIS</a></li>
                </ul>
            </li>
            <!--Qurban-->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class=""><img src="{{asset('img/svg/kambing.svg')}}" width="20px" alt=""></i><span>Qurban</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.qurban.create')}}">Tambah Penerimaan</a></li>
                    <li><a class="nav-link" href="{{route('admin.qurban.index')}}">Penerimaan Tahun Ini</a></li>
                    <li><a class="nav-link" href="{{route('admin.qurban.dashboard')}}">Dashboard Qurban</a></li>
                </ul>
            </li>
            <!--Database Jamaah-->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Jamaah Manajemen</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.alamat-jamaah.index')}}">Alamat Jamaah</a></li>
                    <li><a class="nav-link" href="{{route('admin.data-jamaah.index')}}">Detail Jamaah</a></li>
                </ul>
            </li>
            @endcan
            @role('Admin')
            <li class="menu-header">Dashboard Admin</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>User Manajemen</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('admin.users.index')}}">User</a></li>
                    <li><a class="nav-link" href="{{route('admin.roles.index')}}">Role</a></li>
                </ul>
            </li>
            @endrole
        </ul>
    </aside>
</div>