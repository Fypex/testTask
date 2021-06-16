<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed|null user_id
 * @property mixed total
 * @property mixed subtotal
 * @property float|mixed discount
 */
class Order extends Model
{
    use HasFactory;

    public function Items(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

}
