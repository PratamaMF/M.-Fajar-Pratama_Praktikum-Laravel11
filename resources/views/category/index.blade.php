@extends('theme.default')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <div class="float-end">
                    <a href="{{ route('printcategory') }}" class="btn btn-md btn-warning mb-3">PRINT CATEGORY</a>
                </div>
            </div>
            <div class="card-body">
                <a href="{{ route('category.create') }}" class="btn btn-md btn-success mb-3">ADD CATEGORY</a>
                <div class="row">
                    <table class="table table-bordered data-table" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th scope="col">NAME</th>
                                <th scope="col" style="width:20%">ACTIONS </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($categories as $index=>$category)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Category belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->links() }}
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