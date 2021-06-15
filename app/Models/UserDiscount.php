<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiscount extends Model
{
    use HasFactory;
    protected $table = 'user_discounts';

    protected $fillable = [
        'user_id',
        'discount_id',
        'active'
    ];

    public function Discount(){
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

}
