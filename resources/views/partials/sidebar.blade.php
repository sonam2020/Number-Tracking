<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('admin/dist/img/N.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Number Tracking</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!--   Sidebar user panel (optional) -->
    <!--  <div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
    <!--    <div class="image">-->
    <!--      <img src="{{asset('/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">-->
    <!--    </div>-->
    <!--    <div class="info">-->
  
    <!--    </div>-->
    <!--  </div>-->

      <!-- SidebarSearch Form -->
      <!--<div class="form-inline">-->
      <!--  <div class="input-group" data-widget="sidebar-search">-->
      <!--    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">-->
      <!--    <div class="input-group-append">-->
      <!--      <button class="btn btn-sidebar">-->
      <!--        <i class="fas fa-search fa-fw"></i>-->
      <!--      </button>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!--<li class="nav-item {{ request()->routeIs('ticket.create') || request()->routeIs('ticket.list')  ? 'menu-open' : '' }}">-->
          <!--  <a href="#" class="nav-link {{ request()->routeIs('ticket.create') || request()->routeIs('ticket.list') ?'active':''}}">-->
          <!--    <i class="nav-icon fas fa-cogs"></i>-->
          <!--      <p>-->
          <!--        Ticket-->
          <!--        <i class="right fas fa-angle-left"></i>-->
          <!--      </p>-->

          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
          <!--     <li class="nav-item">-->
          <!--      <a href="{{route('ticket.create')}}" class="nav-link {{ request()->routeIs('ticket.create')?'active':''}}">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Create Ticket</p>-->
          <!--      </a>-->
          <!--    </li>-->
          <!--    <li class="nav-item">-->
          <!--      <a href="{{route('ticket.list')}}" class="nav-link {{ request()->routeIs('ticket.list')?'active':''}}">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>View Ticket</p>-->
          <!--      </a>-->
          <!--    </li>-->


          <!--  </ul>-->
          <!--</li>-->
          <li class="nav-item">
    <a href="{{ route('ticket.create') }}" class="nav-link {{ request()->routeIs('ticket.create') ? 'active' : '' }}">
        <!--<i class="far fa-circle nav-icon"></i>-->
        <i class="fa fa-ticket-alt nav-icon"></i>
        <p>Create Ticket</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('ticket.list') }}" class="nav-link {{ request()->routeIs('ticket.list') ? 'active' : '' }}">
        <!--<i class="far fa-circle nav-icon"></i>-->
        <!--<i class="fa fa-ticket-alt nav-icon"></i>-->
        <i class="fa fa-folder-open nav-icon"></i>


        <p>View Ticket</p>
    </a>
</li>
<!------------------------------------>
          <li class="nav-item ">
            <a href="{{route('area')}}" class="nav-link {{ request()->routeIs('area') ? 'active' : '' }}">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Area Management
              </p>
            </a>
          </li>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
