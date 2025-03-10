<?php

namespace App\DataTables;

use App\Services\AlumniService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlumniDataTables
{
    protected $alumniService;

    public function __construct(AlumniService $alumniService)
    {
        $this->alumniService = $alumniService;
    }

    public function getData(Request $request)
    {
        $query = $this->alumniService->getAlumniQuery();

        if ($search = $request->input('search.value')) {
            $query = $this->alumniService->searchAlumnis($query, $search);
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
            'data' => $data->map(function ($alumni, $index) use ($start) {
                Carbon::setLocale('id');
                return [
                    'iteration' => $start + $index + 1,
                    'nis' => $alumni->nis,
                    'nama' => $alumni->nama,
                    'kelas' => $alumni->kelas,
                    'tahun_masuk' => $alumni->tahun_masuk,
                    'tahun_lulus' => $alumni->tahun_lulus,
                    'instagram' => $alumni->instagram,
                    'created_at' => Carbon::parse($alumni->created_at)->translatedFormat('j F Y'),
                    'updated_at' => Carbon::parse($alumni->updated_at)->translatedFormat('j F Y'),
                    'actions' => $this->getActions($alumni),
                ];
            }),
        ];
    }

    protected function getActions($alumni)
    {
        $editButton = auth()->user()->can('alumni.edit', $alumni) ? '
            <button class="btn btn-warning btn-sm me-2 edit-button" data-id="' . $alumni->id . '">Ubah</button>' : '';
        $deleteButton = auth()->user()->can('alumni.delete', $alumni) ? '
            <button class="btn btn-danger btn-sm me-2 delete-button" data-id="' . $alumni->id . '">Hapus</button>' : '';
        $kuliahButton = auth()->user()->can('kuliah.index', $alumni) ? '
            <button class="btn btn-primary btn-sm me-2 kuliah-button" data-id="' . $alumni->id . '">Kuliah</button>' : '';
        $kerjaButton = auth()->user()->can('kerja.index', $alumni) ? '
            <button class="btn btn-primary btn-sm kerja-button" data-id="' . $alumni->id . '">Kerja</button>' : '';

        return '<div class="text-center">' . $editButton . $deleteButton . $kuliahButton . $kerjaButton . '</div>';
    }
}
