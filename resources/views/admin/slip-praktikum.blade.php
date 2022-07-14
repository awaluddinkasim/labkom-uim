@extends('layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Slip Pembayaran</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Praktikum</th>
                                <th>Jumlah Mahasiswa</th>
                                <th>Jumlah Slip</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($daftarPraktikum as $praktikum)
                                <tr onclick="document.location.href = '{{ route('admin.slip') }}?p={{ $praktikum->id }}'">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $praktikum->nama }}</td>
                                    <td>{{ $praktikum->praktikan->count() }}</td>
                                    <td>{{ $praktikum->slip->count() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <i>Tidak ada data</i>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
    <style>
        tr td {
            cursor: pointer;
        }
    </style>
@endpush
