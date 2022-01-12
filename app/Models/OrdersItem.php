<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersItem extends Model
{
  protected $table = 'orders_items';

  public function order_item()
  {
    return $this->belongsToMany(Post::class,'order_id','id');
  }
}
