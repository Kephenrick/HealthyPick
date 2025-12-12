<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'Product_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['Product_ID', 'Name', 'Description', 'Price', 'Vendor_ID', 'Stock'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'Vendor_ID', 'Vendor_ID');
    }

    public function transactionHeaders()
    {
        return $this->hasMany(TransactionHeader::class, 'Product_ID', 'Product_ID');
    }
}
