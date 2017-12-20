<?php

namespace App\Console\Commands;

use App\SalesSequenceMeta;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixSSM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fixssm {prefix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix prefix of table sales_sequence_meta (Magento 2)';

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
        $salesSequences = SalesSequenceMeta::all();
        foreach ($salesSequences as $object){
            if (substr($salesSequences->sequence_table, 0, strlen($prefix)) == $prefix){
                $oldValue = $object->sequence_table;
                $object->sequence_table = substr($object->sequence_table, strlen($prefix));
                $this->info(strtr("Change sequence_table value from :from to :to",[
                    ':from' => $oldValue,
                    ':to' => $object->sequence_table
                ]));

                $object->save();
            }
        }

        return 0;
    }
}
