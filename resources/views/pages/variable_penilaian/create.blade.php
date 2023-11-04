@extends('layouts.admin')

@section('title')
    Tambah Data
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route("variable-penilaian.store") }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">

                    <div class="col-md-6">
                        <label for="">Nama Penilain</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Kriteria Penilain</label>
                        <input type="number" class="form-control" name="kriteria" required>
                    </div>
                </div>
                <button class="btn btn-primary mt-5">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection
