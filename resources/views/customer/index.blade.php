@extends('layouts/app')

@section('title', 'Customer')

@section('content')
    <div class="customer">
        <form class="customer-header" style="display: flex; align-items: center; gap: 10px;" id="search">
            <div class="search" style="margin-bottom: 0,">
                @csrf
                <label for="GET">
                    <input type="text" name="name" placeholder="Search For Name Customer">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <div class="search" style="margin-bottom:0;">
                <label for="GET">
                    <input type="text" name="no_id" placeholder="Search For Number ID">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <button
                type="submit"style="height: 44px; padding: 0 16px; border-radius:40px; background-color: var(--color1); outline:none; color:white; font-size:1rem; border:none; cursor: pointer; box-shadow: var(--shadow3D);">Search
            </button>

            <div class="add-new-customer" style="margin-left:auto;">
                <a onclick="info()"><ion-icon name="add-circle-outline"></ion-icon> Add Customer</a>
            </div>
        </form>

        <div class="popup-overlay" id="popup" style="display: none;">
            <div class="popup-box" id="popup-box"></div>
        </div>

        <div class="" id="table"></div>

    </div>
@endsection
@push('scripts')
    <script>
        let $form_search = $('#search'),
            $table = $('#table'),
            $popup = $('#popup'),
            $popup_box = $('#popup-box');

        let selected_page = 1,
            _token = '{{ csrf_token() }}',
            base_url = '{{ route('customer.index') }}',
            params_url = '{{ $params ?? '' }}';

        let init = () => {
            $popup_box.html('');
            $popup.hide();
            search_data(selected_page);
        }

        let search_data = (page = 1) => {
            let data = get_form_data($form_search);
            data.paginate = 10;
            data.page = selected_page = get_selected_page(page, selected_page);
            $.post(base_url + '/search?' + params_url, data, (result) => $table.html(result))
                .fail((xhr) => $table.html(xhr.responseText));
        }

        function initDropDragImage() {
            const dropArea = document.getElementById("drop_area");
            const fileInput = document.getElementById("file_input");
            const previewContainer = document.getElementById("preview_container");

            if (dropArea && fileInput && previewContainer) {
                function previewImage(file) {
                    previewContainer.innerHTML = "";
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.style =
                            "max-width: 100px; max-height: 100px; margin-top: 10px; height: 100%; width: auto; cursor:pointer;";
                        img.alt = "Preview";
                        img.id = "img_preview";
                        img.onclick = () => fileInput.click();
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }

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
            }
        }

        let display_popup_info = (customers) => {
            $popup_box.html(customers);
            $popup.css('display', 'flex');

            let $form = $('#form-flex');
            let $container = $form.find('.form-left');

            let provinsi_id = $form.data('provinsi') || '';
            let kabupaten_id = $form.data('kabupaten') || '';
            let kecamatan_id = $form.data('kecamatan') || '';
            let kelurahan_id = $form.data('kelurahan') || '';

            ['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'].forEach(function(id) {
                $('#' + id).select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });
            });

            get_lokasi($('#provinsi'), 1, '', provinsi_id);
            get_lokasi($('#kabupaten'), 2, provinsi_id, kabupaten_id);
            get_lokasi($('#kecamatan'), 3, kabupaten_id, kecamatan_id);
            get_lokasi($('#kelurahan'), 4, kecamatan_id, kelurahan_id);
            initDropDragImage();
        }

        let info = (id = '') => {
            $.get(base_url + '/' + (id === '' ? 'create' : (id + '/edit')), (result) => {
                display_popup_info(result);
            }).fail((xhr) => {
                display_popup_info(xhr.responseText);
            });
        }

        let get_lokasi = ($target, tingkat, parent_id = "", selected = "") => {
            $target.html('<option value="">Loading...</option>');
            $.get(`/api/lokasi/${parent_id}`, {
                tingkat
            }, function(data) {
                let caption = ['Provinsi', 'Kabupaten', 'Kecamatan', 'Kelurahan'][tingkat - 1];
                let options = `<option value="">-Pilih ${caption}-</option>`;
                data.forEach((item) => {
                    let selectedAttr = item.id == selected ? "selected" : "";
                    options += `<option value="${item.id}" ${selectedAttr}>${item.nama}</option>`;
                });
                $target.html(options).trigger("change.select2");
            });
        }

        $form_search.submit((e) => {
            e.preventDefault();
            search_data();
        });

        init();
    </script>
@endpush
