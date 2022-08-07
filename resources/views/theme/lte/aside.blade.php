<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src={{asset("assets/$theme/dist/img/logo.png")}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">San Parrilla</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{asset("assets/$theme/dist/img/user2-160x160.jpg")}}  class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            @auth
              {{ auth()->user()->name}}
              {{ auth()->user()->lastName}}
            @endauth
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class=" fas fa-people-arrows"></i>
              
              <p>
                Personas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('cliente')}}" class="nav-link">
                  <i class="fas fa-user-check nav-icon"></i>
                  
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('domiciliario')}}" class="nav-link">
                  <i class="fas fa-motorcycle"></i>
                  <p>Domiciliarios</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class=" fas fa-utensils"></i>
              <p>
                Menú
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>
                    Administracion
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('categoria')}}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Categoria</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('subCategoria')}}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Sub Categoria</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{route('plato')}}" class="nav-link">
                  <i class="fas fa-concierge-bell nav-icon"></i>
                  <p>Platos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('adicional')}}" class="nav-link">
                  <i class="fas fa-concierge-bell nav-icon"></i>
                  <p>Adicionales</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">--San Parrilla--</li>  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  