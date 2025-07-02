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
            try {
                $popup.css('display', 'none');
                $provinsi.select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });

                $kabupaten.select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });

                $kecamatan.select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });

                $kelurahan.select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });
            } catch (e) {}
            search_data(selected_page);
        }

        let search_data = (page = 1) => {
            let data = get_form_data($form_search);
            data.paginate = 10;
            data.page = selected_page = get_selected_page(page, selected_page);
            $.post(base_url + '/search?' + params_url, data, (result) => $table.html(result)).fail((xhr) => $table.html(
                xhr.responseText));
        }

        let display_popup_info = (customers) => {
            $popup_box.html(customers);
            $popup.css('display', 'flex');
            let $container = $('.form-left');
            if ($('#provinsi').length) {
                $('#provinsi').select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });
                $('#kabupaten').select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });
                $('#kecamatan').select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });
                $('#kelurahan').select2({
                    allowClear: true,
                    width: "100%",
                    dropdownParent: $container,
                    dropdownPosition: "below",
                    minimumResultsForSearch: 0,
                });
            }
        }

        let info = (id = '') => {
            $.get(base_url + '/' + (id === '' ? 'create' : (id + '/edit')), (result) => {
                display_popup_info(result);
            }).fail((xhr) => {
                display_popup_info(xhr.responseText);
            });
        }

        $form_search.submit((e) => {
            e.preventDefault();
            search_data();
        });

        init();
    </script>
@endpush
