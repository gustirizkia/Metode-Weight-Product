
@extends('layouts.admin')

@section('title')
    Tambah Mitra
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route("mitra.store") }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>

                </div>
                <button class="btn btn-primary mt-5">Simpan Data</button>
            </form>
        </div>
    </div>
@endsection

