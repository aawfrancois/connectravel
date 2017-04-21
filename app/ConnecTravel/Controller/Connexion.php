<?php

namespace ConnecTravel\Controller;


class Connexion extends \ConnecTravel\Controller
{
    /**
     * Connexion page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Slim\Http\Response
     * @throws \Exception
     */
    public function connexion(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {


        if ($request->isPost()) {
            $email = $request->getParam('email');
            $password = $request->getParam('password');


            try {
                if ($email === null || $password === null) {
                }
                    throw new \InvalidArgumentException('email or password is null.');
            } catch (\Exception $e) {
                $this->getFlash()->addMessage('error', 'Identifiants invalides.');

                return $response->withRedirect('/connexion');
            }
        }

        $this->getView()->render($response, 'pages/connexion.html.twig');
    }
}
