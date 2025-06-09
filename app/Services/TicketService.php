<?php

namespace App\Services;

use App\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class TicketService
{
    public function createTicket($data)
    {
        DB::beginTransaction();
        try {
            $ticket = Ticket::create($data);
            DB::commit();
            return ['status' => true, 'ticket' => $ticket];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal membuat data ticket: ' . $e->getMessage()];
        }
    }

    public function showTicket(Ticket $ticket)
    {
        try {
            $ticket = Ticket::select(
                'ticket.id',
                'ticket.kategori',
                'ticket.judul',
                'ticket.status_ticket',
                'ticket.deskripsi',
                'ticket.alumni_id',
                'alumni.nama as nama_alumni',
                'ticket.email',
                'ticket.created_at'
            )
            ->join('alumni', 'ticket.alumni_id', '=', 'alumni.id')
            ->where('ticket.id', $ticket->id)
            ->first();
            return ['status' => true, 'ticket' => $ticket];
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Terjadi kesalahan saat mengambil data ticket: ' . $e->getMessage()], 500);
        }
    }

    public function editTicket(Ticket $ticket)
    {
        try {
            return ['status' => true, 'ticket' => $ticket];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data ticket untuk diedit: ' . $e->getMessage()];
        }
    }

    public function updateTicket(Ticket $ticket, $data)
    {
        DB::beginTransaction();
        try {
            $ticket->update($data);
            DB::commit();
            return ['status' => true, 'ticket' => $ticket];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal memperbarui data ticket: ' . $e->getMessage()];
        }
    }

    public function deleteTicket(Ticket $ticket)
    {
        DB::beginTransaction();
        try {
            $ticket->delete();
            DB::commit();
            return ['status' => true];
        } catch (QueryException $e) {
            DB::rollback();

            if ($e->getCode() === '23000') {
                return ['status' => false, 'message' => 'Gagal menghapus data ticket: Data ticket ini memiliki data terkait yang tidak dapat dihapus.'];
            }

            return ['status' => false, 'message' => 'Gagal menghapus data ticket: ' . $e->getMessage()];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal menghapus data ticket: ' . $e->getMessage()];
        }
    }

    public function getTicketQuery()
    {
        try {
            return Ticket::select(
                'ticket.id',
                'ticket.judul',
                'ticket.status_ticket',
                'ticket.kategori',
                'ticket.alumni_id',
                'alumni.nama as nama_alumni',
                'ticket.email',
                'ticket.created_at'
            )->join('alumni', 'ticket.alumni_id', '=', 'alumni.id');
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data ticket: ' . $e->getMessage()];
        }
    }

    public function searchTickets($query, $search)
    {
        try {
            return $query->where(function ($q) use ($search) {
                $q->where('ticket.jenjang', 'like', "%{$search}%")
                    ->orWhere('ticket.jalur_masuk', 'like', "%{$search}%")
                    ->orWhere('ticket.tahun_masuk', 'like', "%{$search}%")
                    ->orWhere('ticket.tahun_lulus', 'like', "%{$search}%");
            });
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mencari data ticket: ' . $e->getMessage()];
        }
    }
}
