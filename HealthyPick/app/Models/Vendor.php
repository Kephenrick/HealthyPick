<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $primaryKey = 'Vendor_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['Vendor_ID', 'Name', 'Address', 'Phone_Number'];

    public function products()
    {
        return $this->hasMany(Product::class, 'Vendor_ID', 'Vendor_ID');
    }
}
