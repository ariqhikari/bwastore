<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'code', 'transaction_id', 'product_id', 'price', 'shipping_status', 'resi'
    ];

    protected $hidden = [

    ];

    public function transaction(){
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
