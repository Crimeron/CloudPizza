<script src="https://kit.fontawesome.com/dc0c420e8c.js" crossorigin="anonymous"></script>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin" class="brand-link">
      <img src="/CloudPizza/App/views/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADMIN PANEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin?pages=pizzas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pizzas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin?pages=desserts" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Desserts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin?pages=drinks" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Drinks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin?pages=sauces" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sauces</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="admin?pages=orders" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>Orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin?pages=users" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="admin?pages=charts" class="nav-link">
              <i class="nav-icon fa fa-chart-simple"></i>
              <p>Charts</p>
            </a>
          </li>
        </ul>
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
