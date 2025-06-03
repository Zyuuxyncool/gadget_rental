<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Zyuuxyn-Rental')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


  </head>
    
    @stack('styles')
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="repeat-outline"></ion-icon>
                        </span>
                        <span class="title">Zyuuxyn Rental</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <span class="icon">
                            <ion-icon name="speedometer-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('item.index') }}" class="{{ request()->routeIs('item.index') ? 'active' : '' }}">
                        <span class="icon">
                            <ion-icon name="pricetags-outline"></ion-icon>
                        </span>
                        <span class="title">Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.index') }}" class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customer</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('transaction.index') }}" class="{{ request()->routeIs('transaction.index') ? 'active' : '' }}">
                        <span class="icon">
                            <ion-icon name="swap-horizontal-outline"></ion-icon>
                        </span>
                        <span class="title">Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php" class="logout-button">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                    <div class="search">
                        <label>
                            <input class="search" type="text" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>
            </div>

            <!-- Content Section -->
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />

<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>

    @stack('scripts')
</body>

</html>