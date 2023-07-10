<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CardController extends Controller
{
    public function index(): View
    {
        return view('auth.cards.cards', [
            'name' => Auth::user()->name,
            'cards' => Card::whereBelongsTo(Auth::user())->get()
        ]);
    }

    public function add(): View
    {
        return  view('auth.cards.add-card');
    }

    public function save(): RedirectResponse
    {
        request()->all();
        $attributes = request()->validate([
            'card_number' => ['string', 'min:16', 'max:16', 'required'],
            'expire_date' => ['string', 'min:5', 'max:5', 'required'],
            'card_cvc' => ['string', 'min:3', 'max:3', 'required']
        ]);

        Card::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'card_number' => $attributes['card_number'],
            'expire_date' => $attributes['expire_date'],
            'card_cvc' => (int)$attributes['card_cvc']
        ]);

        return redirect('/cards');
    }
}
