@extends('layouts/app')

@section('title', 'Customer')

@section('content')
    <div class="customer">
        <form class="customer-header" style="display: flex; align-items: center; gap: 10px;">
            <div class="search" style="margin-bottom: 0,">
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
            <button type="submit"
                style="height: 44px; padding: 0 16px; border-radius:40px; background-color: var(--color1); outline:none; color:white; font-size:1rem; border:none; cursor: pointer; box-shadow: var(--shadow3D);">Search</button>
            <div class="add-new-customer" style="margin-left:auto;">
                <a href="{{ route('customer.create') }}"><ion-icon name="add-circle-outline"></ion-icon> Add Customer</a>
            </div>
        </form>

        <div class="table-customer">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Name Customer</th>
                        <th>No ID</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="img-bx">
                                    <img src="{{ $customer->image ? Storage::url($customer->image) : asset('img/default-avatar.jpg') }}" alt="">
                                </div>
                            </td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->no_id }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <select onchange="handleCustomerAction(this, {{ $customer->id }})">
                                    <option selected hidden>Opsi</option>
                                    <option value="edit">Edit</option>
                                    <option value="hapus">Hapus</option>
                                </select>
                            </td>
                            <td>
                                <a class="detail" href="{{ route('customer.show', $customer->id) }}"
                                    style="text-decoration:none;">Lihat Customer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>
@endsection
@push('scripts')
    <script>
        function handleCustomerAction(select, id) {
            if (select.value === 'edit') {
                window.location.href = "{{ url('customer') }}/" + id + "/edit";
            } else if (select.value === 'hapus') {
                if (confirm('Yakin ingin menghapus customer ini?')) {
                    $.post("{{ url('customer') }}/" + id, {
                        _token: '{{ csrf_token() }}',
                        _method: 'delete'
                    }, function() {
                        alert('Berhasil dihapus');
                        window.location.reload();
                    });
                }
                select.value = 'Opsi';
            }
        }
    </script>
@endpush
