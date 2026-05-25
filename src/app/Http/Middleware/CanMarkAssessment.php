<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanMarkAssessment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $studentId = $request->route('userId');

        if (! User::where('id', $studentId)->where('assigned_instructor_id', $request->user()->id)->exists()) {
            abort(403, 'You do not have permission to mark this assessment.');
        }

        return $next($request);
    }
}
