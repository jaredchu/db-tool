<?php

namespace App\Console\Commands;

use App\CatalogProductEntity;
use App\Review;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fixreview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix reviews by set entity_pk_value random productIds';

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
        $allReviews = Review::all();
        foreach ($allReviews as $review){
            $randomProduct = CatalogProductEntity::on()->inRandomOrder()->first();
            $review->entity_pk_value = $randomProduct->entity_id;
            $review->save();
        }
    }
}
