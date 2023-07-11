<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentAccount extends Model
{
    use HasFactory;

    protected $table = 'investmentAccounts';

    protected $fillable = [
        'user_id',
        'balance',
        'iban',
        'currency_code'
    ];
}
