<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
  protected $table = 'order_products';

  public function products()
  {
      return $this->belongsTo(Product::class);
  }
}
