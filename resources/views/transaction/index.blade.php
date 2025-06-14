@extends('layouts/app')

@section('title', 'transaction')

@section('content')

@php
// Ambil nilai tab dari query parameter, default 'belum-kembali'
$tab = request()->query('tab', 'belum-kembali');
@endphp


<div class="transaction">

    <div class="transaction-header">

        <form method="POST" action="{{ url()->current() }}" style="display: flex; align-items: center; gap: 8px; margin-bottom:0; color: var(--white);">
            <input type="hidden" name="tab" value="{{ $tab }}">

            <div class="search">
                <label>
                    <input class="search" type="text" placeholder="Search here for Customer">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="search">
                <label>
                    <input class="search" type="text" placeholder="Search here for Item">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <input
                type="date"
                name="tanggal"
                value="{{ request('tanggal', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                style="height: 44px; width:150px; color: var(--template1-color5); font-weight: 500; font-size: 16px; border: 1px solid var(--chocolate-brown); border-radius: 6px; padding: 6px 10px;">
            <button type="submit" class="form-submit-transaction" style="height: 44px; padding: 0 16px;">
                Cari
            </button>
        </form>

        <div class="sub-header" style="display: flex; align-items: center; margin-left: 10px;">
            <a href="{{ route('transaction.create') }}" class="add-new-transaction-btn">
                <ion-icon name="add-circle-outline"></ion-icon>
                Tambah Transaksi </a>

            @if ($tab == 'history')
            <form method="GET" action="{{ url()->current() }}/export" style="margin-left: 12px;">
                <input type="hidden" name="tab" value="history">
                <input type="hidden" name="tanggal" value="{{ request('tanggal', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                <button type="submit" class="export-button">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0,0,256,256">
                        <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                            <g transform="scale(5.12,5.12)">
                                <path d="M28.875,0c-0.01953,0.00781 -0.04297,0.01953 -0.0625,0.03125l-28,5.3125c-0.47656,0.08984 -0.82031,0.51172 -0.8125,1v37.3125c-0.00781,0.48828 0.33594,0.91016 0.8125,1l28,5.3125c0.28906,0.05469 0.58984,-0.01953 0.82031,-0.20703c0.22656,-0.1875 0.36328,-0.46484 0.36719,-0.76172v-5h17c1.09375,0 2,-0.90625 2,-2v-34c0,-1.09375 -0.90625,-2 -2,-2h-17v-5c0.00391,-0.28906 -0.12109,-0.5625 -0.33594,-0.75391c-0.21484,-0.19141 -0.50391,-0.28125 -0.78906,-0.24609zM28,2.1875v4.34375c-0.13281,0.27734 -0.13281,0.59766 0,0.875v35.40625c-0.02734,0.13281 -0.02734,0.27344 0,0.40625v4.59375l-26,-4.96875v-35.6875zM30,8h17v34h-17v-5h4v-2h-4v-6h4v-2h-4v-5h4v-2h-4v-5h4v-2h-4zM36,13v2h8v-2zM6.6875,15.6875l5.46875,9.34375l-5.96875,9.34375h5l3.25,-6.03125c0.22656,-0.58203 0.375,-1.02734 0.4375,-1.3125h0.03125c0.12891,0.60938 0.25391,1.02344 0.375,1.25l3.25,6.09375h4.96875l-5.75,-9.4375l5.59375,-9.25h-4.6875l-2.96875,5.53125c-0.28516,0.72266 -0.48828,1.29297 -0.59375,1.65625h-0.03125c-0.16406,-0.60937 -0.35156,-1.15234 -0.5625,-1.59375l-2.6875,-5.59375zM36,20v2h8v-2zM36,27v2h8v-2zM36,35v2h8v-2z"></path>
                            </g>
                        </g>
                    </svg>
                    Export to Excel
                </button>
            </form>
            @endif
        </div>
    </div>
    

    <div class="table-transaction">
        @if ($tab == 'belum-kembali')
        <div class="cardHeaderTransaction">

            <div class="tab-nav">
                <a href="{{ url()->current() }}?tab=belum-kembali" class="tab-link {{ $tab == 'belum-kembali' ? 'active' : '' }}">
                    Belum Kembali
                </a>
                <a href="{{ url()->current() }}?tab=terlambat" class="tab-link {{ $tab == 'terlambat' ? 'active' : '' }}">
                    Terlambat
                </a>
                <a href="{{ url()->current() }}?tab=dibatalkan" class="tab-link {{ $tab == 'dibatalkan' ? 'active' : '' }}">
                    Dibatalkan
                </a>
                <a href="{{ url()->current() }}?tab=history" class="tab-link {{ $tab == 'history' ? 'active' : '' }}">
                    History Transaksi
                </a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Tanggal Sewa</th>
                    <th>Waktu Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 20; $i++)
                    @php
                    $tanggalSewa=now()->subDays($i + 30);
                    $durasi = rand(1, 7); // contoh durasi random 1-7 hari
                    $tanggalKembali = $tanggalSewa->copy()->addDays($durasi);
                    // Generate waktu sewa random
                    $jam = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT);
                    $menit = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
                    $detik = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
                    $waktuSewa = "$jam:$menit:$detik";
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>Pembeli {{ $i }}</td>
                        <td>Produk {{ $i }}</td>
                        <td>Rp. {{ number_format($i * 15000, 0, ',', '.') }}</td>
                        <td>{{ $tanggalSewa->format('d-m-Y') }}</td>
                        <td>{{ $waktuSewa }}</td>
                        <td>{{ $tanggalKembali->format('d-m-Y') }}</td>
                        <td>
                            <select>
                                <option selected>Belum Kembali</option>
                                <option value="">Terlambat</option>
                                <option value="">Dibatalkan</option>
                                <option value="">Selesai</option>
                            </select>
                        </td>
                    </tr>
                    @endfor
            </tbody>
        </table>

        @elseif ($tab == 'terlambat')
        <div class="cardHeaderTransaction">
            <div class="tab-nav">
                <a href="{{ url()->current() }}?tab=belum-kembali" class="tab-link {{ $tab == 'belum-kembali' ? 'active' : '' }}">
                    Belum Kembali
                </a>
                <a href="{{ url()->current() }}?tab=terlambat" class="tab-link {{ $tab == 'terlambat' ? 'active' : '' }}">
                    Terlambat
                </a>
                <a href="{{ url()->current() }}?tab=dibatalkan" class="tab-link {{ $tab == 'dibatalkan' ? 'active' : '' }}">
                    Dibatalkan
                </a>
                <a href="{{ url()->current() }}?tab=history" class="tab-link {{ $tab == 'history' ? 'active' : '' }}">
                    History Transaksi
                </a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Tanggal Sewa</th>
                    <th>Waktu Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 20; $i++)
                    @php
                    $tanggalSewa=now()->subDays($i + 30);
                    $durasi = rand(1, 7); // contoh durasi random 1-7 hari
                    $tanggalKembali = $tanggalSewa->copy()->addDays($durasi);
                    // Generate waktu sewa random
                    $jam = str_pad(rand(0, 23), 2, '0');
                    $menit = str_pad(rand(0, 59), 2, '0');
                    $detik = str_pad(rand(0, 59), 2, '0');
                    $waktuSewa = "$jam:$menit:$detik";
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>Pembeli {{ $i }}</td>
                        <td>Produk {{ $i }}</td>
                        <td>Rp. {{ number_format($i * 15000, 0, ',', '.') }}</td>
                        <td>{{ $tanggalSewa->format('d-m-Y') }}</td>
                        <td>{{ $waktuSewa }}</td>
                        <td>{{ $tanggalKembali->format('d-m-Y') }}</td>
                        <td>
                            <select>
                                <option value="">Belum Kembali</option>
                                <option selected>Terlambat</option>
                                <option value="">Dibatalkan</option>
                                <option value="">Selesai</option>
                            </select>
                        </td>
                    </tr>
                    @endfor
            </tbody>
        </table>

        @elseif ($tab == 'dibatalkan')
        <div class="cardHeaderTransaction">
            <div class="tab-nav">
                <a href="{{ url()->current() }}?tab=belum-kembali" class="tab-link {{ $tab == 'belum-kembali' ? 'active' : '' }}">
                    Belum Kembali
                </a>
                <a href="{{ url()->current() }}?tab=terlambat" class="tab-link {{ $tab == 'terlambat' ? 'active' : '' }}">
                    Terlambat
                </a>
                <a href="{{ url()->current() }}?tab=dibatalkan" class="tab-link {{ $tab == 'dibatalkan' ? 'active' : '' }}">
                    Dibatalkan
                </a>
                <a href="{{ url()->current() }}?tab=history" class="tab-link {{ $tab == 'history' ? 'active' : '' }}">
                    History Transaksi
                </a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Tanggal Sewa</th>
                    <th>Waktu Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 20; $i++)
                    @php
                    $tanggalSewa=now()->subDays($i + 30);
                    $durasi = rand(1, 7); // contoh durasi random 1-7 hari
                    $tanggalKembali = $tanggalSewa->copy()->addDays($durasi);
                    // Generate waktu sewa random
                    $jam = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT);
                    $menit = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
                    $detik = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
                    $waktuSewa = "$jam:$menit:$detik";
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>Pembeli {{ $i }}</td>
                        <td>Produk {{ $i }}</td>
                        <td>Rp. {{ number_format($i * 15000, 0, ',', '.') }}</td>
                        <td>{{ $tanggalSewa->format('d-m-Y') }}</td>
                        <td>{{ $waktuSewa }}</td>
                        <td>{{ $tanggalKembali->format('d-m-Y') }}</td>
                        <td>
                            <select>
                                <option value="">Belum Kembali</option>
                                <option value="">Terlambat</option>
                                <option selected>Dibatalkan</option>
                                <option value="">Selesai</option>
                            </select>
                        </td>
                    </tr>
                    @endfor
            </tbody>
        </table>

        @elseif ($tab == 'history')
        <div class="cardHeaderTransaction">
            <div class="tab-nav">
                <a href="{{ url()->current() }}?tab=belum-kembali" class="tab-link {{ $tab == 'belum-kembali' ? 'active' : '' }}">
                    Belum Kembali
                </a>
                <a href="{{ url()->current() }}?tab=terlambat" class="tab-link {{ $tab == 'terlambat' ? 'active' : '' }}">
                    Terlambat
                </a>
                <a href="{{ url()->current() }}?tab=dibatalkan" class="tab-link {{ $tab == 'dibatalkan' ? 'active' : '' }}">
                    Dibatalkan
                </a>
                <a href="{{ url()->current() }}?tab=history" class="tab-link {{ $tab == 'history' ? 'active' : '' }}">
                    History Transaksi
                </a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Item</th>
                    <th>Total</th>
                    <th>Tanggal Sewa</th>
                    <th>Waktu Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 20; $i++)
                    @php
                    $tanggalSewa=now()->subDays($i + 30);
                    $durasi = rand(1, 7); // contoh durasi random 1-7 hari
                    $tanggalKembali = $tanggalSewa->copy()->addDays($durasi);
                    // Generate waktu sewa random
                    $jam = str_pad(rand(0, 23), 2, '0', STR_PAD_LEFT);
                    $menit = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
                    $detik = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);
                    $waktuSewa = "$jam:$menit:$detik";
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>Pembeli {{ $i }}</td>
                        <td>Produk {{ $i }}</td>
                        <td>Rp. {{ number_format($i * 15000, 0, ',', '.') }}</td>
                        <td>{{ $tanggalSewa->format('d-m-Y') }}</td>
                        <td>{{ $waktuSewa }}</td>
                        <td>{{ $tanggalKembali->format('d-m-Y') }}</td>
                        <td>
                            <select>
                                <option value="">Belum Kembali</option>
                                <option value="">Terlambat</option>
                                <option value="">Dibatalkan</option>
                                <option selected>Selesai</option>
                            </select>
                        </td>
                    </tr>
                    @endfor
            </tbody>
        </table>
        @endif
    </div>
</div>

@endsection