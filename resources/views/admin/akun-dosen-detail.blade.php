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
                    <button class="btn btn-primary">Tambah</button>
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
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <form action="" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="">
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <ion-icon name="trash"></ion-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
