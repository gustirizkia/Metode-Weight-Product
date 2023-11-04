@extends('layouts.admin')

@section('title')
    Tambah Ekspedisi
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route("ekspedisi.store") }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Foto/Logo Ekspedisi</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Nama Ekspedisi</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <button class="btn btn-primary mt-5">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection
