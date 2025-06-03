<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

    public function serial()
    {
        return $this->belongsTo(Stove::class,'serial_number','id');
    }

    public function transactions()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
