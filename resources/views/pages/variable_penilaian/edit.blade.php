@extends('layouts.admin')

@section('title')
    Edit Variable
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route("variable-penilaian.update", $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
                <div class="row">

                    <div class="col-md-6">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" required value="{{ $item->nama }}">
                    </div>
                    <div class="col-md-6">
                        <label for="">Kriteria Penilain</label>
                        <input type="number" class="form-control" name="kriteria" value="{{ $item->kriteria }}" required>
                    </div>
                </div>
                <button class="btn btn-primary mt-5">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection
