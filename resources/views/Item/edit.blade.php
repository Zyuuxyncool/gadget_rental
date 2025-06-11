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
            <form class="form-flex" action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-left">
                    <label for="nama">Edit Nama Produk :</label>
                    <input value="{{ $item->name }}" type="text" id="nama" name="name" placeholder="Masukan Nama Produk">

                    <label for="harga">Edit Harga Produk :</label>
                    <input value="{{ $item->price }}" type="text" id="harga" name="price" placeholder="Masukan Harga Produk">

                    <label for="deskripsi">Edit Deksripsi Produk :</label>
                    <textarea id="deskripsi" name="description" placeholder="Masukan Deksripsi Produk">{{ $item->description }}</textarea>
                </div>

                <div class="form-right" method="">
                    <div class="drop-area" id="drop_area">
                        <img src="{{ asset('icon/icons8-drag-and-drop-48.png') }}" alt="icon" />
                        <p>Drop/Drag an image Produk</p>
                        <!-- <input type="file" id="fileInput" accept="image/*" hidden> -->
                        <input type="file" name="file_image" id="file_input" onchange="this.form.submit()" accept="image/*" hidden>
                        <div id="preview_container"></div>
                    </div>

                    <button type="submit" class="add-btn">Edit Produk</button>
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
                @foreach($items as $produk)
                <tr>
                    <td>{{ $loop -> iteration }}</td>
                    <td>{{ $produk->name }}</td>
                    <td>Rp.{{ $produk->price }}</td>
                    <td>{{ $produk->description }}</td>
                    <td>
                        <img src="{{ asset('img/xiaomi14T.png') }}" alt="produk" class="product-img" style="width: 100px; height: 100px; object-fit:contain;">
                    </td>
                    <td>
                        <a href=""><button class="edit-btn"><ion-icon name="create-outline"></ion-icon></i></button></a>
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
    const dropArea = document.getElementById("drop_area");
    const fileInput = document.getElementById("file_input");
    const previewContainer = document.getElementById("preview_container");

    // Mencegah perilaku default untuk event drag and drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, e => e.preventDefault());
    });

    // Handle drop
    dropArea.addEventListener("drop", handleDrop);

    function handleDrop(e) {
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith("image/")) {
            previewImage(file);
        }
    }

    // Allow Touch, Untuk Membuka Peiliahan Gambar
    dropArea.addEventListener("click", () => fileInput.click()); //click Input
    fileInput.addEventListener("change", () => {
        const file = fileInput.files[0];
        if (file && file.type.startsWith("image/")) {
            previewImage(file);
        }
    });

    function previewImage(file) {
        // Hapus Elemen Gambar dan paragraph asli
        const dropImage = dropArea.querySelector('img');
        const dropText = dropArea.querySelector('p');
        if (dropImage) dropImage.remove();
        if (dropText) dropText.remove();

        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.innerHTML = `<img src="${e.target.result}" style="max-width: 100px; max-height: 100px; margin-top: 10px; height: 100%; width: auto;" alt="Preview">`;
        };

        reader.readAsDataURL(file);

    }
</script>

@endpush