@extends('layouts/app')

@section('title', 'transaction')

@section('content')

    <div class="transaction">

        <div class="transaction-header">

            <form id="search" style="display: flex; align-items: center; gap: 8px; margin-bottom:0; color: var(--white);">
                @csrf
                <input type="hidden" name="statuses" value="{{ $statuses }}">
                <div class="search">
                    <label>
                        <input class="search" type="text" name="customer" placeholder="Search here for Customer"
                            value="{{ request('customer') }}">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="search">
                    <label>
                        <input class="search" type="text" name="item" placeholder="Search here for Item"
                            value="{{ request('item') }}">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <input type="date" name="date" id="date-input" value="{{ $dateValue }}"
                    style="height: 44px; width:150px; color: var(--template1-color5); font-weight: 500; font-size: 16px; border: 1px solid var(--chocolate-brown); border-radius: 6px; padding: 6px 10px;">
                <button type="submit" class="form-submit-transaction" style="height: 44px; padding: 0 16px;">
                    Cari
                </button>
            </form>

            <div class="sub-header" style="display: flex; align-items: center; margin-left: 10px;">
                <a href="javascript:void(0)" class="add-new-transaction-btn" onclick="info()">
                    <ion-icon name="add-circle-outline"></ion-icon>
                    Tambah Transaksi
                </a>
                <span id="export-btn-container">
                    @if (request('statuses') == 'history')
                        <form method="GET" action="{{ route('transaction.export') }}" style="margin-left: 12px;"
                            id="export-form">
                            <input type="hidden" name="statuses" value="history">
                            <input type="hidden" name="date" value="{{ $dateValue }}">
                            <button type="submit" class="export-button">
                                Export to Excel
                            </button>
                        </form>
                    @endif
                </span>
            </div>

        </div>

        <div class="popup-overlay" id="popup" style="display: none;">
            <div class="popup-box" id="popup-box">
            </div>
        </div>
        @if (session('error'))
            <div class="alert-error">
                <ion-icon name="alert-circle-outline"></ion-icon>
                <div style="flex: 1;">{{ session('error') }}</div>
            </div>
        @endif

        <div id="table-transaction"></div>

    @endsection
    @push('scripts')
        <script>
            let $form_search = $('#search'),
                $table = $('#table-transaction'),
                $popup = $('#popup'),
                $popup_box = $('#popup-box');
                
            let selected_page = 1,
                _token = '{{ csrf_token() }}',
                base_url = '{{ route('transaction.index') }}',
                params_url = '{{ $params ?? '' }}',
                today = new Date().toISOString().slice(0, 10);

            let initTabStatus = () => {
                $(document).off('click', '.tab-link-status').on('click', '.tab-link-status', handleTabLinkStatus);
            };

            // function update_url(data) {
            //     Object.keys(data).forEach(key => {
            //         if (data[key] === '' || data[key] === null) {
            //             delete data[key];
            //         }
            //     });
            //     let query = new URLSearchParams(data).toString();
            //     let newUrl = window.location.pathname + (query ? '?' + query : '');
            //     window.history.replaceState({}, '', newUrl);
            // }

            let init = () => {
                $popup_box.html('');
                try {
                    $popup.css('display', 'none');
                } catch (e) {}
                search_data(selected_page);
                initTabStatus();
            }

            let search_data = (page = 1) => {
                let data = get_form_data($form_search);
                data.paginate = 10;
                data.page = selected_page = get_selected_page(page, selected_page);
                // data._token = _token;
                // update_url(data);
                $.post(base_url + '/search?' + params_url, data, function(result) {
                    $table.html(result);
                    let current = $form_search.find('input[name="statuses"]').val('');
                    $('.tab-link-status').removeClass('active');
                    $('.tab-link-status[data-statuses="' + current + '"]').addClass('active');
                }).fail((xhr) => $table.html(xhr.responseText));
            }

            let handleTabLinkStatus = (e) => {
                let $this = $(e.currentTarget),
                    statuses = $this.data('statuses');
                $form_search.find('input[name="statuses"]').val(statuses);
                selected_page = 1;

                // let $dateInput = $form_search.find('input[name="date"]');
                // if(statuses !== 'history') {
                // // if (statuses === 'history') {
                //     // let today = new Date().toISOString().slice(0, 10);
                //         // $dateInput.val(today);
                //     // }
                // // } else {
                //     $dateInput.val('');
                // }

                search_data(selected_page);

                if (statuses === 'history') {
                    let customer = $form_search.find('input[name="customer"]').val('');
                    let item = $form_search.find('input[name="item"]').val('');
                    let date = $form_search.find('input[name="date"]').val('');
                    $('#export-btn-container').html(`
                        <form method="POST" action="${base_url}/export" style="margin-left: 12px;" id="export-form">
                            <input type="hidden" name="statuses" value="history">
                            <input type="hidden" name="date" value="${date}">
                            <input type="hidden" name="customer" value="${customer}">
                            <input type="hidden" name="item" value="${item}">
                            <button type="submit" class="export-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0,0,256,256">
                        <g fill="#ffffff" fill-rule="nonzero">
                            <g transform="scale(5.12,5.12)">
                                <path d="M28.875,0c-0.01953,0.00781 -0.04297,0.01953 -0.0625,0.03125l-28,5.3125c-0.47656,0.08984 -0.82031,0.51172 -0.8125,1v37.3125c-0.00781,0.48828 0.33594,0.91016 0.8125,1l28,5.3125c0.28906,0.05469 0.58984,-0.01953 0.82031,-0.20703c0.22656,-0.1875 0.36328,-0.46484 0.36719,-0.76172v-5h17c1.09375,0 2,-0.90625 2,-2v-34c0,-1.09375 -0.90625,-2 -2,-2h-17v-5c0.00391,-0.28906 -0.12109,-0.5625 -0.33594,-0.75391c-0.21484,-0.19141 -0.50391,-0.28125 -0.78906,-0.24609zM28,2.1875v4.34375c-0.13281,0.27734 -0.13281,0.59766 0,0.875v35.40625c-0.02734,0.13281 -0.02734,0.27344 0,0.40625v4.59375l-26,-4.96875v-35.6875zM30,8h17v34h-17v-5h4v-2h-4v-6h4v-2h-4v-5h4v-2h-4v-5h4v-2h-4zM36,13v2h8v-2zM6.6875,15.6875l5.46875,9.34375l-5.96875,9.34375h5l3.25,-6.03125c0.22656,-0.58203 0.375,-1.02734 0.4375,-1.3125h0.03125c0.12891,0.60938 0.25391,1.02344 0.375,1.25l3.25,6.09375h4.96875l-5.75,-9.4375l5.59375,-9.25h-4.6875l-2.96875,5.53125c-0.28516,0.72266 -0.48828,1.29297 -0.59375,1.65625h-0.03125c-0.16406,-0.60937 -0.35156,-1.15234 -0.5625,-1.59375l-2.6875,-5.59375zM36,20v2h8v-2zM36,27v2h8v-2zM36,35v2h8v-2z"/>
                            </g>
                        </g>
                    </svg>
                                Export to Excel
                            </button>
                        </form>
                    `);
                } else {
                    $('#export-btn-container').html('');
                }

                $('.tab-link-status').removeClass('active');
                $this.addClass('active');
            }

            let display_popup_info = (transactions) => {
                $popup_box.html(transactions);
                $popup.css('display', 'flex');
            }

            let info = (id = '') => {
                $.get(base_url + '/' + (id === '' ? 'create' : (id, '/edit')), (result) => {
                    display_popup_info(result);
                }).fail((xhr) => {
                    display_popup_info(xhr.responseText);
                });
            }

            update_status = (id) => {
                let status = $('#status-' + id).find('option:selected').val();
                $.post(base_url + '/' + id + '/update-status', {
                    status: status,
                    _token: _token
                }, (result) => {
                    if (result.success) {
                        let statusMap = {
                            "0": 'belum-kembali',
                            "1": 'terlambat',
                            "2": 'dibatalkan',
                            "3": 'history'
                        };
                        let newTab = statusMap[status];
                        if (newTab) {
                            $('.tab-link-status').removeClass('active');
                            $('.tab-link-status[data-statuses="' + newTab + '"]').addClass('active');
                            $form_search.find('input[name="statuses"]').val(newTab);
                            if (newTab === 'history') {
                                today = new Date().toISOString().slice(0, 10);
                                $form_search.find('input[name="date"]').val(today);
                            }
                        }
                        search_data(selected_page);
                    } else {
                        alert('Gagal memperbarui status transaksi.');
                    }
                }).fail((xhr) => {
                    alert('Gagal memperbarui status transaksi: ' + xhr.responseText);
                });
            }

            $form_search.submit((e) => {
                e.preventDefault();
                search_data();
            });

            init();
        </script>
    @endpush
