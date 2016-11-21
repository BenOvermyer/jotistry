<?php namespace App;

use Cache;
use Config;
use GrahamCampbell\GitHub\Facades\GitHub;

class GitHubAPI
{
    public function issues()
    {
        $issues = Cache::get('github.issues');

        return $issues;
    }

    public function pullRequests()
    {
        $pullRequests = Cache::get('github.pullrequests');

        return $pullRequests;
    }
}
