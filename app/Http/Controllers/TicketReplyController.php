<?php

namespace App\Http\Controllers;

use App\StoreClass\LogAktivitas;
use App\Http\Requests\TicketReplyRequest;
use App\Models\TicketReply;
use App\Services\TicketReplyService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middleware\PermissionMiddleware;

class TicketReplyController extends Controller implements HasMiddleware
{
    protected $ticketReplyService;

    public static function middleware(): array
    {
        return [
            'auth', 'verified',
            new Middleware(PermissionMiddleware::using('ticket'), only: ['index']),
            new Middleware(PermissionMiddleware::using('ticket.create'), only: ['store']),
            new Middleware(PermissionMiddleware::using('ticket.edit'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('ticket.delete'), only: ['destroy']),
        ];
    }

    public function __construct(TicketReplyService $ticketReplyService)
    {
        $this->ticketReplyService = $ticketReplyService;
    }

    public function index(Request $request)
    {

    }

    public function create()
    {
        // Tidak digunakan
    }

    public function store(TicketReplyRequest $request)
    {
        $result = $this->ticketReplyService->createTicketReply($request->all());
        if ($result['status']) {
            LogAktivitas::log('Menambah data teks balasan', $request->path(), null, $result['ticket_reply'], Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Teks balasan berhasil dibuat']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function show(TicketReply $ticket_reply)
    {
        $result = $this->ticketReplyService->showTicketReply($ticket_reply);
        if ($result['status']) {
            return response()->json($result['ticket_reply']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function getReplies($id_ticket)
    {
        $result = $this->ticketReplyService->getTicketRepliesQuery($id_ticket);
        if ($result['status']) {
            return response()->json($result['ticket_reply']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function edit(TicketReply $ticket_reply)
    {
        $result = $this->ticketReplyService->editTicketReply($ticket_reply);
        if ($result['status']) {
            return response()->json($result['ticket_reply']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function update(TicketReplyRequest $request, TicketReply $ticket_reply)
    {
        $result = $this->ticketReplyService->updateTicketReply($ticket_reply, $request->all());
        if ($result['status']) {
            LogAktivitas::log('Mengubah data teks balasan', $request->path(), $result['ticket_reply'], $request->all(), Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data teks balasan berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function destroy(TicketReply $ticket_reply)
    {
        $result = $this->ticketReplyService->deleteTicketReply($ticket_reply);
        if ($result['status']) {
            LogAktivitas::log('Menghapus data teks balasan', request()->path(), $result, null, Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data teks balasan berhasil dihapus']);
        }
        if (strpos($result['message'], 'Data teks balasan ini memiliki data terkait yang tidak dapat dihapus.') !== false) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function data()
    {
        $ticket_reply = TicketReply::all();
        return response()->json($ticket_reply);
    }
}
