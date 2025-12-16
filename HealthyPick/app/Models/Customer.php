<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $primaryKey = 'Customer_ID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Customer_ID',
        'Name',
        'Email',
        'Phone_Number',
        'Password', // match column casing
    ];

    protected $hidden = ['Password'];
    protected $casts = ['Password' => 'hashed'];

    // Identifiable untuk Laravel - gunakan Email sebagai identifier
    public function getAuthIdentifierName()
    {
        return $this->getKeyName(); // Primary key: Customer_ID
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getAuthPasswordName()
    {
        return 'Password';
    }

    /**
     * Disable Laravel remember token operations for this model.
     * The customers table does not have a `remember_token` column,
     * so we override the remember token methods to no-op.
     */
    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // no-op to avoid writing a remember_token column that doesn't exist
    }

    public function getRememberTokenName()
    {
        return null;
    }
}


