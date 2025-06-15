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

    public function store(TicketReplyRequest $request)
    {
        $result = $this->ticketReplyService->createTicketReply($request->all());
        if ($result['status']) {
            LogAktivitas::log('Menambah data teks balasan', $request->path(), null, $result['ticket_reply'], Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Teks balasan berhasil dibuat']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function storeImage(Request $request)
    {
        $result = $this->ticketReplyService->createTicketReplyImage($request);
        if ($result['status']) {
            return response()->json(['success' => true, 'url' => $result['url']]);
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
}
