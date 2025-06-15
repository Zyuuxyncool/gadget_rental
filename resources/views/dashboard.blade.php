@extends('layouts/app')

@section('title', 'Dashboard')

@section('content')
<div class="card-box">
    <div class="card">
        <div>
            <div class="numbers">{{ $items }}</div>
            <div class="card-name">Produk</div>
        </div>

        <div class="icon-bx">
            <ion-icon name="cube-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">{{ $customers }}</div>
            <div class="card-name">Customer</div>
        </div>

        <div class="icon-bx">
            <ion-icon name="people-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">284</div>
            <div class="card-name">History Transaksi</div>
        </div>

        <div class="icon-bx">
            <ion-icon name="time-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">Rp. 1.000.000</div>
            <div class="card-name">Penghasilan</div>
        </div>

        <div class="icon-bx">
            <ion-icon name="wallet"></ion-icon>
        </div>
    </div>
</div>

<div class="details">
    <div class="recent-orders">
        <div class="card-header">
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
                <td><span class="status belum-kembali">Belum kembali</span></td>
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

    <div class="recent-customers">
        <div class="card-header">
            <h2>Customer Terbaru</h2>
            <a href="{{ route('customer.index') }}" class="btn">Lihat Semua</a>
        </div>
        <table>
            <tr>
                <td width="60px">
                    <div class="img-bx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="img-bx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="img-bx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="img-bx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="img-bx">
                        <img src="{{ asset('img/default-avatar.jpg') }}" alt="">
                    </div>
                </td>
                <td>
                    <h4>Muhammad Andreas Athallah Saifa Anam<br><span>Web Developer</span></h4>
                </td>
            </tr>
            <tr>
                <td width="60px">
                    <div class="img-bx">
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