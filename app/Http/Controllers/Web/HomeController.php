<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Kreait\Firebase\Firestore;

class HomeController extends Controller
{
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function index()
    {
        return Inertia::render('Web/Welcome', [
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function angkot()
    {
        $db = $this->firestore->database();
        $documents = $db->collection('angkots')->documents();
        $angkots = [];

        foreach ($documents as $index => $document) {
            $data = $document->data();
            $data['lokasi'] = new Point($data['lokasi']->latitude(), $data['lokasi']->longitude());
            $penumpangs = [];

            $penumpangRef = $db->collection('penumpangs-'.$document->id())->documents();
            foreach($penumpangRef as $i => $doc) {
                $penumpang = $doc->data();
                $lok = [
                    new Point($penumpang['rute']['jemput']->latitude(), $penumpang['rute']['jemput']->longitude()),
                    new Point($penumpang['rute']['tujuan']->latitude(), $penumpang['rute']['tujuan']->longitude()),
                ];
                $penumpang['rute'] = $lok;
                $penumpangs[$i] = $penumpang;
            }
            $data['penumpangs'] = $penumpangs;
            $angkots[$index] = $data;
        }

        return response()->json(['angkots' => $angkots]);
    }
}
