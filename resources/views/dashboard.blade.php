@extends('layouts/app')

@section('title', 'Dashboard')

@section('content')
<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers">1,504</div>
            <div class="cardName">Produk</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cube-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">80</div>
            <div class="cardName">Customer</div>
        </div>

        <div class="iconBx">
            <ion-icon name="people-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">284</div>
            <div class="cardName">History Transaksi</div>
        </div>

        <div class="iconBx">
            <ion-icon name="time-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">Rp. 1.000.000</div>
            <div class="cardName">Penghasilan</div>
        </div>

        <div class="iconBx">
            <ion-icon name="wallet"></ion-icon>
        </div>
    </div>
</div>

<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Transaksi Terbaru</h2>
            <a href="{{ route('transaction.index') }}" class="btn">Lihat Semua</a>
        </div>
        <thead>
            <table>
                <tr>
                    <td>Nama Customer</td>
                    <td>Item</td>
                    <td>Tanggal Kembali</td>
                    <td>Status</td>
                </tr>
        </thead>
        <tbody>

            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>BMW M4</td>
                <td>2025-12-11</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <tr>
                <td>Zelina Irene Chrisani</td>
                <td>Villa</td>
                <td>2025-08-10</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <tr>
                <td>Evan Adhiarja Yohanes</td>
                <td>Pesawat Pribadi</td>
                <td>2026-01-05</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <tr>
                <td>Muhammad Raihan Al Irsyad</td>
                <td>Mazda MX-5</td>
                <td>2025-12-11</td>
                <td><span class="status dibatalkan">Di Batalkan</span></td>
            </tr>
            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>Alphard</td>
                <td>2025-07-11</td>
                <td><span class="status belumKembali">Belum kembali</span></td>
            </tr>
            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>BMW M4</td>
                <td>2025-12-11</td>
                <td><span class="status terlambat">Terlambat</span></td>
            </tr>
            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>BMW M4</td>
                <td>2025-12-11</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>BMW M4</td>
                <td>2025-12-11</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>BMW M4</td>
                <td>2025-12-11</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>BMW M4</td>
                <td>2025-12-11</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>BMW M4</td>
                <td>2025-12-11</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <tr>
                <td>Muhammad Andreas Athallah Saifa Anam</td>
                <td>BMW M4</td>
                <td>2025-12-11</td>
                <td><span class="status selesai">Sudah Selesai</span></td>
            </tr>
            <!-- <tr>
                    <td colspan="3" style="text-align:center">Tidak Ada Pesanan</td>
                </tr> -->
        </tbody>
        </table>
    </div>

    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>Customer Terbaru</h2>
            <a href="{{ route('customer.index') }}" class="btn">Lihat Semua</a>
        </div>
        <table>
            <tr>
                <td width="60px">
                    <div class="imgBx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="imgBx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="imgBx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
                        <tr>
                <td width="60px">
                    <div class="imgBx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
                        <tr>
                <td width="60px">
                    <div class="imgBx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
                        <tr>
                <td width="60px">
                    <div class="imgBx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
    </div>

</div>

@endsection