<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class RedeemedHistory extends Model
{
    protected $table = 'redeemed_histories';
    
    protected $fillable = [
        'user_id',
        'reward_id',
        'points_amount',
        'status',
        'viewed',
        'redeemed_at',
=======
class Notification extends Model
{
    protected $table = 'notifications';
    
    protected $fillable = [
        'user_id',
        'notif_id',
        'type',
>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e
    ];

    public $timestamps = true;

<<<<<<< HEAD
    // Relationship to User
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    // Relationship to Reward
    public function reward()
    {
        return $this->belongsTo('App\Reward', 'reward_id');
    }

    // Cast dates properly
    protected $dates = [
        'created_at',
        'updated_at',
        'redeemed_at'
    ];

    // Default values
    protected $attributes = [
        'viewed' => 0,
        'status' => 'Submitted'
    ];
=======
    public function user()
    {
        return $this->belongsTo('App\User');
    }
>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e
}