@extends('layouts/app')

@section('title', 'Produk')

@section('content')

<div class="products">

    <div class="products-header">
        <div class="select-wrapper">
            <select class="Show" id="showSelect">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <ion-icon id="selectIcon" name="chevron-down-circle-outline"></ion-icon>
        </div>

        <div class="add-product">
            <a href="{{ route('item.create') }}" class="add-product-btn">
                <ion-icon name="add-circle-outline"></ion-icon>
                Add Produk
            </a>
        </div>

    </div>



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
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>Rp. {{ $item->price }}</td>
                    <td>{{$item->description }}</td>
                    <td>
                        <img src="{{ Storage::url($item->image) }}" alt="produk" class="product-img" style="width: 100px; height: 50px;">
                    </td>
                    <td>
                        <a href="{{ route('item.edit', $item->id) }}"><button class="edit-btn"><ion-icon name="create-outline"></ion-icon></i></button></a>
                    </td>
                    <td>

                        <button class="delete-btn" onclick="delete_data({{ $item->id }})" href="javascript:void(0)"><ion-icon name="trash-outline"></ion-icon></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




@endsection

@push('scripts')
<script>
    let delete_data = (id) => {
        $.post("{{ url('item') }}/" + id, {
            _token: '{{ csrf_token() }}',
            _method: 'delete'
        }, () => {
            alert('Berhasil dihapus');
            window.location.reload();
        });
    }
    // document.getElementById('openModalBtn').onclick = function(e) {
    //     e.preventDefault();
    //     document.getElementById('addProductModal').style.display = 'block';
    // };
    // document.getElementById('closeModalBtn').onclick = function() {
    //     document.getElementById('addProductModal').style.display = 'none';
    // };
    // window.onclick = function(event) {
    //     var modal = document.getElementById('addProductModal');
    //     if (event.target == modal) {
    //         modal.style.display = "none";
    //     }
    // };
</script>
@endpush