<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemovePrefix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:removeprefix {prefix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove database prefix';

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
        $prefix = $this->argument('prefix');
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            foreach ($table as $key => $oldTableName)
                if (substr($oldTableName, 0, strlen($prefix)) == $prefix) {
                    $newTableName = substr($oldTableName, strlen($prefix));

                    if(Schema::hasTable($newTableName)){
                        $this->warn("TABLE $newTableName existed");
                    }
                    else{
                        $query = "RENAME TABLE $oldTableName TO $newTableName";
                        $this->info($query);
                        DB::statement($query);
                    }

                }
        }

        return 0;
    }
}
