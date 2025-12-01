<?php

namespace App;
<<<<<<< HEAD

=======
    
>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
    protected $table = 'products';
    
=======

>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e
    protected $fillable = [
        'product_name',
        'price',
        'deposit',
<<<<<<< HEAD
        'product_image'
=======
        'product_image',
>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e
    ];

    protected $casts = [
        'price' => 'decimal:2',
<<<<<<< HEAD
        'deposit' => 'decimal:2',
=======
>>>>>>> cbcdc328ee536f65b48e8e78150a46183d1dd68e
    ];
}