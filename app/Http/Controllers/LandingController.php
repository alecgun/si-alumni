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

class LandingController extends Controller implements HasMiddleware
{
    /**
     * Constructor to apply middleware.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['logout']),
        ];
    }

    public function index()
    {
        return view('frontend.page.landing');
    }

    public function dataAlumni()
    {
        $alumniData = DB::table('alumni')
            ->select(
                'alumni.nis',
                'alumni.nama',
                'alumni.kelas',
            )->get();

        return view('frontend.page.alumni')
            ->with([
                'alumniData' => $alumniData,
            ]);
    }

}
