<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'bankCards';

    protected $fillable = [
        'user_id',
        'card_number',
        'expires_at',
        'cvc'
    ];
}
