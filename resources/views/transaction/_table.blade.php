<div class="table-transaction">

    <div style="font-weight: 500; color: var(--color5); margin-bottom: 10px; text-align: left;">
        Jumlah data: {{ $transactions->total() ?? $transactions->count() }}
    </div>
    <div class="tab-nav">
        <a href="javascript:void(0)" data-statuses="belum-kembali"
            class="tab-link tab-link-status{{ request('statuses', 'belum-kembali') == 'belum-kembali' ? ' active' : '' }}">Belum
            Kembali</a>
        <a href="javascript:void(0)" data-statuses="terlambat"
            class="tab-link tab-link-status{{ request('statuses') == 'terlambat' ? ' active' : '' }}">Terlambat</a>
        <a href="javascript:void(0)" data-statuses="dibatalkan"
            class="tab-link tab-link-status{{ request('statuses') == 'dibatalkan' ? ' active' : '' }}">Dibatalkan</a>
        <a href="javascript:void(0)" data-statuses="history"
            class="tab-link tab-link-status{{ request('statuses') == 'history' ? ' active' : '' }}">History
            Transaksi</a>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Nama Item</th>
                <th>Total</th>
                <th>Tanggal Sewa</th>
                <th>Waktu Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @if ($transactions instanceof \Illuminate\Pagination\LengthAwarePaginator)
                @php($no = ($transactions->currentPage() - 1) * $transactions->perPage() + 1)
            @endif
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $transaction->customer->name ?? '-' }}</td>
                    <td>{{ $transaction->item->name ?? '-' }}</td>
                    <td>Rp. {{ number_format($transaction->price, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                    <td>{{ $transaction->time }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->return_date)->format('d-m-Y') }}</td>
                    <td>
                        <select id="status-{{ $transaction->id }}" onchange="update_status({{ $transaction->id }})">
                            <option value="0" {{ $transaction->status == 0 ? 'selected' : '' }}>Belum Kembali
                            </option>
                            <option value="1" {{ $transaction->status == 1 ? 'selected' : '' }}>Terlambat</option>
                            <option value="2" {{ $transaction->status == 2 ? 'selected' : '' }}>Dibatalkan
                            </option>
                            <option value="3" {{ $transaction->status == 3 ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 20px; color: var(--color5);">
                        No item found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex flex-row justify-content-center">
    @if ($transactions instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $transactions->links('vendor.pagination.custom') }}
    @endif
</div>
