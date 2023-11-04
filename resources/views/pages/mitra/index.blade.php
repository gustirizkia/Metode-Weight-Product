@extends('layouts.admin')

@section('title')
    Mitra
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route("mitra.create") }}" class="btn btn-primary">Tambah Data</a>

            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route("mitra.edit", $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <form action="{{ route("mitra.destroy", $item->id) }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger btn-sm ml-3">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">
                                    <div class="text-center">Tidak ada data</div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
