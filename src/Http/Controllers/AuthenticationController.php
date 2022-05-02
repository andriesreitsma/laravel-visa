<?php

namespace AndriesReitsma\Visa\Http\Controllers;

use AndriesReitsma\Visa\Http\Requests\LoginRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\ApiTokenCookieFactory;

class AuthenticationController extends Controller
{

    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param LoginRequest $request
     * @return Response
     * @throws BindingResolutionException
     * @throws ValidationException
     */
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent()->withCookie(
            app()->make(ApiTokenCookieFactory::class)->make(
                $request->user('web')->getAuthIdentifier(),
                $request->session()->token()
            ));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }

}
