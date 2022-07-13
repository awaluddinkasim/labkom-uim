@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Akun Dosen</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
                Tambah Akun
            </button>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarDosen as $dosen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dosen->nama }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm">
                                            <ion-icon name="open"></ion-icon>
                                        </button>
                                        <form action="{{ route('admin.akun-delete', 'dosen') }}" class="d-inline"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $dosen->id }}">
                                            <button class="btn btn-danger btn-sm" type="submit">
                                                <ion-icon name="trash"></ion-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                    <h5 class="modal-title" id="formModalLabel">Tambah akun dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nidn">NIDN</label>
                            <input type="text" class="form-control" id="nidn" name="nidn" autocomplete="off"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
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
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/css/responsive.bootstrap4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                sort: false
            });
        });
    </script>
@endpush
