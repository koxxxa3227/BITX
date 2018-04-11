<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class DepositAccrued
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $me = \Auth::user();

        $depositAccrued = $me->depositsAccrued;


        if($depositAccrued) {
            foreach ($depositAccrued as $item) {
                do {
                    if ($item->last_accrued >= $item->end_date) {
                        break;
                    } else {
                        if ($item->last_accrued >= Carbon::today()) {
                            break;
                        } else {
                            $item->last_accrued = Carbon::parse($item->last_accrued)->addDay();
                            $value = $item->deposit->income_with_percent / $item->deposit->plan->days_multiply;
                            $item->deposit->increment('accrued', $value);
                            $item->save();
                        }
                    }
                } while (true);
            }
        }

        return $next($request);
    }
}
