<?php

namespace App\DataTables;

use App\Services\AlumniService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataAlumniDataTables
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
                    'nis' => $alumni->nis,
                    'nama' => $alumni->nama,
                    'kelas' => $alumni->kelas,
                    'tahun_lulus' => $alumni->tahun_lulus,
                    'instagram' => $alumni->instagram,
                ];
            }),
        ];
    }

}
