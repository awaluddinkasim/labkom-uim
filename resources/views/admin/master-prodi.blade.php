@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Master Program Studi</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                Tambah
            </button>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Fakultas</th>
                                    <th>Program Studi</th>
                                    <th>Mahasiswa Terdaftar</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftarJurusan as $prodi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prodi->fakultas->nama }}</td>
                                    <td>{{ $prodi->nama }}</td>
                                    <td>{{ $prodi->mahasiswa->count() }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info btn-sm">
                                            <ion-icon name="create"></ion-icon>
                                        </button>
                                        <form action="" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $prodi->id }}">
                                            <button class="btn btn-danger btn-sm" type="submit">
                                                <ion-icon name="trash"></ion-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
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
                    <h5 class="modal-title" id="formModalLabel">Tambah program studi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($daftarFakultas->count() > 0)
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fakultas">Fakultas</label>
                            <select class="custom-select mr-sm-2" id="fakultas" name="fakultas" required>
                                <option selected hidden value="">Pilih</option>
                                @foreach ($daftarFakultas as $fakultas)
                                    <option value="{{ $fakultas->id }}">{{ $fakultas->nama }}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <input type="text" class="form-control" id="prodi" name="prodi" autocomplete="off"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
                @else
                <div class="modal-body py-5 text-center">
                    <p>Harap isi data fakultas terlebih dahulu</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                @endif
            </div>
        </div>
    </div>
@endpush
