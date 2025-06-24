<?php

namespace App\DataTables;

use App\Services\TicketService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketDataTables
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function getData(Request $request)
    {
        $query = $this->ticketService->getTicketQuery();

        if ($search = $request->input('search.value')) {
            $query = $this->ticketService->searchTickets($query, $search);
        }

        $totalRecords = $query->count();

        if ($order = $request->input('order.0')) {
            $columnIndex = $order['column'];
            $columnName = $request->input("columns.{$columnIndex}.data");
            $direction = $order['dir'];

            if ($columnName != 'iteration') {
                $query->orderBy($columnName, $direction);
            }
        }

        $totalFiltered = $query->count();
        $length = $request->input('length');
        $start = $request->input('start');
        $query->skip($start)->take($length);

        $data = $query->get();

        return [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $data->map(function ($ticket, $index) use ($start) {
                Carbon::setLocale('id');
                return [
                    'id' => $ticket->id,
                    'judul' => $ticket->judul,
                    'status_ticket' => $ticket->status_ticket,
                    'kategori' => $ticket->kategori,
                    'nama_user' => $ticket->nama_user,
                    'email' => $ticket->email,
                    'created_at' => Carbon::parse($ticket->created_at)->translatedFormat('j F Y H:i'),
                    'actions' => $this->getActions($ticket),
                ];
            }),
        ];
    }

    protected function getActions($ticket)
    {
        $showButton = auth()->user()->can('ticket.show', $ticket) ? '
            <button class="btn btn-info btn-sm me-2 show-button" data-id="' . $ticket->id . '">Lihat</button>' : '';
        $deleteButton = auth()->user()->can('ticket.delete', $ticket) ? '
            <button class="btn btn-danger btn-sm me-2 delete-button" data-id="' . $ticket->id . '">Hapus</button>' : '';

        return '<div class="text-center">' . $showButton . $deleteButton . '</div>';
    }
}
