@extends('theme.default')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Customer</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <a href="{{ route('customer.create') }}" class="btn btn-md btn-success mb-3">ADD customer</a>
                <div class="row">
                    <table class="table table-bordered data-table" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th scope="col">NIK</th>
                                <th scope="col">NAME</th>
                                <th scope="col">TELEPON</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">ALAMAT</th>
                                <th scope="col" style="width:20%">ACTIONS </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($customers as $index=>$customer)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $customer->nik }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->telp }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->alamat }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('customer.destroy', $customer->id) }}" method="POST">
                                            <a href="{{ route('customer.edit', $customer->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Customer belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('alertload')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //message with sweetalert
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endsection