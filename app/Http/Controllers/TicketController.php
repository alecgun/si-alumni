<?php

namespace App\Http\Controllers;

use App\StoreClass\LogAktivitas;
use App\DataTables\TicketDataTables;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middleware\PermissionMiddleware;

class TicketController extends Controller implements HasMiddleware
{
    protected $ticketService;
    protected $ticketDataTable;

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

    public function __construct(TicketService $ticketService, TicketDataTables $ticketDataTable)
    {
        $this->ticketService = $ticketService;
        $this->ticketDataTable = $ticketDataTable;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->ticketDataTable->getData($request));
        }

        return view('backend.ticket.index');
    }

    public function create()
    {
        // Tidak digunakan
    }

    public function store(TicketRequest $request)
    {
        $result = $this->ticketService->createTicket($request->all());
        if ($result['status']) {
            LogAktivitas::log('Menambah data ticket', $request->path(), null, $result['ticket'], Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data ticket berhasil dibuat']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function show(Ticket $ticket)
    {
        $result = $this->ticketService->showTicket($ticket);
        if ($result['status']) {
            return response()->json($result['ticket']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function edit(Ticket $ticket)
    {
        $result = $this->ticketService->editTicket($ticket);
        if ($result['status']) {
            return response()->json($result['ticket']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        $result = $this->ticketService->updateTicket($ticket, $request->all());
        if ($result['status']) {
            LogAktivitas::log('Mengubah data ticket', $request->path(), $result['ticket'], $request->all(), Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data ticket berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function destroy(Ticket $ticket)
    {
        $result = $this->ticketService->deleteTicket($ticket);
        if ($result['status']) {
            LogAktivitas::log('Menghapus data ticket', request()->path(), $result, null, Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data ticket berhasil dihapus']);
        }
        if (strpos($result['message'], 'Data ticket ini memiliki data terkait yang tidak dapat dihapus.') !== false) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function data()
    {
        $ticket = Ticket::all();
        return response()->json($ticket);
    }
}
