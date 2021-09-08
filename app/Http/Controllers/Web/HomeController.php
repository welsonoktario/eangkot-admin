<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Web/Welcome', [
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function angkot()
    {
        return 'helo';
    }
}
