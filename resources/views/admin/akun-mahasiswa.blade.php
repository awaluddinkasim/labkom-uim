@extends('layout')

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="mr-auto">Akun Mahasiswa</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarUser as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nim }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->no_hp }}</td>
                                <td>{!! $user->active ? '<span class="text-success">Terverifikasi</span>' : '<span class="text-danger">Pending</span>' !!}</td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm">
                                        <ion-icon name="create"></ion-icon>
                                    </button>
                                    <form action="{{ route('admin.akun-delete', 'user') }}" class="d-inline"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
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


@push('styles')
    @include('includes.datatables.styles')
@endpush

@push('scripts')
    @include('includes.datatables.scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                sort: false
            });
        });
    </script>
@endpush
