<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Add this list item for the logout link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" >
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
        <!-- End of logout link -->

        <!-- You can add other navbar items here if needed -->
    </ul>
</nav>
