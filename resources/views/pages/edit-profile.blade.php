@extends('layouts.admin')

@section('title')
    Edit Profile
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('updateProfile') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="col-md-6">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="col-md-6">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password">
                        <small>*Kosongkan jika tidak ingin diubah</small>
                    </div>

                </div>
                <div class="mt-4">
                    <button class="btn btn-primary" type="submit">
                        Simpan Perubahaan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
