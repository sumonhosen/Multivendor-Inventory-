<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
  protected $table = 'role_user';

  public function post()
  {
      return $this->belongsTo(PostExtra::class, 'post_id','id');
  }
  public function distributors(){
  	 return $this->belongsTo(User::class, 'user_id','id');
  }
 
}
