<button class="close-btn" onclick="init()">✕</button>


<form class="form-flex" id="form-flex" enctype="multipart/form-data">
    @csrf

    <div class="form-left">
        <label for="nama">{{ !empty($items) ? 'ubah' : 'Create' }} Nama Produk :</label>
        <input type="" id="nama" name="name" placeholder="Masukan Nama Produk"
            value="{{ $items->name ?? '' }}">

        <label for="harga">{{ !empty($items) ? 'ubah' : 'Create' }} Harga Produk :</label>
        <input type="" id="harga" name="price" placeholder="Masukan Harga Produk"
            oninput="formatRupiah(this)" value="{{ $items->price ?? '' }}">

        <label for="deskripsi">{{ !empty($items) ? 'ubah' : 'Create' }} Deksripsi Produk :</label>
        <textarea id="deskripsi" name="description" placeholder="Masukan Deksripsi Produk">{{ $items->description ?? '' }}</textarea>
    </div>

    <div class="form-right" method="">
        <div class="drop-area" id="drop_area">
            {{-- Hapus img dan p default, cukup preview --}}
            <input type="file" name="file_image" id="file_input" accept="image/*" hidden>
            <div id="preview_container">
                @if (!empty($items) && !empty($items->image))
                    <img id="img_preview" src="{{ Storage::url($items->image) }}"
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
        <button type="submit" class="add-btn">{{ !empty($items) ? 'Ubah' : 'Tambah' }} Produk</button>
    </div>
</form>
<script>
    id = '{{ $items->id ?? '' }}';
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

    // Fungsi untuk menampilkan preview baru
    function previewImage(file) {
        // Hapus semua isi previewContainer
        previewContainer.innerHTML = '';
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style =
                "max-width: 100px; max-height: 100px; margin-top: 10px; height: 100%; width: auto; cursor:pointer;";
            img.alt = "Preview";
            img.id = "img_preview";
            // Klik gambar = buka file explorer
            img.onclick = () => fileInput.click();
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }

    // Drag & drop event
    ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
        dropArea.addEventListener(eventName, (e) => e.preventDefault());
    });

    dropArea.addEventListener("drop", (e) => {
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith("image/")) {
            previewImage(file);
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;
        }
    });

    // Klik area drop atau gambar preview = buka file explorer
    dropArea.addEventListener("click", () => fileInput.click());
    // Jika ada img preview dari server, tambahkan event click
    document.addEventListener("DOMContentLoaded", function() {
        const imgPreview = document.getElementById("img_preview");
        if (imgPreview) {
            imgPreview.onclick = () => fileInput.click();
        }
    });

    // Saat pilih gambar manual
    fileInput.addEventListener("change", () => {
        const file = fileInput.files[0];
        if (file && file.type.startsWith("image/")) {
            previewImage(file);
        }
    });
</script>
