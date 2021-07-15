<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembersAwardsDetails extends Model
{
   protected $guarded = [];

   public function member()
   {
       return $this->belongsTo(Members::class, 'membership_id', 'membershipid');
   }

    public function award_category()
    {
        return $this->belongsTo(AwardCategory::class, 'award_category_id');
    }
}
