<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InvestmentAccount
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && $this->hasInvestmentAccount()) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

    private function hasInvestmentAccount(): bool
    {
        return \App\Models\InvestmentAccount::query()->where('user_id', Auth::user()->getAuthIdentifier())->exists();
    }
}
