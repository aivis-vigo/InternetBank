<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CardController extends Controller
{
    public function index(): View
    {
        $cards = DB::table('bankCards')->where('user_id', Auth::user()->getAuthIdentifier())->get();

        return view('auth.cards', [
            'name' => Auth::user()->name,
            'cards' => $cards
        ]);
    }
    public function add(): View
    {
        return  view('auth.add-card');
    }

    public function save(): RedirectResponse
    {
        $attributes = request()->validate([
            'card_number' => ['string', 'min:16', 'max:16', 'required'],
            'expire_date' => ['string', 'min:5', 'max:5', 'required'],
            'card_cvc' => ['string', 'min:3', 'max:3', 'required']
        ]);

        Card::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'card_number' => $attributes['card_number'],
            'expires_at' => $attributes['expire_date'],
            'cvc' => $attributes['card_cvc']
        ]);

        return redirect('/cards');
    }
}
