@extends('theme.default')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Satuan</h1>
    <ol class="breadcrumb mb4">
        <li class="breadcrumb-item"><a href="/satuan">Satuan</a></li>
        <li class="breadcrumb-item active">Edit Data Satuan</li>
    </ol>
    <div class="card mc-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <form action="{{ route('satuan.update', $satuans->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">NAME</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $satuans->name) }}" placeholder="Masukkan Nama Satuan">
                                        <!-- error message untuk name -->
                                        @error('name')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">DESCRIPTION</label>
                                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description', $satuans->description) }}" placeholder="Masukkan Description">
                                        <!-- error message untuk description -->
                                        @error('description')
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