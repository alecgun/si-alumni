<?php

namespace App\Http\Controllers;

use App\DataTables\DataAlumniDataTables;
use App\Http\Requests\KerjaRequest;
use App\Http\Requests\KuliahRequest;
use App\Http\Requests\TicketReplyRequest;
use App\Http\Requests\TicketRequest;
use App\Models\User;
use App\Models\Alumni;
use App\Models\Kerja;
use App\Models\Kuliah;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\Pengumuman;
use App\Services\KerjaService;
use App\Services\KuliahService;
use App\StoreClass\LogAktivitas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OpenTicketConfirmed;
use App\Mail\OpenTicketUser;

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
        $data = Alumni::selectRaw('tahun_lulus, SUM(jenis_kelamin = "L") as jumlah_laki, SUM(jenis_kelamin = "P") as jumlah_perempuan')
            ->groupBy('tahun_lulus')
            ->orderBy('tahun_lulus', 'desc')
            ->get();



        return view('frontend.page.landing', compact('data'));
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

        if (! $alumni) {
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

    public function editKuliah($idAlumni, $idKuliah)
    {
        $userId = Auth::user()->id;
        $alumni = Alumni::where('id_user', $userId)->first();
        $kuliah = Kuliah::find($idKuliah);

        return response()->json(['success' => true, 'kuliah' => $kuliah]);
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
            if (! empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }
            $user->save();
            LogAktivitas::log('Memperbarui password user', request()->url(), null, null, $userId);

            return response()->json(['success' => true, 'message' => 'Password user berhasil diperbarui']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function openTicket()
    {
        return view('frontend.page.open-ticket');
    }

    public function storeTicket(TicketRequest $request)
    {
        $user = Auth::user();
        $userId = Auth::user()->id;

        $data = [
            'email' => $request->email,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'id_user' => $userId,
            'status_ticket' => 'Open',
        ];

        try {
            $ticket = Ticket::create($data);
            LogAktivitas::log('User membuat tiket', $request->url(), $request->all(), null, $userId);
            Mail::to('tubagusibe.25@gmail.com')->send(new OpenTicketConfirmed($ticket, $user));
            Mail::to($ticket->email)->send(new OpenTicketUser($ticket, $user));

            return response()->json(['success' => true, 'message' => 'Tiket berhasil dibuat']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function storeTicketImage(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $ext = $file->getClientOriginalExtension();
                $time = time();
                $date = date('ymd-His', $time);
                $filename = $date . '.' . $ext;

                $path = $file->storeAs('ticket', $filename, 'public');
                $url = asset('storage/' . $path);

                return response()->json(['success' => true, 'url' => $url]);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengunggah gambar: ' . $e->getMessage()], 500);
        }
    }

    public function historyTicket()
    {
        $userId = Auth::user()->id;

        // Menggunakan paginate() instead of get()
        $tickets = Ticket::where('id_user', $userId)
                    ->latest() // Urutkan dari yang terbaru
                    ->paginate(10); // 10 item per halaman

        try {
            // Format tanggal untuk setiap item
            $tickets->transform(function ($t) {
                $t->formatted_date = \Carbon\Carbon::parse($t->created_at)
                    ->locale('id_ID')
                    ->translatedFormat('j F Y, H:i');

                $t->status_badge = $this->getStatusBadge($t->status_ticket);

                return $t;
            });
        } catch (Exception $e) {
            return redirect()->route('landing.index')
                ->with('error', 'Gagal memformat tanggal tiket: ' . $e->getMessage());
        }

        return view('frontend.page.history-ticket', compact('tickets'));
    }

    private function getStatusBadge($status)
    {
        return match($status) {
            'Open' => 'primary',
            'Closed' => 'success',
        };
    }

    public function showTicket($idTicket)
    {
        try {
            $ticket = Ticket::select(
            'ticket.id',
            'ticket.email',
            'ticket.kategori',
            'ticket.judul',
            'ticket.deskripsi',
            'ticket.status_ticket',
            'ticket.created_at',
            'ticket.id_user',
            'users.name as nama_user',
            )
            ->join('users', 'ticket.id_user', '=', 'users.id')
            ->where('ticket.id', $idTicket)
            ->first();

            // Format tanggal
            $ticket->formatted_date = \Carbon\Carbon::parse($ticket->created_at)
                ->locale('id_ID')
                ->translatedFormat('j F Y, H:i');

            return ['status' => true, 'ticket' => $ticket];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data tiket: ' . $e->getMessage()];
        }
    }

    public function showTicketPage($idTicket)
    {
        try {
            $ticket = Ticket::findOrFail($idTicket);
            return view('frontend.page.show-ticket', compact('ticket'));
        } catch (Exception $e) {
            return redirect()->route('landing.ticket.history')->with('error', 'Gagal mengambil data tiket: ' . $e->getMessage());
        }
    }

    public function showTicketReplies($idTicket)
    {
        try {
            $ticket_reply = TicketReply::select(
                'ticket_reply.id',
                'ticket_reply.reply_text',
                'ticket_reply.id_ticket',
                'ticket_reply.id_user',
                'users.name as nama_user',
                'ticket_reply.created_at'
            )
            ->join('users', 'ticket_reply.id_user', '=', 'users.id')
            ->where('ticket_reply.id_ticket', $idTicket)
            ->get();
            return ['status' => true, 'ticket_reply' => $ticket_reply];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data balasan: ' . $e->getMessage()];
        }
    }

    public function storeTicketReply(TicketReplyRequest $request)
    {
        $userId = Auth::user()->id;

        $data = [
            'reply_text' => $request->reply_text,
            'id_ticket' => $request->id_ticket,
            'id_user' => $userId,
        ];

        try {
            TicketReply::create($data);
            LogAktivitas::log('User membuat teks balasan', $request->url(), $request->all(), null, $userId);

            return response()->json(['success' => true, 'message' => 'Teks balasan berhasil dibuat']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function storeTicketReplyImage(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $file = $request->file('upload');
                $ext = $file->getClientOriginalExtension();
                $time = time();
                $date = date('ymd-His', $time);
                $filename = $date . '.' . $ext;

                $path = $file->storeAs('ticket_reply', $filename, 'public');
                $url = asset('storage/' . $path);

                return response()->json(['success' => true, 'url' => $url]);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengunggah gambar: ' . $e->getMessage()], 500);
        }
    }

    public function dataPengumuman()
    {
        $pengumuman = Pengumuman::orderByDesc('created_at')->get();

        return response()->json(['status' => true, 'pengumuman' => $pengumuman]);
    }

    public function showPengumumanPage()
    {
        return view('frontend.page.pengumuman');
    }

    public function showPengumumanDetail($slug)
    {
        try {
            $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();
            \Carbon\Carbon::setLocale('id');
            $pengumuman->formatted_date = $pengumuman->created_at->translatedFormat('j F Y, H:i');

            return view('frontend.page.show-pengumuman', compact('pengumuman'));
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
