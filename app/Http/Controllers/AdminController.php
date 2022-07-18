<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DataPengampu;
use App\Models\DataPraktikan;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Praktikum;
use App\Models\Prodi;
use App\Models\Setting;
use App\Models\Slip;
use App\Models\User;
use Illuminate\Database\QueryException;
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
                    'daftarJurusan' => Prodi::all()->sortBy(['fakultas.nama', 'nama'])
                ];

                return view('admin.master-prodi', $data);

            case 'praktikum':
                $data = [
                    'daftarFakultas' => Fakultas::orderBy('nama')->get(),
                    'daftarPraktikum' => Praktikum::all()->sortBy(['semester', 'prodi.nama'])
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
                $check = Fakultas::where('nama', $request->fakultas)->first();
                if ($check) {
                    return redirect()->back()->with('failed', 'Fakultas yang Anda input sudah ada');
                }
                $fak = new Fakultas();
                $fak->nama = $request->fakultas;
                $fak->save();

                return redirect()->back()->with('success', 'Fakultas berhasil ditambah');

            case 'prodi':
                $check = Prodi::where('id_fakultas', $request->fakultas)->where('nama', $request->prodi)->first();
                if ($check) {
                    return redirect()->back()->with('failed', 'Program studi yang Anda input sudah ada');
                }
                $prodi = new Prodi();
                $prodi->id_fakultas = $request->fakultas;
                $prodi->nama = $request->prodi;
                $prodi->save();

                return redirect()->back()->with('success', 'Program studi berhasil ditambah');

            case 'praktikum':
                $check = Praktikum::where('id_prodi', $request->prodi)->where('nama', $request->nama)->first();
                if ($check) {
                    return redirect()->back()->with('failed', 'Praktikum yang Anda input sudah ada');
                }
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
        try {
            $dosen = new Dosen();
            $dosen->nidn = $request->nidn;
            $dosen->nama = $request->nama;
            $dosen->password = bcrypt($request->password);
            $dosen->save();

            return redirect()->back()->with('success', 'Berhasil menambah akun');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->with('failed', 'Akun dengan NIDN tersebut sudah terdaftar sebelumnya');
            }
        }
    }

    public function akunDosenDetail($id)
    {
        $data = [
            'dosen' => Dosen::find($id),
            'daftarProdi' => Prodi::all()->sortBy(['fakultas.nama', 'nama'])
        ];

        return view('admin.akun-dosen-detail', $data);
    }

    public function akunDosenEdit($id)
    {
        $data = [
            'dosen' => Dosen::find($id),
        ];

        return view('admin.akun-dosen-edit', $data);
    }

    public function akunDosenUpdate(Request $request, $id)
    {
        $dosen = Dosen::find($id);
        try {
            $nidn = $dosen->nidn;

            $dosen->nidn = $request->nidn;
            $dosen->nama = $request->nama;
            if ($dosen->password) {
                $dosen->password = bcrypt($request->password);
            }
            $dosen->update();

            DataPraktikan::where('nidn_dosen', $dosen->nidn)->update([
                'nidn_dosen' => $request->nidn,
                'updated_at' => now()
            ]);

            return redirect()->route('admin.dosen-detail', $id)->with('success', 'Akun berhasil diupdate');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->route('admin.dosen-detail', $id)->with('failed', 'Gagal, NIDN tersebut sudah terdaftar pada akun lain');
            }
        }

    }

    public function akunDosenPraktikum(Request $request, $id)
    {
        $check = DataPengampu::where('id_dosen', $id)->where('id_praktikum', $request->praktikum)->first();
        if ($check) {
            return redirect()->back()->with('failed', 'Gagal, praktikum sudah terdaftar sebelumnya');
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

    public function akunMahasiswaDetail($id)
    {
        $data = [
            'mahasiswa' => User::find($id)
        ];

        return view('admin.akun-mahasiswa-detail', $data);
    }

    public function akunMahasiswaEdit($id)
    {
        $data = [
            'daftarFakultas' => Fakultas::orderBy('nama')->get(),
            'mahasiswa' => User::find($id)
        ];

        return view('admin.akun-mahasiswa-edit', $data);
    }

    public function akunMahasiswaUpdate(Request $request, $id)
    {
        $mhs = User::find($id);
        Slip::where('nim', $mhs->nim)->update([
            'nama' => $request->nama,
            'updated_at' => now()
        ]);
        $mhs->nama = $request->nama;
        $mhs->no_hp = $request->no_hp;
        $mhs->id_prodi = $request->prodi;
        $mhs->level = $request->level;
        if ($request->password) {
            $mhs->password = bcrypt($request->password);
        }
        $mhs->update();

        return redirect()->route('admin.mhs-detail', $id)->with('success', 'Akun berhasil diupdate');
    }

    public function akunMahasiswaAction(Request $request, $action)
    {
        switch ($action) {
            case 'verifikasi':
                $mhs = User::find($request->id);
                $mhs->active = '1';
                $mhs->update();

                return redirect()->route('admin.akun', 'mahasiswa')->with('success', 'Mahasiswa berhasil diverifikasi');

            case 'tolak':
                $mhs = User::find($request->id);
                if ($mhs->foto != 'default.png') {
                    File::delete(public_path('f/avatar/'.$mhs->foto));
                }
                $mhs->delete();

                return redirect()->route('admin.akun', 'mahasiswa')->with('success', 'Mahasiswa berhasil ditolak');

            default:
                return redirect()->route('admin.dashboard');
        }
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
            'daftarData' => DataPraktikan::distinct()->get(['id_praktikum', 'nidn_dosen'])->sortBy('praktikum.nama')
        ];

        return view('admin.slip-praktikum', $data);
    }

    public function pengaturan()
    {
        $data = [
            'semester' => Setting::where('name', 'semester')->first(),
            'upload' => Setting::where('name', 'upload')->first(),

            'kepala_lab' => Setting::where('name', 'kepala_lab')->first(),
            'asisten1' => Setting::where('name', 'asisten1')->first(),
            'asisten2' => Setting::where('name', 'asisten2')->first(),
        ];

        return view('admin.pengaturan', $data);
    }

    public function pengaturanSave(Request $request)
    {
        foreach ($request->keys() as $key) {
            if ($key != "_token") {
                $pengaturan = Setting::where('name', $key)->first();
                if ($pengaturan) {
                    $pengaturan->value = $request->$key;
                    $pengaturan->update();
                } else {
                    $setting = new Setting();
                    $setting->name = $key;
                    $setting->value = $request->$key;
                    $setting->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan');
    }

    public function profil()
    {
        return view('admin.profil');
    }

    public function profilUpdate(Request $request)
    {
        try {
            $admin = Admin::find(auth()->user()->id);
            $admin->email = $request->email;
            $admin->nama = $request->nama;
            if ($request->password) {
                $admin->password = bcrypt($request->password);
            }
            $admin->update();

            return redirect()->back()->with('success', 'Update profil berhasil');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->with('failed', 'Email telah terdaftar pada akun lain');
            }
        }
    }
}
