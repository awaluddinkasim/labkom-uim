@extends('layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="mr-auto">Pengaturan</h1>
            <button class="btn btn-success" onclick="save()">
                <i class="fas fa-save mr-2"></i>
                <span>Simpan</span>
            </button>
        </div>

        <div class="section-body">
            <form action="" method="POST" id="formPengaturan">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>Pengaturan sistem</h5>
                                </div>
                                <div class="form-group row">
                                    <label for="semester" class="col-sm-6 col-form-label align-self-center">Semester</label>
                                    <div class="col-sm-6">
                                        <select class="custom-select mr-sm-2" id="semester" name="semester" required>
                                            <option selected hidden value="">Pilih</option>
                                            <option value="ganjil" {{ $semester->value == "ganjil" ? 'selected' : '' }}>Ganjil</option>
                                            <option value="genap" {{ $semester->value == "genap" ? 'selected' : '' }}>Genap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="upload" class="col-sm-6 col-form-label align-self-center">Upload Slip</label>
                                    <div class="col-sm-6">
                                        <select class="custom-select mr-sm-2" id="upload" name="upload" required>
                                            <option selected hidden value="">Pilih</option>
                                            <option value="buka" {{ $upload->value == "buka" ? 'selected' : '' }}>Terbuka</option>
                                            <option value="tutup" {{ $upload->value == "tutup" ? 'selected' : '' }}>Tertutup</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-title">
                                    <h5>Pengaturan database</h5>
                                </div>
                                <div class="form-group row">
                                    <label for="upload" class="col col-form-label align-self-center">Arsipkan slip
                                        praktikum</label>
                                    <div class="col d-flex align-items-center justify-content-end">
                                        <button class="btn btn-primary btn-sm px-3" type="button">
                                            <ion-icon name="archive"></ion-icon>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="upload" class="col col-form-label align-self-center">Hapus semua akun
                                        mahasiswa</label>
                                    <div class="col d-flex align-items-center justify-content-end">
                                        <button class="btn btn-danger btn-sm px-3" type="button">
                                            <ion-icon name="trash"></ion-icon>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>Kontak</h5>
                                </div>
                                <div class="form-group">
                                    <label for="kepala_lab">Kepala Lab</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="text" class="form-control" id="kepala_lab" name="kepala_lab" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="asisten1">Asisten Lab</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="text" class="form-control" id="asisten1" name="asisten1" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="asisten2">Asisten Lab</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+62</span>
                                        </div>
                                        <input type="text" class="form-control" id="asisten2" name="asisten2" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function save() {
            $('#formPengaturan').submit();
        }
    </script>
@endpush
