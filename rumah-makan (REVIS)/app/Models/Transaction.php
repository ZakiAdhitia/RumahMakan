<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //protected $table = 'transaction';
    protected $fillable = [
        "product_id",
        "produk_date" ,
        "quantity",
];

public function products(){
    return $this->belongsTo(Product::class);
}

}
