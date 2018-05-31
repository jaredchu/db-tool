<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $guarded = [];
    protected $primaryKey = 'review_id';
    public $timestamps = false;
}
