<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Accounts
 *
 * Represents the model for the 'bankAccounts' table.
 *
 * @package App\Models
 */
class Accounts extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bankAccounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'balance',
        'IBAN',
        'currency_code'
    ];
}
