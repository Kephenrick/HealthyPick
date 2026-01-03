<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';
    protected $primaryKey = 'Vendor_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID', 'User_ID');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'Vendor_ID', 'Vendor_ID');
    }

    public function transactions()
    {
        return $this->hasMany(TransactionHeader::class, 'Vendor_ID', 'Vendor_ID');
    }
}
