<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'User_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'User_ID', 'User_ID');
    }

    public function transactions()
    {
        return $this->hasMany(TransactionHeader::class, 'Customer_ID', 'User_ID');
    }

}


