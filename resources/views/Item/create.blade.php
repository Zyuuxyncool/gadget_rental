@extends('layouts/app')

@section('title', 'Tambah Produk')

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

    <div class="popup-overlay" id="popup">
        <div class="popup-box">
            <a href="{{ route ('item.index') }}"><button class="close-btn" onclick="closePopup()">✕</button></a>

            <form class="form-flex" action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-left">
                    <label for="nama">Nama Produk :</label>
                    <input type="" id="nama" name="name" placeholder="Masukan Nama Produk">

                    <label for="harga">Harga Produk :</label>
                    <input type="" id="harga" name="price" placeholder="Masukan Harga Produk" oninput="formatRupiah(this)">

                    <label for="deskripsi">Deksripsi Produk :</label>
                    <textarea id="deskripsi" name="description" placeholder="Masukan Deksripsi Produk"></textarea>
                </div>

                <div class="form-right" method="">
                    <div class="drop-area" id="drop_area">
                        <img src="{{ asset('icon/icons8-drag-and-drop-48.png') }}" alt="icon" />
                        <p>Drop/Drag an image Produk</p>
                        <!-- <input type="file" id="fileImage" accept="image/*" hidden> -->
                        <input type="file" name="file_image" id="file_input" onchange="this.form.submit()" accept="image/*" hidden>
                        <div id="preview_container"></div>
                    </div>
                    <button type="submit" class="add-btn">ADD Produk</button>
                </div>
            </form>
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
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $item->name }}</td>
                    <td>Rp.{{ $item->price }}</td>
                    <td>{{$item->description }}</td>
                    <td>
                        <img src="{{ asset('img/xiaomi14T.png') }}" alt="produk" class="product-img" style="width: 100px; height: 50px;">
                    </td>
                    <td>
                        <a href="{{ route('item.edit', $item->id) }}"><button class="edit-btn"><ion-icon name="create-outline"></ion-icon></i></button></a>
                    </td>
                    <td>
                        <button class="delete-btn"><ion-icon name="trash-outline"></ion-icon></button>
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
    e

    function formatRupiah(input){
        let value = input.value.replace(/\D/g, "");
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        input.value = value;
    }
</script>

@endpush