<?php

namespace App\Application\Controller\API;

use App\Core\Auth\AdminSignup;
use App\Core\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends APIController
{
    public function __construct(
        private AuthService $service
    ) {}

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $session = $this->service->login($username, $password);

        return [
            'token' => $session->getToken(),
            'loggedUser' => [
                'id' => $session->getLoggedUser()->getId(),
                'username' => $session->getLoggedUser()->getUsername(),
                'email' => $session->getLoggedUser()->getEmail(),
                'role' => $session->getLoggedUser()->getRole()->value,
            ]
        ];
    }

    public function systemSetup(Request $request)
    {
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        $adminSignup = new AdminSignup($email, $username, $password);

        return $this->service->setupFirstAdmin($adminSignup);
    }

    public function confirmEmail(Request $request)
    {
        $token = $request->input('token');

        $result = $this->service->confirmEmail($token);

        return ['success' => $result];
    }
}
