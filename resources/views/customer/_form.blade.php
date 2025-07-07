<button class="close-btn" onclick="init()">✕</button>

<form class="form-flex" id="form-flex" enctype="multipart/form-data" data-provinsi="{{ $customers->provinsi_id ?? '' }}"
    data-kabupaten="{{ $customers->kabupaten_id ?? '' }}" data-kecamatan="{{ $customers->kecamatan_id ?? '' }}"
    data-kelurahan="{{ $customers->kelurahan_id ?? '' }}">

    @csrf
    <div class="form-left">
        <label for="nama">{{ !empty($items) ? 'Ubah' : 'Tambah' }} Nama Customer :</label>
        <input type="text" id="nama" name="name" placeholder="Masukan Nama Customer"
            value="{{ $customers->name ?? '' }}">

        <label for="phone">{{ !empty($items) ? 'Ubah' : 'Tambah' }} Phone Customer :</label>
        <input type="text" id="phone" name="phone" placeholder="Masukan Nomer Telepon Customer"
            value="{{ $customers->phone ?? '' }}">

        <label for="deskripsi">{{ !empty($items) ? 'Ubah' : 'Tambah' }} Alamat Customer :</label>
        <textarea id="deskripsi" name="address" placeholder="Masukan Masukan Alamat">{{ $customers->address ?? '' }}</textarea>

        <label for="provinsi">{{ !empty($items) ? 'Ubah' : 'Tambah' }} Provinsi:</label>
        <select name="provinsi" id="provinsi" class="form-control select2" style="width: 100%;">
            <option value="">-- Pilih Provinsi --</option>
            @foreach ($provinsi as $prov)
                <option value="{{ $prov->id }}"
                    {{ $prov->id == ($customers->provinsi_id ?? '') ? 'selected' : '' }}>
                    {{ $prov->nama }}
                </option>
            @endforeach
        </select>

        <label for="kabupaten">{{ !empty($items) ? 'Ubah' : 'Tambah' }} Kabupaten:</label>
        <select name="kabupaten" id="kabupaten" class="form-control select2" style="width: 100%;">
            <option value="">-- Pilih Kabupaten --</option>
        </select>

        <label for="kecamatan">{{ !empty($items) ? 'Ubah' : 'Tambah' }} Kecamatan:</label>
        <select name="kecamatan" id="kecamatan" class="form-control select2" style="width: 100%;">
            <option value="">-- Pilih Kecamatan --</option>
        </select>

        <label for="kelurahan">{{ !empty($items) ? 'Ubah' : 'Tambah' }} Kelurahan:</label>
        <select name="kelurahan" id="kelurahan" class="form-control select2" style="width: 100%;">
            <option value="">-- Pilih Kelurahan --</option>
        </select>
    </div>

    <div class="form-right">
        <div class="drop-area" id="drop_area">
            <input type="file" name="file_image" id="file_input" accept="image/*" hidden>
            <div id="preview_container">
                @if (!empty($customers) && !empty($customers->image))
                    <img id="img_preview" src="{{ Storage::url($customers->image) }}"
                        style="max-width: 100px; max-height: 100px; margin-top: 10px; height: 100%; width: auto; cursor:pointer;"
                        alt="Preview">
                @else
                    <div id="drop_text">
                        <img src="{{ asset('icon/icons8-drag-and-drop-48.png') }}" alt="icon" />
                        <p>Drop/Drag an image Produk</p>
                    </div>
                @endif
            </div>
        </div>
        <button type="submit" class="add-btn">{{ !empty($customers) ? 'Ubah' : 'Tambah' }} Customer</button>
    </div>
</form>
<div class="camera">
    <video id="camera-preview" autoplay style="width: 200px; height: 150px; background: #000;"></video>
    <button id="start-camera">aktifkan camera</button>
</div>

<script>
    id = '{{ $customers->id ?? '' }}';
    $form_flex = $('#form-flex');
    $form_flex.submit((e) => {
        e.preventDefault();
        let url = base_url;
        let data = new FormData($form_flex.get(0));
        if (id !== '') url += '/' + id + '?_method=put';
        $.ajax({
            url,
            type: 'post',
            data,
            cache: false,
            processData: false,
            contentType: false,
            success: () => init(),
        }).fail((xhr) => {
            error_handle(xhr.responseText);
        });
    });
</script>
