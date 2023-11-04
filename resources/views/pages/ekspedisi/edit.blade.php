@extends('layouts.admin')

@section('title')
    Edit Ekspedisi
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route("ekspedisi.update", $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Foto/Logo Ekspedisi</label>
                        <input type="file" class="form-control" name="image" >
                        <small class="text-secondary">Kosongkan jika tidak ingin diubah</small>
                    </div>
                    <div class="col-md-6">
                        <label for="">Nama Ekspedisi</label>
                        <input type="text" class="form-control" name="nama" required value="{{ $item->nama }}">
                    </div>
                </div>
                <button class="btn btn-primary mt-5">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection
