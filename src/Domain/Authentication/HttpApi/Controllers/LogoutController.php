<?php

namespace Domain\Authentication\HttpApi\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    /**
     * Logout authenticated user
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        Auth::guard('web')->logout();
        return response()->noContent(200);
    }
}
