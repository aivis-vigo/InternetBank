<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $table = 'bankAccounts';

    protected $fillable = [
        'account_id',
        'balance',
        'IBAN',
        'currency_code'
    ];
}
