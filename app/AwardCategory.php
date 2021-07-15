<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardCategory extends Model
{
    protected $guarded=[];

    public function awardtype()
    {
        return $this->belongsTo(AwardType::class, 'award_type_id');
    }

    public function awardcategorycontents()
    {
        return $this->hasMany(AwardCategoryContent::class, 'award_category_id', 'id');
    }
}
