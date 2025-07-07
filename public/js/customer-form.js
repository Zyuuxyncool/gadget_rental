function initCustomerForm(customers) {
    let provinsi_id = customers?.provinsi_id ?? '';
    let kabupaten_id = customers?.kabupaten_id ?? '';
    let kecamatan_id = customers?.kecamatan_id ?? '';
    let kelurahan_id = customers?.kelurahan_id ?? '';
    let id = customers?.id ?? '';
    const $form_flex = $('#form-flex');
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

    dropArea.addEventListener("click", () => fileInput.click());

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
