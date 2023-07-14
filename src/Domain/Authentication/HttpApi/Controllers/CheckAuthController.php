<?php

namespace Domain\Authentication\HttpApi\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CheckAuthController extends Controller
{
    /**
     * Check if user is authenticated
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        if (Auth::check()) {
            return response()->noContent(200);
        }

        return response()->noContent(401);
    }
}
