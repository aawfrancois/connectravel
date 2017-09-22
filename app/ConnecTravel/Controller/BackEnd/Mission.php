<?php

namespace ConnecTravel\Controller\BackEnd;

class Mission extends \ConnecTravel\Controller
{
    /**
     * listmission page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Slim\Http\Response $response
     */
    public function index(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        {
            if (!array_key_exists('role', $_SESSION)) {

                return $response->withRedirect('/error403');

            } elseif (array_key_exists('role', $_SESSION)) {

                $MissionCollection = $this->getDataSource()->findAll(\ConnecTravel\Model\Mission::class, null, null, ['mission_number' => 'ASC']);

                $this->getView()->render($response, 'BackEnd/Mission/missionList.html.twig', [
                    "MissionCollection" => $MissionCollection,
                    "session" => $_SESSION,
                ]);
            }

        }

    }


    /**
     * addmission page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @return \Slim\Http\Response $response
     */
    public function edit(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $isNew = 1;

        if (!array_key_exists('role', $_SESSION)) {
            return $response->withRedirect('/error403');
        } elseif ($_SESSION['role'] == 'admin') {

            $data = $request->getParams();

            if (!array_key_exists('id', $data)) {
                $mission = new \ConnecTravel\Model\Mission();

                $datas = $request->getParsedBody();

                $mission->setMissionNumber($datas['mission_number']);
                $mission->setStartTime($datas['start_time']);
                $mission->setEndTime($datas['end_time']);
                $mission->setPlaceDeparture($datas['place_departure']);
                $mission->setPlaceArrival($datas['place_arrival']);
                $mission->setTime($datas['time']);
                $mission->setDate($datas['date']);

                $isNew = 1;


            } else {
                $id = $request->getParam('id');
                $mission = $this->getDataSource()->findOneBy(\ConnecTravel\Model\Mission::class, [
                    'id' => [
                        'type' => \PDO::PARAM_INT,
                        'value' => $id
                    ],
                ]);

                $isNew = 0;
            }
            if (!empty($_POST["__posted"])) {
                $mission->setData($_REQUEST);
                $this->getDataSource()->save($mission);
                return $response->withRedirect('/admin/mission');
            }

        }

        $this->getView()->render($response, 'BackEnd/Mission/missionEdit.html.twig', [
            "session" => $_SESSION,
            "mission" => $mission,
            "isNew" => $isNew,
        ]);

    }

    public function accept(\Slim\Http\Request $request, \Slim\Http\Response $response, $args)
    {
        $id = $request->getParam('id');

        /* @var \ConnecTravel\Model\Mission $mission */
        $mission = $this->getDataSource()->findOneBy(\ConnecTravel\Model\Mission::class, [
            'id' => [
                'type' => \PDO::PARAM_INT,
                'value' => $id
            ]
        ]);

        $mission->setAccept($_SESSION['email']);


        return $response->withRedirect('/admin/mission');
    }

    public function delete(\Slim\Http\Request $request, \Slim\Http\Response $response, $args)
    {
        $id = $request->getParam('id');

        $mission = $this->getDataSource()->findOneBy(\ConnecTravel\Model\Mission::class, [
            'id' => [
                'type' => \PDO::PARAM_INT,
                'value' => $id
            ],
        ]);

        $this->getDataSource()->delete($mission);

        return $response->withRedirect('/admin/mission');

    }
}
