<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function stock_type()
    {
        return $this->belongsTo(StockType::class);
    }
}
