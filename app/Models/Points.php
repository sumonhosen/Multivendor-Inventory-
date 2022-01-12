<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
  protected $table = 'points_history';

  public function distributor(){
    return $this->belongsTo(User::class,'purchased_by','id');
  }
}
