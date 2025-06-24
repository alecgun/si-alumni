<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Middleware\PermissionMiddleware;

class DashboardController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth', 'verified',
            new Middleware(PermissionMiddleware::using('dashboard'), only: ['index']),
        ];
    }

    public function index(Request $request)
    {
        $yearRange = $request->input('year_range', 10); // Default 10 tahun terakhir

        $query = Alumni::query()
            ->select([
                'tahun_lulus',
                DB::raw('COUNT(CASE WHEN jenis_kelamin = "L" THEN 1 END) as jumlah_laki'),
                DB::raw('COUNT(CASE WHEN jenis_kelamin = "P" THEN 1 END) as jumlah_perempuan'),
            ])
            ->groupBy('tahun_lulus');

        if ($yearRange !== 'all') {
            $query->where('tahun_lulus', '>=', now()->subYears($yearRange)->year);
        }

        $data = $query->orderByDesc('tahun_lulus')->get();

        $alumniCount = Alumni::count();

        $openTicketCount = DB::table('ticket')
            ->where('status_ticket', 'Open')
            ->count();

        $openTicket = DB::table('ticket')
            ->where('status_ticket', 'Open')
            ->select('ticket.*', 'users.name as nama_user', 'alumni.nis as nis')
            ->join('alumni', 'ticket.id_user', '=', 'alumni.id_user')
            ->join('users', 'ticket.id_user', '=', 'users.id')
            ->orderBy('created_at')
            ->limit(6)
            ->get()
            ->map(function ($ticket) {
            $ticket->formatted_created_at = Carbon::parse($ticket->created_at)
                ->locale('id')
                ->translatedFormat('j F Y, H:i');
                return $ticket;
            });

        return view('backend.dashboard.index', compact('data', 'alumniCount', 'openTicketCount', 'openTicket', 'yearRange'));
    }
}
