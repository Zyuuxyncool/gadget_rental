<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Zyuuxyn-Rental')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">


</head>

<body id="bodyTheme">
    <div class="container">

        <x-_sidebar></x-_sidebar>

        <!-- Main Content -->
        <div class="main">
            <!-- Topbar -->
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <!-- Theme Toggle Button -->
                <button class="theme-toggle-btn" onclick="toggleThemePanel()" aria-controls="theme-panel" aria-expanded="false">
                    <span class="sr-only"></span>
                    <ion-icon name="color-palette-outline"></ion-icon>
                </button>

                <!-- Theme Panel -->
                <div id="theme-panel" class="theme-panel">
                    <div class="theme-panel-header">
                        <span>Pilih Tema</span>
                        <button class="theme-panel-close" onclick="toggleThemePanel()">&times;</button>
                    </div>

                    <div class="theme-options">
                        <button class="theme-option" data-theme="template-1">
                            <div class="theme-option-preview">
                                <span style="background:#543f3f"></span>
                                <span style="background:#6a5151"></span>
                                <span style="background:#a5a5a5"></span>
                                <span style="background:#fff"></span>
                            </div>
                            <span class="theme-option-label">Coklat</span>
                        </button>
                        <button class="theme-option" data-theme="template-2">
                            <div class="theme-option-preview">
                                <span style="background:#537d5d;"></span>
                                <span style="background:#73946b"></span>
                                <span style="background:#9ebc8a"></span>
                                <span style="background:#fff"></span>
                            </div>
                            <span class="theme-option-label">Hijau</span>
                        </button>
                    </div>
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
    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    @stack('scripts')

</body>

</html>