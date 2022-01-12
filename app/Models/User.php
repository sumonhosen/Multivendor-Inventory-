<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   
  protected $table = 'users';
  protected $fillable = ['appliation_point'];
  //protected $primaryKey = 'id';
  
  public function roles()
  {
    return $this->belongsToMany('App\Models\Role');
  }
  public function details(){
    return $this->belongsTo(UsersDetail::class,'id','user_id');
  }
  
}
