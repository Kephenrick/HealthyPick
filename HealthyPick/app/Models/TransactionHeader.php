<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    protected $primaryKey = 'Transaction_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['Transaction_ID', 'Customer_ID', 'Product_ID', 'Quantity'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_ID', 'Customer_ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID', 'Product_ID'); 
    }
}
