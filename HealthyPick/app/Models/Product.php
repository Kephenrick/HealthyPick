<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'Product_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'Vendor_ID', 'Vendor_ID');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'Product_ID', 'Product_ID');
    }
}

