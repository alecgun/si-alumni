<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\DataTables\DataAlumniDataTables;
use App\Services\KuliahService;
use App\Services\KerjaService;
use App\Models\Alumni;
use App\Models\Kuliah;
use App\Models\Kerja;
use App\StoreClass\LogAktivitas;
use App\Http\Requests\KuliahRequest;
use App\Http\Requests\KerjaRequest;

class LandingController extends Controller implements HasMiddleware
{
    /**
     * Constructor to apply middleware.
     */

    protected $dataAlumniDataTable;
    protected $kuliahService;
    protected $kerjaService;


    public static function middleware(): array
    {
        return [
            // new Middleware('guest', except: ['logout']),
        ];
    }

    public function __construct(DataAlumniDataTables $dataAlumniDataTable, KuliahService $kuliahService, KerjaService $kerjaService)
    {
        $this->dataAlumniDataTable = $dataAlumniDataTable;
        $this->kuliahService = $kuliahService;
        $this->kerjaService = $kerjaService;
    }

    public function index()
    {
        return view('frontend.page.landing');
    }

    public function dataAlumni(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->dataAlumniDataTable->getData($request));
        }

        return view('frontend.page.alumni');
    }

    public function getAlumniByAuthUser()
    {
        $alumni = Alumni::select('alumni.*', 'users.name as user_name')
            ->leftJoin('users', 'alumni.id_user', '=', 'users.id')
            ->where('alumni.id_user', Auth::user()->id)
            ->first();

        $kuliah = $this->kuliahService->getKuliahByAlumni($alumni->id);
        $kerja = $this->kerjaService->getKerjaByAlumni($alumni->id);

        if (!$alumni) {
            return redirect()->route('landing.index')->with('error', 'Data alumni tidak ditemukan.');
        }

        return response()->json(
            [
                'alumni' => $alumni,
                'kuliah' => $kuliah,
                'kerja' => $kerja,
            ]
        );
    }

    public function biodata()
    {
        return view('frontend.page.biodata');
    }

    public function storeKuliah(KuliahRequest $request)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();

        $data = [
            'alumni_id' => $alumni->id,
            'nama_universitas' => $request->nama_universitas,
            'fakultas' => $request->fakultas,
            'program_studi' => $request->program_studi,
            'jenjang' => $request->jenjang,
            'status_kuliah' => $request->status_kuliah,
            'jalur_masuk' => $request->jalur_masuk,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
        ];

        try {
            Kuliah::create($data);
            LogAktivitas::log('Menambah data kuliah', $request->url(), $request->all(), null, $userId);
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil ditambahkan']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function storeKerja(KerjaRequest $request)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();

        $data = [
            'alumni_id' => $alumni->id,
            'posisi_kerja' => $request->posisi_kerja,
            'tempat_kerja' => $request->tempat_kerja,
            'alamat_kerja' => $request->alamat_kerja,
            'tahun_masuk' => $request->tahun_masuk,
        ];

        try {
            Kerja::create($data);
            LogAktivitas::log('Menambah data kerja', $request->url(), $request->all(), null, $userId);
            return response()->json(['success' => true, 'message' => 'Data kerja berhasil ditambahkan']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function editKuliah($idAlumni, $idKuliah)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();
        $kuliah = Kuliah::find($idKuliah);
        return response()->json(['success' => true, 'kuliah' => $kuliah]);
    }

    public function editKerja($idAlumni, $idKerja)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();
        $kerja = Kerja::find($idKerja);
        return response()->json(['success' => true, 'kerja' => $kerja]);
    }

    public function editSosmed($idAlumni)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();
        return response()->json(['success' => true, 'alumni' => $alumni]);
    }

    public function updateKuliah(KuliahRequest $request, $idAlumni, $idKuliah)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();
        $kuliah = Kuliah::find($idKuliah);

        $data = [
            'nama_universitas' => $request->nama_universitas,
            'fakultas' => $request->fakultas,
            'program_studi' => $request->program_studi,
            'jenjang' => $request->jenjang,
            'status_kuliah' => $request->status_kuliah,
            'jalur_masuk' => $request->jalur_masuk,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
        ];

        try {
            $kuliah->update($data);
            LogAktivitas::log('Mengubah data kuliah', request()->url(), null, $data, $userId);
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil diperbarui']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateKerja(KerjaRequest $request, $idAlumni, $idKerja)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();
        $kerja = Kerja::find($idKerja);

        $data = [
            'posisi_kerja' => $request->posisi_kerja,
            'tempat_kerja' => $request->tempat_kerja,
            'alamat_kerja' => $request->alamat_kerja,
            'tahun_masuk' => $request->tahun_masuk,
        ];

        try {
            $kerja->update($data);
            LogAktivitas::log('Mengubah data kerja', request()->url(), null, $data, $userId);
            return response()->json(['success' => true, 'message' => 'Data kerja berhasil diperbarui']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateSosmed(Request $request, $idAlumni)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();

        $request->validate([
            'instagram' => 'nullable|string|max:255',
            'sosmed_lain' => 'nullable|string|max:255',
        ], [
            'instagram.string' => 'Instagram harus berupa teks',
            'instagram.max' => 'Instagram maksimal 255 karakter',
            'sosmed_lain.string' => 'Sosmed lain harus berupa teks',
            'sosmed_lain.max' => 'Sosmed lain maksimal 255 karakter',
        ]);

        $data = [
            'instagram' => $request->instagram,
            'sosmed_lain' => $request->sosmed_lain,
        ];

        try {
            $alumni->update($data);
            LogAktivitas::log('Mengubah data sosmed alumni', request()->url(), null, $data, $userId);
            return response()->json(['success' => true, 'message' => 'Data sosmed alumni berhasil diperbarui']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $userId = Auth::user()->id;

        $validatedData = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Password harus diisi',
            'password.string' => 'Password harus berupa teks',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        try {
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }
            $user->save();
            LogAktivitas::log('Memperbarui password user', request()->url(), null, null, $userId);
            return response()->json(['success' => true, 'message' => 'Password user berhasil diperbarui']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteKuliah($idAlumni, $idKuliah)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();
        $kuliah = Kuliah::find($idKuliah);

        try {
            $kuliah->delete();
            LogAktivitas::log('Menghapus data kuliah', request()->url(), null, $kuliah, $userId);
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteKerja($idAlumni, $idKerja)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();
        $kerja = Kerja::find($idKerja);

        try {
            $kerja->delete();
            LogAktivitas::log('Menghapus data kerja', request()->url(), null, $kerja, $userId);
            return response()->json(['success' => true, 'message' => 'Data kerja berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
