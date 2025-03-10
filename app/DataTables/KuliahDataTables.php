<?php

namespace App\DataTables;

use App\Services\KuliahService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KuliahDataTables
{
    protected $kuliahService;

    public function __construct(KuliahService $kuliahService)
    {
        $this->kuliahService = $kuliahService;
    }

    public function getData(Request $request)
    {
        $query = $this->kuliahService->getKuliahByAlumni();

        if ($search = $request->input('search.value')) {
            $query = $this->kuliahService->searchKuliahs($query, $search);
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
            'data' => $data->map(function ($kuliah, $index) use ($start) {
                Carbon::setLocale('id');
                return [
                    'iteration' => $start + $index + 1,
                    'jenjang' => $kuliah->jenjang,
                    'jalur_masuk' => $kuliah->jalur_masuk,
                    'tahun_masuk' => $kuliah->tahun_masuk,
                    'tahun_lulus' => $kuliah->tahun_lulus,
                    'created_at' => Carbon::parse($kuliah->created_at)->translatedFormat('j F Y'),
                    'updated_at' => Carbon::parse($kuliah->updated_at)->translatedFormat('j F Y'),
                    'actions' => $this->getActions($kuliah),
                ];
            }),
        ];
    }

    protected function getActions($kuliah)
    {
        $editButton = auth()->user()->can('kuliah.edit', $kuliah) ? '
            <button class="btn btn-warning btn-sm me-2 edit-button" data-id="' . $kuliah->id . '">Ubah</button>' : '';
        $deleteButton = auth()->user()->can('kuliah.delete', $kuliah) ? '
            <button class="btn btn-danger btn-sm delete-button" data-id="' . $kuliah->id . '">Hapus</button>' : '';

        return '<div class="text-center">' . $editButton . $deleteButton . $kuliahButton . $kerjaButton . '</div>';
    }
}
