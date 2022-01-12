<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $table = 'posts';

 

  public function products()
  {
      return $this->belongsToMany(Product::class,'order_products','order_id','product_id');
  }
  public function distributor(){
    return $this->belongsTo(User::class,'post_author_id','id');
  }

}
