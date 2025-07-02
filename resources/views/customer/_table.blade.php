<div class="table-customer">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Name Customer</th>
                <th>No ID</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @if ($customers instanceof \Illuminate\Pagination\LengthAwarePaginator)
                @php($no = ($customers->currentPage() - 1) * $customers->perPage() + 1)
            @endif
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>
                        <div class="img-bx">
                            <img src="{{ $customer->image ? Storage::url($customer->image) : asset('img/default-avatar.jpg') }}"
                                alt="">
                        </div>
                    </td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->no_id }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>
                        <div class="dropdown-container">
                            <button class="dropdown-toggle">
                                Opsi <ion-icon name="chevron-down-outline" class="dropdown-icon"></ion-icon>
                            </button>

                            <ul class="action">
                                <li><a href="javascript:void(0)" onclick="info({{ $customer->id }})" >Edit</a></li>
                                <li><a href="javascript:void(0)" onclick="confirmDelete({{ $customer->id }})" >Hapus</a></li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <a class="detail" href="{{ route('customer.show', $customer->id) }}"
                            style="text-decoration:none;">Lihat Customer</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data customer</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="">
    @if ($customers instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $customers->links('vendor.pagination.custom') }}
    @endif
</div>
