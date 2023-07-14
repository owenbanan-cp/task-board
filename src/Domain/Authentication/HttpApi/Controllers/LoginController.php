<?php

namespace Domain\Authentication\HttpApi\Controllers;

use Domain\Authentication\HttpApi\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Authenticate user base on the credentials provided
     *
     * @param LoginRequest $loginRequest
     * @return JsonResponse|Response
     */
    public function __invoke(LoginRequest $loginRequest)
    {
        try {
            $credentials = $loginRequest->only('email', 'password');

            if (Auth::attempt($credentials, $loginRequest->boolean('rememberMe'))) {
                return response()->noContent(200);
            }

            return response()->json([
                'message' => 'These credentials do not match our records.'
            ], 401);
        } catch (\Exception $exception) {
            Log::debug("[LoginController] {$exception->getMessage()}");

            abort(500);
        }
    }
}
