<?php

namespace App\Console\Commands;

use App\JournalEntry;
use App\Note;
use App\TaskCategory;
use App\Task;
use Illuminate\Console\Command;

class UpdateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update statistics.';

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
        $taskCount = Task::count();
        datadog()->gauge('tasks.count', $taskCount);

        $taskCategoryCount = TaskCategory::count();
        datadog()->gauge('task_categories.count', $taskCategoryCount);

        $noteCount = Note::count();
        datadog()->gauge('notes.count', $noteCount);

        $journalEntryCount = JournalEntry::count();
        datadog()->gauge('journal_entries.count', $journalEntryCount);
    }
}
