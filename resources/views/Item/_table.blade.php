    <div class="table-products">
        <table id="productsTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Edit Produk</th>
                    <th>Hapus Produk</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    @php($no = ($items->currentPage() - 1) * $items->perPage() + 1)
                @endif
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <img src="{{ Storage::url($item->image) }}" alt="produk" class="product-img"
                                style="width: 100px; height: 50px; object-fit:cover;">
                        </td>
                        <td>
                            <button class="edit-btn" onclick="info({{ $item->id }})"><ion-icon
                                    name="create-outline"></ion-icon></button>
                        </td>
                        <td>
                            <button class="delete-btn" onclick="confirm_delete({{ $item->id }})"><ion-icon
                                    name="trash-outline"></ion-icon></button>
                            <!-- href="javascript:void(0)" -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px; color: var(--color5);">
                            No item found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="d-flex flex-row justify-content-center">
        @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $items->links('vendor.pagination.custom') }}
        @endif
    </div>
