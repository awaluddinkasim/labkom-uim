@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $dosen->nama }}</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table cellpadding="10">
                        <tr>
                            <td>NIDN</td>
                            <td>:</td>
                            <td>{{ $dosen->nidn }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $dosen->nama }}</td>
                        </tr>
                    </table>

                    <hr>

                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <h5>Praktikum</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                            Tambah
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Praktikum</th>
                                    <th>Jumlah Mahasiswa</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dosen->dataPraktikum as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->praktikum->nama }}</td>
                                        <td>{{ $data->praktikum->praktikan->count() }}</td>
                                        <td class="text-center">
                                            <form action="" class="d-inline" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <ion-icon name="trash"></ion-icon>
                                                </button>
                                            </form>
                                        </td>
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

@push('modals')
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah fakultas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="praktikum">Praktikum</label>
                            <select class="select" name="praktikum" id="praktikum" required>
                                <option value="" selected>Pilih Praktikum</option>
                                @foreach ($daftarPraktikum as $praktikum)
                                    <option value="{{ $praktikum->id }}">{{ $praktikum->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/selectize/selectize.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/selectize/selectize.min.js') }}"></script>
    <script>
        $("select").selectize();
    </script>
@endpush
