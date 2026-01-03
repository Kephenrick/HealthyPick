<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    protected $table = 'transactionheaders';
    protected $primaryKey = 'Transaction_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(User::class, 'Customer_ID', 'User_ID');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'Vendor_ID', 'Vendor_ID');
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class, 'Transaction_ID', 'Transaction_ID');
    }
}
