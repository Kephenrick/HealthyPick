<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $table = 'transactionitems';
    protected $primaryKey = 'Transaction_Item_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(TransactionHeader::class, 'Transaction_ID', 'Transaction_ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_ID', 'Product_ID');
    }
}
