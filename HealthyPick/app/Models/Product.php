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

    // Accessor untuk kompatibilitas dengan view yang menggunakan uppercase
    public function getNameAttribute()
    {
        return $this->attributes['name'];
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description'];
    }

    public function getPriceAttribute()
    {
        return $this->attributes['price'];
    }

    public function getStockAttribute()
    {
        return $this->attributes['stock'];
    }

    public function getImageAttribute()
    {
        return $this->attributes['image'];
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'Vendor_ID', 'Vendor_ID');
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'Product_ID', 'Product_ID');
    }
}

