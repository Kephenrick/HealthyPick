<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'Customer_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['Customer_ID', 'Name', 'Phone_Number'];


    public function transactionHeaders()
    {
        return $this->hasMany(TransactionHeader::class, 'Customer_ID', 'Customer_ID');
    }
}
