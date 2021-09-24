  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-bold">NEW APP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/index.jpeg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{usefullName()}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                MENU
                <i class=""></i>
              </p>
            </a>
            @can('admin')
            <li class="nav-item menu-open">
                <a class="nav-link bg-blue">
                    <i class="far fa-circle nav-icon"></i>
                    <i class="fas fa-angle-left right"></i>
                    <p>Habilitations</p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route("habilitation")}}" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Utilisateurs</p>
                      </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="fas fa-lock nav-icon"></i>
                          <p>Permissions</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item menu-open">
                <a class="nav-link bg-blue">
                    <i class="far fa-circle nav-icon"></i>
                    <i class="fas fa-angle-left right"></i>
                    <p>Gestion Articles</p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{route("article")}}" class="nav-link">
                        <i class="fas fa-archive nav-icon"></i>
                        <p>Articles</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route("type_article")}}" class="nav-link">
                        <i class="fas fa-th-list nav-icon"></i>
                        <p>Type Article</p>
                      </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="fas fa-money-check-alt nav-icon"></i>
                          <p>Tarifications</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('employe')
            <!--<li class="nav-header">LOCATION</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-address-card"></i>
                  <p>Gestion Clients</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>Gestion Locations</p>
                </a>
            </li>
            <li class="nav-header">CLASSE</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-money-bill-alt"></i>
                  <p>Gestion Paiements</p>
                </a>
            </li>-->
            @endcan
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>