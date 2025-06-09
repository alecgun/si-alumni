<?php

namespace App\Services;

use App\Models\TicketReply;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class TicketReplyService
{
    public function createTicketReply($data)
    {
        DB::beginTransaction();
        try {
            $ticket_reply = TicketReply::create($data);
            DB::commit();
            return ['status' => true, 'ticket_reply' => $ticket_reply];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal membuat data teks balasan: ' . $e->getMessage()];
        }
    }

    public function showTicketReply(TicketReply $ticket_reply)
    {
        try {
            $ticket_reply = TicketReply::select(
                'ticket_reply.id',
                'ticket_reply.reply_text',
                'ticket_reply.id_ticket',
                'ticket_reply.id_user',
                'users.nama as nama_user',
                'ticket_reply.created_at'
            )
            ->join('users', 'ticket_reply.id_user', '=', 'users.id')
            ->where('ticket_reply.id', $ticket_reply->id)
            ->first();
            return ['status' => true, 'ticket_reply' => $ticket_reply];
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Terjadi kesalahan saat mengambil data teks balasan: ' . $e->getMessage()], 500);
        }
    }

    public function editTicketReply(TicketReply $ticket_reply)
    {
        try {
            return ['status' => true, 'ticket_reply' => $ticket_reply];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data teks balasan untuk diedit: ' . $e->getMessage()];
        }
    }

    public function updateTicketReply(TicketReply $ticket_reply, $data)
    {
        DB::beginTransaction();
        try {
            $ticket_reply->update($data);
            DB::commit();
            return ['status' => true, 'ticket_reply' => $ticket_reply];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal memperbarui data teks balasan: ' . $e->getMessage()];
        }
    }

    public function deleteTicketReply(TicketReply $ticket_reply)
    {
        DB::beginTransaction();
        try {
            $ticket_reply->delete();
            DB::commit();
            return ['status' => true];
        } catch (QueryException $e) {
            DB::rollback();

            if ($e->getCode() === '23000') {
                return ['status' => false, 'message' => 'Gagal menghapus data balasan: Data balasan ini memiliki data terkait yang tidak dapat dihapus.'];
            }
            return ['status' => false, 'message' => 'Gagal menghapus data balasan: ' . $e->getMessage()];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal menghapus data balasan: ' . $e->getMessage()];
        }
    }

    public function getTicketRepliesQuery($id_ticket)
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
            ->where('ticket_reply.id_ticket', $id_ticket)
            ->get();
            return ['status' => true, 'ticket_reply' => $ticket_reply];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data balasan: ' . $e->getMessage()];
        }
    }
}
