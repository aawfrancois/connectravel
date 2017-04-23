<?php

namespace ConnecTravel\Controller\BackEnd;

class User extends \ConnecTravel\Controller
{
    /**
     * User Login
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Psr\Http\Message\MessageInterface
     * @throws \Exception
     */
    public function login(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $email = $request->getParam('email');
        $password = $request->getParam('password');

        if ($request->isPost()) {
            try {
                if ($email === null || $password === null) {
                    throw new \InvalidArgumentException('email or password is null.');
                }

                $user = $this->getDataSource()->findOneBy(\ConnecTravel\Model\User::class, [
                    'email' => [
                        'type' => \PDO::PARAM_STR,
                        'value' => $email
                    ],
                    [
                        'password' => [
                            'type' => \PDO::PARAM_STR,
                            'value' => $password
                        ]
                    ]
                ]);

            } catch (\Exception $e) {
                $this->getFlash()->addMessage('error', 'Identifiants invalides.');

                return $response->withRedirect('/admin/user/login');
            }
        }

        return $this->getView()->render($response, 'BackEnd/Connexion/connexion.html.twig');
    }

    /**
     * User List
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Psr\Http\Message\MessageInterface
     */
    public function index(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $CompanionCollection = $this->getDataSource()->findAll('Connectravel\Model\User');

        $this->getView()->render($response, 'BackEnd/User/listuser.html.twig', ["CompanionCollection" => $CompanionCollection]);
    }

    /**
     * User Edit
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Psr\Http\Message\MessageInterface
     */
    public function edit(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'BackEnd/User/adduser.html.twig');
    }
}

