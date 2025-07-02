@extends('layouts/app')

@section('title', 'Produk')

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
            <form class="search" id="search">
                @csrf
                <label>
                    <input name="name" class="search" type="text" placeholder="Search here for Item">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </form>
            <div class="add-product">
                <button class="add-product-btn" onclick="info()">
                    <ion-icon name="add-circle-outline"></ion-icon>
                    Tambah Produk
                </button>
            </div>
        </div>

        <div class="popup-overlay" id="popup" style="display: none;">
            <div class="popup-box" id="popup-box">
            </div>
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
            base_url = '{{ route('item.index') }}',
            params_url = '{{ $params ?? '' }}';

        let init = () => {
            $popup_box.html('');
            try {
                $popup.css('display', 'none');
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

        let display_popup_info = (items) => {
            $popup_box.html(items);
            $popup.css('display', 'flex');
        }

        let info = (id = '') => {
            $.get(base_url + '/' + (id === '' ? 'create' : (id + '/edit')), (result) => {
                display_popup_info(result);
            }).fail((xhr) => {
                display_popup_info(xhr.responseText)
            });
        }

        let confirm_delete = (id) => {
            alert("ingin hapus?");
            if (confirm) {
                $.post(base_url + '/' + id, {
                    _method: 'DELETE',
                    _token: _token
                }).done(() =>
                    search_data(selected_page)).fail((xhr) =>
                    alert(xhr.responseText));
            }
        }


        $form_search.submit((e) => {
            e.preventDefault();
            search_data();
        });


        // init_form_element();
        init();
    </script>
@endpush
