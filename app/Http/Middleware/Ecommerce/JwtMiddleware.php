<?php

namespace App\Http\Middleware\Ecommerce;

use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;
use \PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
use \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtMiddleware extends BaseMiddleware
{
  public function handle($request, Closure $next)
  {
    try {
      // Auth::guard('ec_users')->parseToken()->authenticate();
      $user = JWTAuth::parseToken()->authenticate();
    } catch (TokenExpiredException $e) {
      return response()->json(['error' => 'Token is expired'], 401);
    } catch (TokenInvalidException $e) {
      return response()->json(['error' => 'Token is invalid'], 401);
    } catch (Exception $e) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
    return $next($request);
  }
}
