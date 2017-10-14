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

        if ($request->isPost()) {
            $email = $request->getParam('email');
            $password = $request->getParam('password');


            try {
                if ($email === null || $password === null) {
                    throw new \InvalidArgumentException('email or password is null.');
                }

                /** @var \ConnecTravel\Model\User $user */
                $user = $this->getDataSource()->findOneBy(\ConnecTravel\Model\User::class, [
                    'email' => [
                        'type' => \PDO::PARAM_STR,
                        'value' => $email
                    ],
                    'password' => [
                        'type' => \PDO::PARAM_STR,
                        'value' => md5($password)
                    ]
                ]);

                $_SESSION['email'] = $user->getEmail();
                $_SESSION['role'] = $user->getRole();
                $_SESSION['id'] = $user->getId();
                //$_SESSION['actif'] = $user->getActif();


                $twig = $this->getView()->getEnvironment();
                $twig->addGlobal("session", $_SESSION);

                $this->getFlash()->addMessage('error', 'Bonjour ' . $user->getFirstname() . ' :)');

                return $response->withRedirect('/admin/user/login');
                // return $response->withRedirect('/admin/user/list');
            } catch (\InvalidArgumentException $e) {
                $this->getFlash()->addMessage('error', 'Identifiants invalides.');

                return $response->withRedirect('/admin/user/login');
            }
        }

        return $this->getView()->render($response, 'BackEnd/Connexion/connexion.html.twig', [
            "session" => $_SESSION
        ]);
    }

    public function passwordLost()
    {

//        // Create the Transport
//        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
//            ->setUsername('antoinefrancois95@gmail.com')
//            ->setPassword('jkl007jkl007');
//
//        // Create the Mailer using your created Transport
//        $mailer = \Swift_Mailer::newInstance($transport);
//
//        $message = \Swift_Message::newInstance('toto')
//            ->setFrom(array('antoinefrancois95@gmail.com' => 'antoine'))
//            ->setTo(array('antoinefrancois95@gmail.com'))
//            ->setBody('test', 'text/html');
//
//        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
//            ->setUsername('antoinefrancois95@gmail.com')
//            ->setPassword('jkl007jkl007')
//            ;
//
//        $mailer = \Swift_Mailer::newInstance($transport);
//
//        $message = (new \Swift_Message('toto'))
//                    ->setFrom(['antoinefrancois95@gmail.com' => 'antoine'])
//                    ->setTo(['antoinefrancois95@gmail.com' => 'francois'])
//                    ->setBody('Here is the message itself')
//            ;
//
//        $result = $mailer->send($message);
    }


    public function logout(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->passwordLost();
        $_SESSION = array();
        session_destroy();
        return $response->withRedirect('/');
    }

    public function subscription(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        if ($request->isPost()) {
            $datas = $request->getParsedBody();
            $email = $datas['email'];
            $password = $datas['password'];
            $password_confirm = $datas['password-confirm'];

            if ($password === $password_confirm) {

                try {

                    /** @var \ConnecTravel\Model\User $user */
                    $user = new \ConnecTravel\Model\User();

                    if (!empty($_POST["__posted"])) {
                        $user->setEmail($email);
                        $user->setPassword(md5($password));
                        $user->setRole('companion');
                        $user->setActif('inactif');

                        $newUser = $this->getDataSource()->fetch('SELECT * FROM user WHERE email = :email', [
                            'email' => [
                                'value' => $email,
                                'type' => \PDO::PARAM_INT
                            ]
                        ]);
                    }
                    if (empty($newUser)){
                        $this->getDataSource()->insert($user);
                        return $response->withRedirect('/admin/user/login');
                    }
                    dump($newUser);
                    return $response->withRedirect('/admin/user/subscription');

                } catch (\InvalidArgumentException $e) {

                    $this->getFlash()->addMessageNow('error', 'Identifiants invalides.');
                    return $response->withRedirect('/admin/user/login');
                }
            }
            $this->getFlash()->addMessage('error', 'Les champs mot de passe et confirmation ne sont pas identiques.');
            $response->withRedirect('/');
        }


        return $this->getView()->render($response, 'BackEnd/Registration/inscription.html.twig');
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
        if (!array_key_exists('role', $_SESSION)) {

            return $response->withRedirect('/error403');

        } elseif ($_SESSION['role'] == 'admin') {

            $CompanionCollection = $this->getDataSource()->findAll(\ConnecTravel\Model\User::class);

            $this->getView()->render($response, 'BackEnd/User/userList.html.twig', [
                "CompanionCollection" => $CompanionCollection,
                "session" => $_SESSION
            ]);

        } else {
            return $response->withRedirect('/error403');
        }
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
        $isNew = 1;

        if (!array_key_exists('role', $_SESSION)) {
            return $response->withRedirect('/error403');
        } elseif ($_SESSION['role'] == 'admin') {

            $data = $request->getParams();

            if (!array_key_exists('id', $data)) {
                $user = new \ConnecTravel\Model\User();

                $datas = $request->getParsedBody();

                $user->setFirstname($datas['firstname']);
                $user->setLastname($datas['lastname']);
                $user->setBirthDate($datas['birth_date']);
                $user->setBirthPlace($datas['birth_place']);
                $user->setNationality($datas['nationality']);
                $user->setAdress($datas['adress']);
                $user->setPostalCode($datas['postal_code']);
                $user->setCity($datas['city']);
                $user->setPhone($datas['phone']);
                $user->setEmail($datas['email']);
                $user->setPassword($datas['password']);


                $isNew = 1;

            } else {
                $id = $request->getParam('id');
                $user = $this->getDataSource()->findOneBy(\ConnecTravel\Model\User::class, [
                    'id' => [
                        'type' => \PDO::PARAM_INT,
                        'value' => $id
                    ],
                ]);

                $isNew = 0;
            }
            if (!empty($_POST["__posted"])) {
                $user->setData($_REQUEST);
                $this->getDataSource()->save($user);
                return $response->withRedirect('/admin/user');
            }
        }

        $this->getView()->render($response, 'BackEnd/User/userEdit.html.twig', [
            "session" => $_SESSION,
            "user" => $user,
            "isNew" => $isNew,
        ]);
    }

    public function delete(\Slim\Http\Request $request, \Slim\Http\Response $response, $args)
    {
        $id = $request->getParam('id');

        $user = $this->getDataSource()->findOneBy(\ConnecTravel\Model\User::class, [
            'id' => [
                'type' => \PDO::PARAM_INT,
                'value' => $id
            ],
        ]);

        $this->getDataSource()->delete($user);

        return $response->withRedirect('/admin/user');

    }

    public function activeUser(\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
        $id = $request->getParam('id');

        /* @var \ConnecTravel\Model\User $user */
        $user = $this->getDataSource()->findOneBy(\ConnecTravel\Model\User::class, [
            'id' => [
                'type' => \PDO::PARAM_INT,
                'value' => $id
            ],
        ]);


        if ($user->getActif() === 'actif') {
            $user->setActif('inactif');
        } elseif ($user->getActif() ==='inactif') {
            $user->setActif('actif');
        }

        $this->getView()->render($response, 'BackEnd/User/userList.html.twig', [
            //
        ]);


        $this->getDataSource()->update($user);

        return $response->withRedirect('/admin/user');
    }
}

