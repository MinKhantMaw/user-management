 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>


    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <form action="{{ route('logout') }}" method="POST">
             @csrf
             <button class="btn btn-danger">Logout</button>
        </form>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">


      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
