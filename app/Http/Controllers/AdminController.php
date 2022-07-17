<?php

namespace App\Http\Controllers;

use App\Models\DataPengampu;
use App\Models\DataPraktikan;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Praktikum;
use App\Models\Prodi;
use App\Models\Slip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function masterData($jenis)
    {
        switch ($jenis) {
            case 'fakultas':
                $data = [
                    'daftarFakultas' => Fakultas::orderBy('nama')->get()
                ];

                return view('admin.master-fakultas', $data);

            case 'prodi':
                $data = [
                    'daftarFakultas' => Fakultas::orderBy('nama')->get(),
                    'daftarJurusan' => Prodi::orderBy('id_fakultas')->orderBy('nama')->get()
                ];

                return view('admin.master-prodi', $data);

            case 'praktikum':
                $data = [
                    'daftarFakultas' => Fakultas::orderBy('nama')->get(),
                    'daftarPraktikum' => Praktikum::orderBy('semester')->orderBy('nama')->get()
                ];

                return view('admin.master-praktikum', $data);

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function masterDataStore(Request $request, $jenis)
    {
        switch ($jenis) {
            case 'fakultas':
                $fak = new Fakultas();
                $fak->nama = $request->fakultas;
                $fak->save();

                return redirect()->back()->with('success', 'Fakultas berhasil ditambah');

            case 'prodi':
                $prodi = new Prodi();
                $prodi->id_fakultas = $request->fakultas;
                $prodi->nama = $request->prodi;
                $prodi->save();

                return redirect()->back()->with('success', 'Program Studi berhasil ditambah');

            case 'praktikum':
                $prak = new Praktikum();
                $prak->id_prodi = $request->prodi;
                $prak->nama = $request->nama;
                $prak->semester = $request->semester;
                $prak->kategori = $request->semester % 2 == 0 ? 'genap' : 'ganjil';
                $prak->save();

                return redirect()->back()->with('success', 'Praktikum berhasil ditambah');

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function masterDataDelete(Request $request, $jenis)
    {
        switch ($jenis) {
            case 'fakultas':
                Fakultas::find($request->id)->delete();
                return redirect()->back()->with('success', 'Fakultas berhasil dihapus');

            case 'prodi':
                Prodi::find($request->id)->delete();
                return redirect()->back()->with('success', 'Program Studi berhasil dihapus');

            case 'praktikum':
                Praktikum::find($request->id)->delete();
                return redirect()->back()->with('success', 'Praktikum berhasil dihapus');

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function masterDataEdit(Request $request, $jenis)
    {
        if ($request->has('id')) {
            switch ($jenis) {
                case 'fakultas':
                    $data = [
                        'fakultas' => Fakultas::find($request->id)
                    ];

                    return view('admin.master-fakultas-edit', $data);

                case 'prodi':
                    $data = [
                        'daftarFakultas' => Fakultas::orderBy('nama')->get(),
                        'prodi' => Prodi::find($request->id)
                    ];

                    return view('admin.master-prodi-edit', $data);

                case 'praktikum':
                    $data = [
                        'daftarFakultas' => Fakultas::orderBy('nama')->get(),
                        'praktikum' => Praktikum::find($request->id)
                    ];

                    return view('admin.master-praktikum-edit', $data);

                default:
                    return redirect()->route('admin.dashboard');
            }
        } else {
            return redirect()->route('admin.master', $jenis);
        }
    }

    public function masterDataUpdate(Request $request, $jenis)
    {
        switch ($jenis) {
            case 'fakultas':
                $fak = Fakultas::find($request->id);
                $fak->nama = $request->fakultas;
                $fak->update();

                return redirect()->route('admin.master', $jenis)->with('success', 'Fakultas berhasil diupdate');


            case 'prodi':
                $prodi = Prodi::find($request->id);
                $prodi->id_fakultas = $request->fakultas;
                $prodi->nama = $request->prodi;
                $prodi->update();

                return redirect()->route('admin.master', $jenis)->with('success', 'Program studi berhasil diupdate');

            case 'praktikum':
                $prak = Praktikum::find($request->id);
                $prak->nama = $request->nama;
                $prak->semester = $request->semester;
                $prak->id_prodi = $request->prodi;
                $prak->kategori = $request->semester % 2 == 0 ? 'genap' : 'ganjil';
                $prak->update();

                return redirect()->route('admin.master', $jenis)->with('success', 'Praktikum berhasil diupdate');

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function akun($jenis)
    {
        switch ($jenis) {
            case 'dosen':
                $data = [
                    'daftarDosen' => Dosen::orderBy('nama')->get()
                ];

                return view('admin.akun-dosen', $data);

            case 'mahasiswa':
                $data = [
                    'daftarUser' => User::orderBy('active')->orderBy('nim')->get()
                ];

                return view('admin.akun-mahasiswa', $data);

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function akunDelete(Request $request,$jenis)
    {
        switch ($jenis) {
            case 'dosen':
                $dosen = Dosen::find($request->id);
                if ($dosen->foto != 'default.png') {
                    File::delete(public_path('f/avatar/'.$dosen->foto));
                }
                $dosen->delete();

                return redirect()->back()->with('success', 'Akun berhasil dihapus');

            case 'mahasiswa':
                $mhs = User::find($request->id);
                if ($mhs->foto != 'default.png') {
                    File::delete(public_path('f/avatar/'.$mhs->foto));
                }
                $mhs->delete();

                return redirect()->back()->with('success', 'Akun berhasil dihapus');

            default:
                return redirect()->route('admin.dashboard');
        }
    }

    public function akunDosenStore(Request $request)
    {
        $dosen = new Dosen();
        $dosen->nidn = $request->nidn;
        $dosen->nama = $request->nama;
        $dosen->password = bcrypt($request->password);
        $dosen->save();

        return redirect()->back()->with('success', 'Berhasil menambah akun');
    }

    public function akunDosenDetail($id)
    {
        $data = [
            'dosen' => Dosen::find($id),
            'daftarPraktikum' => Praktikum::orderBy('nama')->get()
        ];

        return view('admin.akun-dosen-detail', $data);
    }

    public function akunDosenPraktikum(Request $request, $id)
    {
        $check = DataPengampu::where('id_dosen', $id)->where('id_praktikum', $request->praktikum)->first();
        if ($check) {
            return redirect()->back()->with('success', 'Gagal, praktikum sudah terdaftar sebelumnya');
        }
        $data = new DataPengampu();
        $data->id_dosen = $id;
        $data->id_praktikum = $request->praktikum;
        $data->save();

        return redirect()->back()->with('success', 'Praktikum berhasil ditambah');
    }

    public function akunDosenPraktikumDelete(Request $request, $id)
    {
        DataPengampu::find($request->id)->delete();

        return redirect()->back()->with('success', 'Praktikum berhasil dihapus');
    }

    public function slipPraktikum(Request $request)
    {
        if ($request->has('p')) {
            $data = [
                'praktikum' => Praktikum::find($request->p)->nama,
                'daftarSlip' => Slip::where('id_praktikum', $request->p)->orderBy('tgl_slip')->get()
            ];

            return view('admin.slip-praktikum-detail', $data);
        }
        $data = [
            'daftarData' => DataPraktikan::get()->sortBy('praktikum.nama')
        ];

        return view('admin.slip-praktikum', $data);
    }
}
