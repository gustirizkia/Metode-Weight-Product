@extends('layouts.admin')

@section('title')
    Data Penilaian
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="table-responsive mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Banyak Penilaian</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    {{ $item->nama }}
                                </td>

                                <td>
                                    {{ $item->value_v * 100 }}%
                                </td>
                                <td>
                                    {{ $item->count_penilaian }}
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
