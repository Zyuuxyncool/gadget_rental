{{-- 
@php
    dd($customers, $items);
@endphp  --}}

<button class="close-btn" onclick="init()">✕</button>

<form class="form-flex" id="form-flex" enctype="multipart/form-data">
    @csrf
    <div class="form-left">
        <label for="customer_id">Nama Customer :</label>
        <select name="customer_id" id="customer_id" class="form-control select2" style="width: 100%;">
            <option value="">-- Pilih Customer --</option>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}"
                    {{ $customer->id == ($transaction->customer_id ?? '') ? 'selected' : '' }}>
                    {{ $customer->name }} ({{ $customer->no_id }}) 
                </option>
            @endforeach
        </select>

        <label for="item_id">Nama Item :</label>
        <select name="item_id" id="item_id" class="form-control select2" style="width: 100%;">
            <option value="">-- Pilih Item --</option>
            @foreach ($items as $item)
                <option value="{{ $item->id }}" {{ $item->id == ($transaction->item_id ?? '') ? 'selected' : '' }}>
                    {{ $item->name }} ({{ number_format($item->price, 0, ',', '.') }}) ({{ $item->description }})
                </option>
            @endforeach
        </select>

        <label for="price">Harga :</label>
        <input type="" id="price" name="price" placeholder="Masukan Harga" oninput="formatRupiah(this)"
            value="{{ $transaction->price ?? '' }}">

        <label for="date">Tanggal Pinjam :</label>
        <input type="date" id="date" name="date" value="{{ $transaction->date ?? '' }}"
            style=" background-color: var(--color2);
                    color: var(--color5);
                    box-shadow: none;">

        <label for="time">Waktu Pinjam :</label>
        <input type="time" id="time" name="time" value="{{ $transaction->time ?? '' }}">

        <label for="return_date">Tanggal Kembali :</label>
        <input type="date" id="return_date" name="return_date" value="{{ $transaction->return_date ?? '' }}"
            style=" background-color: var(--color2);
                    color: var(--color5);
                    box-shadow: none;">
        <button type="submit" class="add-btn">Simpan Transaksi</button>
    </div>
    {{-- <input type="hidden" name="statuses" value="{{ request('statuses', 'belum-kembali') }}"> --}}
</form>

<script>
    id = '{{ $transaction->id ?? '' }}';
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

    $(document).ready(function() {
        $('#customer_id').select2({
            placeholder: "-- Pilih Customer --",
            allowClear: true,
            width: '100%',
            dropdownParent: $('.form-left'),
            minimumResultsForSearch: 0
        }).on('select2:open', function() {
            setTimeout(() => {
                $('.select2-container--open .select2-search__field').focus();
            }, 0);
        });

        $('#item_id').select2({
            placeholder: "-- Pilih Item --",
            allowClear: true,
            width: '100%',
            dropdownParent: $('.form-left'),
            minimumResultsForSearch: 0
        }).on('select2:open', function() {
            setTimeout(() => {
                $('.select2-container--open .select2-search__field').focus();
            }, 0);
        });
    });

    function autoFocusSearch() {
        setTimeout(() => {
            document.querySelector('.select2-container--open .select2-search__field')?.focus();
        }, 0);
    }

    $('#customer_id').on('select2:open', autoFocusSearch);
    $('#item_id').on('select2:open', autoFocusSearch);
</script>
