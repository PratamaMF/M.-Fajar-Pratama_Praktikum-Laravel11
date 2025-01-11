@extends('theme.default')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Customer</h1>
    <ol class="breadcrumb mb4">
        <li class="breadcrumb-item"><a href="/customer">Customer</a></li>
        <li class="breadcrumb-item active">Edit Data Customer</li>
    </ol>
    <div class="card mc-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <form action="{{ route('customer.update', $customers->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{old('nik', $customers->nik) }}" placeholder="Masukkan NIK">
                                    <!-- error message untuk nik -->
                                    @error('nik')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">NAME</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $customers->name) }}" placeholder="Masukkan Nama">
                                    <!-- error message untuk name -->
                                    @error('name')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">TELEPON</label>
                                    <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{old('telp', $customers->telp) }}" placeholder="Masukkan Telp">
                                    <!-- error message untuk telp -->
                                    @error('telp')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">EMAIL</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email', $customers->email) }}" placeholder="Masukkan Email">
                                    <!-- error message untuk email -->
                                    @error('email')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">ALAMAT</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{old('alamat', $customers->alamat) }}" placeholder="Masukkan Alamat">
                                    <!-- error message untuk alamat -->
                                    @error('alamat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('alertload')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.24.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endsection

{{-- value="{{old('name', $customers->name) }}" --}}