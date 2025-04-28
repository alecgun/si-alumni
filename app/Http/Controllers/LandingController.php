<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\DataTables\DataAlumniDataTables;

class LandingController extends Controller implements HasMiddleware
{
    /**
     * Constructor to apply middleware.
     */

    protected $dataAlumniDataTable;


    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['logout']),
        ];
    }

    public function __construct(DataAlumniDataTables $dataAlumniDataTable)
    {
        $this->dataAlumniDataTable = $dataAlumniDataTable;
    }

    public function index()
    {
        return view('frontend.page.landing');
    }

    public function dataAlumni(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->dataAlumniDataTable->getData($request));
        }

        return view('frontend.page.alumni');
    }

}
