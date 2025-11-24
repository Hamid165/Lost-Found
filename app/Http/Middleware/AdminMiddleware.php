<?php

namespace App\Http\Middleware;

use App\Models\User; // Import Model User
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil user dari request
        $user = $request->user();

        // PERBAIKAN:
        // 1. Cek $user tidak null
        // 2. Cek $user adalah instance dari App\Models\User (supaya method isAdmin dikenali)
        // 3. Cek method isAdmin()
        if ($user instanceof User && $user->isAdmin()) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have admin access.');
    }
}