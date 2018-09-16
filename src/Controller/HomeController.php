<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'user' => $this->getMockUser(),
        ]);
    }

    /**
     * @Route("/auth/request", name="auth_request")
     */
    public function authRequest()
    {
        $redirectUri = $this->generateUrl('auth_callback', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $clientId = 'Crear una Oauth App en Github y poner aquí el CLIENT_ID';

        return $this->redirect(
            "https://github.com/login/oauth/authorize?client_id=$clientId&state=1234&redirect_uri=$redirectUri",
            301
        );
    }

    /**
     * @Route("/auth/callback", name="auth_callback")
     * @param Request $request
     * @return string
     */
    public function authCallback(Request $request)
    {
        $code = $request->query->get('code');
        $state = $request->query->get('state');

        return new Response("Code is $code and State is $state");
    }


    private function getMockUser()
    {
        return [
            'login' => 'mock_user',
        ];
    }
}
