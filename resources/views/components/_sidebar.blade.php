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