<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Validation\ValidationException;

class IsStudentRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::where(Fortify::username(), $request->{Fortify::username()})->first();

        if ($user && $user->role != "student") { 
            throw ValidationException::withMessages([
                Fortify::username() => ['Only students can this log through this page'],
            ]);
        }

        return $next($request);
    }
}
