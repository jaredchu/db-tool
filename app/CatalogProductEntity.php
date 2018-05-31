<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogProductEntity extends Model
{
    protected $table = 'catalog_product_entity';
    protected $guarded = [];
    protected $primaryKey = 'entity_id';
    public $timestamps = false;
}
