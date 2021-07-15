<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberAwardLog extends Model
{
    protected $table='members_award_log';
    protected $guarded=[];

    public function awardcategory()
    {
        return $this->belongsTo(AwardCategory::class, 'award_category_id');
    }
}
