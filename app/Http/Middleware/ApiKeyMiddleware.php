<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('api_key');

        if (!$apiKey) {
            return response()->json(['message' => 'API key is missing'], 401);
        }

        $user = User::where('api_key', $apiKey)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid API key'], 401);
        }

        $request->merge(['user_id' => $user->id]);

        return $next($request);
    }
}
