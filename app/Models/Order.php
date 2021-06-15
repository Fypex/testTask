<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed product_id
 * @property mixed|string amount
 * @property mixed|string price
 * @property mixed|string user_id
 * @property mixed id
 */
class Order extends Model
{
    use HasFactory;

    public function Items(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

}
