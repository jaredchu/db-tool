<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesSequenceMeta extends Model
{
    protected $table = 'sales_sequence_meta';
    protected $guarded = [];
    protected $primaryKey = 'meta_id';
}
