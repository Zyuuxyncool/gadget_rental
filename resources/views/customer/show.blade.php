@extends('layouts/app')

@section('title', 'Detail Customer')

@section('content')
    <div class="details">
        <div class="show-the-container">
            <div class="card-header">
                <h2>Informasi Customer</h2>
            </div>

            <p>Nama Customer : <span>{{ $customers?->name ?? '-' }}</span></p>
            <p>No ID : <span>{{ $customers?->no_id ?? '-' }}</span></p>
            <p>Nomor Telepon : <span>{{ $customers?->phone ?? '-' }}</span></p>
            <p>Alamat : <span>{{ $customers?->address ?? '-' }}</span></p>

            <div class="lokasi-container">
                <div class="select-group">
                    <label for="provinsi">Provinsi:</label>
                    <select name="provinsi" id="provinsi" disabled>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinsi as $prov)
                            <option value="{{ $prov->id }}" data-id="{{ $prov->id }}"
                                {{ $customers && $prov->nama == $customers->provinsi?->nama ? 'selected' : '' }}>
                                {{ $prov->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="select-group">
                    <label for="kabupaten">Kabupaten:</label>
                    <select name="kabupaten" id="kabupaten" disabled>
                        <option value="">-- Pilih Kabupaten --</option>
                    </select>
                </div>

                <div class="select-group">
                    <label for="kecamatan">Kecamatan:</label>
                    <select name="kecamatan" id="kecamatan" disabled>
                        <option value="">-- Pilih Kecamatan --</option>
                    </select>
                </div>

                <div class="select-group">
                    <label for="kelurahan">Kelurahan:</label>
                    <select name="kelurahan" id="kelurahan" disabled>
                        <option value="">-- Pilih Kelurahan --</option>
                    </select>
                </div>
            </div>


        </div>

        <div class="photos mt-4">
            <div class="card-header">
                <h2>Foto Customer</h2>
            </div>
            @if ($customers && $customers->photo1)
                <img src="{{ asset('storage/' . $customers->photo1) }}" alt="Foto 1" class="img-thumbnail m-1"
                    width="150">
            @endif
            @if ($customers && $customers->photo2)
                <img src="{{ asset('storage/' . $customers->photo2) }}" alt="Foto 2" class="img-thumbnail m-1"
                    width="150">
            @endif
            @if ($customers && $customers->photo3)
                <img src="{{ asset('storage/' . $customers->photo3) }}" alt="Foto 3" class="img-thumbnail m-1"
                    width="150">
            @endif
        </div>

        <div class="back-btn" style="grid-column: 1 / -1; display: flex; justify-content: center;">
            <a href="{{ route('customer.index') }}"
                style="width:900px; padding: 10px 15px; background-color: var(--color1); text-align:center; text-decoration:none; color: var(--color5); border: 1px solid var(--color2); border-radius:12px; box-shadow: var(--shadow3D); justify-content:center; possiton">Kembali</a>
        </div>




    </div>
@endsection

@push('scripts')
    <script>
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

        let $provinsi = $('#provinsi');
        let $kabupaten = $('#kabupaten');
        let $kecamatan = $('#kecamatan');
        let $kelurahan = $('#kelurahan');

        let $container = $('.show-the-container');

        $provinsi.select2({
            placeholder: "--  Belum Memilih --",
            allowClear: true,
            width: '100%',
            dropdownParent: $container,
            dropdownPosition: 'below',
            disabled: true
        });
        $kabupaten.select2({
            placeholder: "--  Belum Memilih --",
            allowClear: true,
            width: '100%',
            dropdownParent: $container,
            dropdownPosition: 'below',
            disabled: true
        });
        $kecamatan.select2({
            placeholder: "-- Belum Memilih --",
            allowClear: true,
            width: '100%',
            dropdownParent: $container,
            dropdownPosition: 'below',
            disabled: true
        });
        $kelurahan.select2({
            placeholder: "--  Belum Memilih --",
            allowClear: true,
            width: '100%',
            dropdownParent: $container,
            dropdownPosition: 'below',
            disabled: true
        });

        get_lokasi($provinsi, 1, '', '{{ $customers?->provinsi?->nama }}');
        get_lokasi($kabupaten, 2, '{{ $customers?->provinsi?->id }}', '{{ $customers?->kabupaten?->nama }}');
        get_lokasi($kecamatan, 3, '{{ $customers?->kabupaten?->id }}', '{{ $customers?->kecamatan?->nama }}');
        get_lokasi($kelurahan, 4, '{{ $customers?->kecamatan?->id }}', '{{ $customers?->kelurahan?->nama }}');

        $provinsi.change(() => {
            let id = $provinsi.find('option:selected').data('id');
            get_lokasi($kabupaten, 2, id, '{{ $customers?->kabupaten?->nama }}');
        });
        $kabupaten.change(() => {
            let id = $kabupaten.find('option:selected').data('id');
            get_lokasi($kecamatan, 3, id, '{{ $customers?->kecamatan?->nama }}');
        });
        $kecamatan.change(() => {
            let id = $kecamatan.find('option:selected').data('id');
            get_lokasi($kelurahan, 4, id, '{{ $customers?->kelurahan?->nama }}');
        });
    </script>
@endpush
