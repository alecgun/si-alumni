<?php

namespace App\DataTables;

use App\Services\PengumumanService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengumumanDataTables
{
    protected $pengumumanService;

    public function __construct(PengumumanService $pengumumanService)
    {
        $this->pengumumanService = $pengumumanService;
    }

    public function getData(Request $request)
    {
        $query = $this->pengumumanService->getPengumumanQuery();

        if ($search = $request->input('search.value')) {
            $query = $this->pengumumanService->searchPengumumans($query, $search);
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
            'data' => $data->map(function ($pengumuman, $index) use ($start) {
                Carbon::setLocale('id');
                return [
                    'iteration' => $start + $index + 1,
                    'judul' => $pengumuman->judul,
                    'created_at' => Carbon::parse($pengumuman->created_at)->translatedFormat('j F Y H:i:s'),
                    'actions' => $this->getActions($pengumuman),
                ];
            }),
        ];
    }

    protected function getActions($pengumuman)
    {
        $showButton = auth()->user()->can('pengumuman.show', $pengumuman) ? '
            <button class="btn btn-info btn-sm me-2 show-button" data-id="' . $pengumuman->id . '">Lihat</button>' : '';
        $editButton = auth()->user()->can('pengumuman.edit', $pengumuman) ? '
            <button class="btn btn-warning btn-sm me-2 edit-button" data-id="' . $pengumuman->id . '">Ubah</button>' : '';
        $deleteButton = auth()->user()->can('pengumuman.delete', $pengumuman) ? '
            <button class="btn btn-danger btn-sm me-2 delete-button" data-id="' . $pengumuman->id . '">Hapus</button>' : '';

        return '<div class="text-center">' . $showButton . $editButton . $deleteButton . '</div>';
    }
}
