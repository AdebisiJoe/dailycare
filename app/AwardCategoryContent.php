<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardCategoryContent extends Model
{
    protected $table='award_category_contents';
    protected $guarded =[];

    public function awardcategory()
    {
        return $this->belongsTo(AwardCategory::class, 'award_category_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function accessory()
    {
        return $this->belongsTo(Accessory::class, 'product_id');
    }
}
