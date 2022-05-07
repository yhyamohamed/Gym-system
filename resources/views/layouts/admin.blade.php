@extends('layouts.app')

@section('sidebar-nav')
<li class="nav-item">
  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
</li>
@endsection

@section('sidebar')
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/') }}" class="brand-link">
    <span class="brand-text font-weight-light">Gym System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Starter Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a id="gym-managers" href="{{ route('gym_managers.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Gym Managers</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="city-managers" href="{{ route('city_managers.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>City Managers</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="users" href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="cities" href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Cities</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="gyms" href="{{ route('gyms.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Gyms</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="training_packages" href="{{ route('training_packages.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Training Packages</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="training_sessions" href="{{ route('training_sessions.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Training Sessions</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="coaches" href="{{ route('coaches.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Coaches</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="attendance" href="{{ route('attendances.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Attendance</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="subscriptions" href="{{ route('subscriptions.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buy Package for User</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="revenue" href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Revenue </p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@yield('page-header')</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            @yield('left-breadcrumb')
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      @yield('table-content')

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2022</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->
@endsection