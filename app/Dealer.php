<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    //

   public function sales()
   {
    return $this->hasMany(TransactionDetail::class,'dealer_id','user_id');
   }
    public function transactions()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
