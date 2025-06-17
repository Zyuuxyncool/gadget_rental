@extends('layouts/app')

@section('title', 'Create Customer')

@section('content')
    <div class="customer">
        <div class="customer-header">
            <form action="" class="search">
                <label for="GET">
                    <input type="text" name="name" placeholder="Search For Name Customer">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </form>
            <div class="add-new-customer">
                <a href=""><ion-icon name="add-circle-outline"></ion-icon> Add Customer</a>
            </div>
        </div>

        <div class="popup-overlay" id="popup">
            <div class="popup-box">
                <a href="{{ route('customer.index') }}"><button class="close-btn" onclick="closePopup()">✕</button></a>

                <form class="form-flex" action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-left">
                        <label for="nama">Nama Customer :</label>
                        <input type="text" id="nama" name="name" placeholder="Masukan Nama Customer">

                        <label for="phone">Phone Customer :</label>
                        <input type="text" id="phone" name="phone" placeholder="Masukan Nomer Telepon Customer"
                            oninput="formatRupiah(this)">

                        <label for="deskripsi">Alamat Customer :</label>
                        <textarea id="deskripsi" name="address" placeholder="Masukan Masukan Alamat"></textarea>

                        <label for="provinsi">Provinsi:</label>
                        <select name="provinsi" id="provinsi" class="form-control select2" style="width: 100%;">
                            <option value="">-- Pilih Provinsi --</option>
                        </select>

                        <label for="kabupaten">Kabupaten:</label>
                        <select name="kabupaten" id="kabupaten" class="form-control select2" style="width: 100%;">
                            <option value="">-- Pilih Kabupaten --</option>
                        </select>

                        <label for="kecamatan">Kecamatan:</label>
                        <select name="kecamatan" id="kecamatan" class="form-control select2" style="width: 100%;">
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>

                        <label for="kelurahan">Kelurahan:</label>
                        <select name="kelurahan" id="kelurahan" class="form-control select2" style="width: 100%;">
                            <option value="">-- Pilih Kelurahan --</option>
                        </select>
                    </div>

                    <div class="form-right">
                        <div class="drop-area" id="drop_area">
                            <img src="{{ asset('icon/icons8-drag-and-drop-48.png') }}" alt="icon" />
                            <p>Drop/Drag an Profile Image Customer</p>
                            <!-- <input type="file" id="fileImage" accept="image/*" hidden> -->
                            <input type="file" name="file_image" id="file_input" onchange="this.form.submit()"
                                accept="image/*" hidden>
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
                            <td>{{ $customer->no_id }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        const dropArea = document.getElementById("drop_area"); //div drop_area
        const fileImage = document.getElementById("file_input"); //id input
        const previewContainer = document.getElementById("preview_container"); //[review_container]

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

        dropArea.addEventListener("click", () => fileImage.click()); //click Input
        fileImage.addEventListener("change", () => {
            const file = fileImage.files[0];
            if (file && file.type.startsWith("image/")) {
                previewImage(file);
            }
        });

        function previewImage(file) {
            const dropImage = dropArea.querySelector('img');
            const dropText = dropArea.querySelector('p');
            if (dropImage) dropImage.remove();
            if (dropText) dropText.remove();

            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.innerHTML =
                    `<img src="${e.target.result}" style="max-width: 100px; max-height: 100px; margin-top: 10px; height: 100%; width: auto;" alt="Preview">`;
            };

            reader.readAsDataURL(file);

        }

        document.getElementById('start-camera').addEventListener('click', async () => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                document.getElementById('camera-preview').srcObject = stream;
            } catch (error) {
                console.error('Gagal mengakses kamera:', error);
            }
        });

        $(document).ready(function() {
            let $provinsi = $('#provinsi');
            let $kabupaten = $('#kabupaten');
            let $kecamatan = $('#kecamatan');
            let $kelurahan = $('#kelurahan');

            let $container = $('.form-left');

            $provinsi.select2({
                placeholder: "-- Pilih Provinsi --",
                allowClear: true,
                width: '100%',
                dropdownParent: $container,
                dropdownPosition: 'below'
            });

            $kabupaten.select2({
                placeholder: "-- Pilih Kabupaten --",
                allowClear: true,
                width: '100%',
                dropdownParent: $container,
                dropdownPosition: 'below'
            });

            $kecamatan.select2({
                placeholder: "-- Pilih Kecamatan --",
                allowClear: true,
                width: '100%',
                dropdownParent: $container,
                dropdownPosition: 'below'
            });

            $kelurahan.select2({
                placeholder: "-- Pilih Kelurahan --",
                allowClear: true,
                width: '100%',
                dropdownParent: $container,
                dropdownPosition: 'below'
            });

            function get_lokasi($target, tingkat, parent_id = '', selected = '') {
                $target.html('<option value="">Loading...</option>');
                $.get(`/api/lokasi/${parent_id}`, {
                    tingkat: tingkat
                }, function(data) {
                    let options = '<option value="">-- Pilih --</option>';
                    data.forEach(item => {
                        const selectedAttr = item.nama === selected ? 'selected' : '';
                        options +=
                            `<option value="${item.id}" data-id="${item.id}" ${selectedAttr}>${item.nama}</option>`;
                    });
                    $target.html(options);
                    $target.trigger('change.select2'); 
                });
            }

            get_lokasi($provinsi, 1);

            $provinsi.change(() => {
                let id = $provinsi.find('option:selected').data('id');
                get_lokasi($kabupaten, 2, id);
            });

            $kabupaten.change(() => {
                let id = $kabupaten.find('option:selected').data('id');
                get_lokasi($kecamatan, 3, id);
            });

            $kecamatan.change(() => {
                let id = $kecamatan.find('option:selected').data('id');
                get_lokasi($kelurahan, 4, id);
            });
        });
    </script>
@endpush
