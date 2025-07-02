<button class="close-btn" onclick="init()">✕</button>

<form class="form-flex" id="form-flex" enctype="multipart/form-data">
    @csrf
    <div class="form-left">
        <label for="nama">Nama Customer :</label>
        <input type="text" id="nama" name="name" placeholder="Masukan Nama Customer"
            value="{{ $customers->name ?? '' }}">

        <label for="phone">Phone Customer :</label>
        <input type="text" id="phone" name="phone" placeholder="Masukan Nomer Telepon Customer"
            value="{{ $customers->phone ?? '' }}">

        <label for="deskripsi">Alamat Customer :</label>
        <textarea id="deskripsi" name="address" placeholder="Masukan Masukan Alamat">{{ $customers->address ?? '' }}</textarea>

        <label for="provinsi">Provinsi:</label>
        <select name="provinsi" id="provinsi" class="form-control select2" style="width: 100%;">
            <option value="">-- Pilih Provinsi --</option>
            @foreach ($provinsi as $prov)
                <option value="{{ $prov->id }}"
                    {{ $prov->id == ($customers->provinsi_id ?? '') ? 'selected' : '' }}>
                    {{ $prov->nama }}
                </option>
            @endforeach
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
            <input type="file" name="file_image" id="file_input" accept="image/*" hidden>
            <div id="preview_container"></div>
        </div>
        <button type="submit" class="add-btn">ADD Customer</button>
    </div>

</form>
<div class="camera">
    <video id="camera-preview" autoplay style="width: 200px; height: 150px; background: #000;"></video>
    <button id="start-camera">aktifkan camera</button>
</div>

<script>
    // Tambahkan ini sebelum $(document).ready
    let provinsi_id = '{{ $customers->provinsi_id ?? '' }}';
    let kabupaten_id = '{{ $customers->kabupaten_id ?? '' }}';
    let kecamatan_id = '{{ $customers->kecamatan_id ?? '' }}';
    let kelurahan_id = '{{ $customers->kelurahan_id ?? '' }}';
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

    const dropArea = document.getElementById("drop_area");
    const fileInput = document.getElementById("file_input");
    const previewContainer = document.getElementById("preview_container");

    // Prevent default behavior untuk drag & drop
    ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
        dropArea.addEventListener(eventName, (e) => e.preventDefault());
    });

    // Handle Drop Gambar
    dropArea.addEventListener("drop", (e) => {
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith("image/")) {
            previewImage(file);

            // Set file ke input[type=file] agar ikut ke FormData
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;
        }
    });

    // Klik area drag juga membuka file explorer
    dropArea.addEventListener("click", () => fileInput.click());

    // Saat pilih gambar manual
    fileInput.addEventListener("change", () => {
        const file = fileInput.files[0];
        if (file && file.type.startsWith("image/")) {
            previewImage(file);
        }
    });

    function previewImage(file) {
        const dropImage = dropArea.querySelector("img");
        const dropText = dropArea.querySelector("p");
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
        let $provinsi = $("#provinsi");
        let $kabupaten = $("#kabupaten");
        let $kecamatan = $("#kecamatan");
        let $kelurahan = $("#kelurahan");

        function get_lokasi($target, tingkat, parent_id = "", selected = "") {
            $target.html('<option value="">Loading...</option>');
            $.get(`/api/lokasi/${parent_id}`, {
                tingkat: tingkat
            }, function(data) {
                let caption = '';
                if (tingkat === 1) caption = 'Provinsi';
                if (tingkat === 2) caption = 'Kab/Kota';
                if (tingkat === 3) caption = 'Kecamatan';
                if (tingkat === 4) caption = 'Kelurahan';
                let options = `<option value="">-Pilih ${caption}-</option>`;
                data.forEach((item) => {
                    const selectedAttr = item.id == selected ? "selected" : "";
                    options +=
                        `<option value="${item.id}" data-id="${item.id}" ${selectedAttr}>${item.nama}</option>`;
                });
                $target.html(options);
                $target.trigger("change.select2");
            });
        }

        get_lokasi($provinsi, 1, '', provinsi_id);
        get_lokasi($kabupaten, 2, provinsi_id, kabupaten_id);
        get_lokasi($kecamatan, 3, kabupaten_id, kecamatan_id);
        get_lokasi($kelurahan, 4, kecamatan_id, kelurahan_id);

        $provinsi.change(() => {
            let id = $provinsi.find("option:selected").data("id");
            get_lokasi($kabupaten, 2, id);
        });

        $kabupaten.change(() => {
            let id = $kabupaten.find("option:selected").data("id");
            get_lokasi($kecamatan, 3, id);
        });

        $kecamatan.change(() => {
            let id = $kecamatan.find("option:selected").data("id");
            get_lokasi($kelurahan, 4, id);
        });

        function autoFocusSearch() {
            setTimeout(() => {
                document
                    .querySelector(
                        ".select2-container--open .select2-search__field"
                    )
                    ?.focus();
            }, 0);
        }

        $provinsi.on("select2:open", autoFocusSearch);
        $kabupaten.on("select2:open", autoFocusSearch);
        $kecamatan.on("select2:open", autoFocusSearch);
        $kelurahan.on("select2:open", autoFocusSearch);


    });
</script>
