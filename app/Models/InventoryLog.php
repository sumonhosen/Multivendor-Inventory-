<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $table='inventory_logs';
    protected $fillable = [
        'product_id', 'order_id', 'current_stock', 'stock_in_or_out', 'previous_stock', 'created_by', 'updated_by'
    ];
    public function inventory_log()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function stock()
    {
        return $this->belongsTo(ProductExtra::class,'product_id','product_id');
    }
    public function create_order(){
        return $this->belongsTo(User::class,'created_by','id');
    }

}
