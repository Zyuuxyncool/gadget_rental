@extends('layouts/app')

@section('title', 'Create Customer')

@section('content')
<div class="customer">
    <div class="customer-header">
        <form action="" class="search">
            <label for="GET">
                <input type="text" name="name" placeholder="Search For Name Customer">
            <ion-icon name="search-outline" ></ion-icon>
            </label>
        </form>
        <div class="add-new-customer">
            <a href=""><ion-icon name="add-circle-outline"></ion-icon> Add Customer</a>
        </div>
    </div>

    <div class="popup-overlay" id="popup">
        <div class="popup-box">
            <a href="{{ route ('customer.index') }}"><button class="close-btn" onclick="closePopup()">✕</button></a>

            <form class="form-flex" action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-left">
                    <label for="nama">Nama Customer :</label>
                    <input type="text" id="nama" name="name" placeholder="Masukan Nama Customer">

                    <label for="phone">Phone Customer :</label>
                    <input type="text" id="phone" name="phone" placeholder="Masukan Nomer Telepon Customer" oninput="formatRupiah(this)">

                    <label for="deskripsi">Alamat Customer :</label>
                    <textarea id="deskripsi" name="address" placeholder="Masukan Masukan Alamat"></textarea>
                </div>

                <div class="form-right">
                    <div class="drop-area" id="drop_area">
                        <img src="{{ asset('icon/icons8-drag-and-drop-48.png') }}" alt="icon" />
                        <p>Drop/Drag an Profile Image Customer</p>
                        <!-- <input type="file" id="fileImage" accept="image/*" hidden> -->
                        <input type="file" name="file_image" id="file_input" onchange="this.form.submit()" accept="image/*" hidden>
                        <div id="preview_container"></div>
                    </div>
                    <button type="submit" class="add-btn">ADD Customer</button>
                </div>

            </form>
            <div class="camera">
            <video id="camera-preview" autoplay style="width: 200px; height: 150px; background: #000;"></video>
                    <button id="start-camera">aktifkan camera</button>
            </div>
        </div>

    </div>

    <div class="table-customer">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <th>Name Customer</th>
                    <th>No ID</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer) 
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->no_id}}</td>
                    <td>{{ $customer->phone}}</td>
                    <td>{{ $customer->address}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</div>
@endsection
@push('scripts')
<script>
    document.getElementById('start-camera').addEventListener('click', async () => {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        document.getElementById('camera-preview').srcObject = stream;
    } catch (error) {
        console.error('Gagal mengakses kamera:', error);
    }
});

</script>
    
@endpush