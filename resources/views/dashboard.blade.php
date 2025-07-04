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
                <div class="numbers">{{ $customers_count }}</div>
                <div class="card-name">Customer</div>
            </div>

            <div class="icon-bx">
                <ion-icon name="people-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">{{ $transactions }}</div>
                <div class="card-name">History Transaksi</div>
            </div>

            <div class="icon-bx">
                <ion-icon name="time-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">Rp. {{  number_format($transactions_total, 0, ',', '.') }}</div>
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
                <h2>Daftar Pengembalian Hari Ini</h2>
                <a href="{{ route('transaction.index') }}" class="btn">Lihat Semua</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Nama Customer</td>
                        <td>Item</td>
                        <td>Tanggal Kembali</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todayTrx as $trx)
                        <tr>
                            <td>{{ $trx->customer->name ?? '-' }}</td>
                            <td>{{ $trx->item->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->return_date)->format('d-m-Y') }}</td>
                            <td>
                                @if ($trx->status == 0)
                                    <span class="status belum-kembali">Belum Kembali</span>
                                @elseif ($trx->status == 1)
                                    <span class="status terlambat">Terlambat</span>
                                @elseif ($trx->status == 2)
                                    <span class="status dibatalkan">Dibatalkan</span>
                                @else
                                    <span class="status selesai">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px; color: var(--color5);">
                                Tidak ada Daftar Pengembalian Hari Ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="recent-customers">
            <div class="card-header">
                <h2>Customer Terbaru</h2>
                <a href="{{ route('customer.index') }}" class="btn">Lihat Semua</a>
            </div>
            <table>
                @foreach ($customer_limits as $customer_limit)
                    <tr>
                        <td width="60px">
                            <div class="img-bx">
                                <img src="{{ $customer_limit->image ? Storage::url($customer_limit->image) : asset('img/default-avatar.jpg') }}"
                                    alt="">
                            </div>
                        </td>
                        <td>
                            <h4>{{ $customer_limit->name }}<br><span>{{ $customer_limit->address ?? 'Tidak Ada Alamat' }}</span>
                            </h4>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


    </div>

@endsection
