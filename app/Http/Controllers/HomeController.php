<?php

namespace App\Http\Controllers;

use App\Note;
use Cache;
use GrahamCampbell\GitHub\Facades\GitHub;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', ['pageTitle' => 'Home']);
    }

    public function dashboard()
    {
        $noteCount = Note::count();
        $pullRequests = [];

        $issues = Cache::remember('github-issues', 20, function () {
            return GitHub::me()->issues();
        });

        for ($i = 0; $i < count($issues); $i++) {
            if (isset($issues[$i]['pull_request'])) {
                $pullRequests[] = $issues[$i];
                unset($issues[$i]);
            }
        }

        $issues = array_values($issues); // to normalize array keys

        return view('home.dashboard', ['pageTitle' => 'Dashboard'])->with([
            'noteCount'    => $noteCount,
            'issues'       => $issues,
            'pullRequests' => $pullRequests,
        ]);
    }
}
