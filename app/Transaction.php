<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code', 'user_id', 'insurance_price', 'shipping_price', 'total_price', 'transaction_status'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
