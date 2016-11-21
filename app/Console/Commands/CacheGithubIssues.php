<?php

namespace App\Console\Commands;

use Cache;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Console\Command;

class CacheGithubIssues extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:githubissues';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the GitHub issue list cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Fetching GitHub issues...');

        $issues = GitHub::me()->issues();

        $this->info('Processing pull requests...');

        $pullRequests = [];

        for ($i = 0; $i < count($issues); $i++) {
            if (isset($issues[$i]['pull_request'])) {
                $pullRequests[] = $issues[$i];
                unset($issues[$i]);
            }
        }

        Cache::forever('github.issues', $issues);
        Cache::forever('github.pullrequests', $pullRequests);
    }
}
