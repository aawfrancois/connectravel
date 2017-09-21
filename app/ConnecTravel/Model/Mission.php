<?php

namespace ConnecTravel\Model;

class Mission extends \Modelight\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $tableName = 'mission';

    /**
     * Primary key filed name
     *
     * @var array
     */
    protected $primaryKey = 'id';

    /**
     * Array field list
     *
     * @var array
     */
    protected $fields = [
        'id' => [
            'type' => \PDO::PARAM_INT
        ],
        'mission_number' => [
            'type' => \PDO::PARAM_INT
        ],
        'place_departure' => [
            'type' => \PDO::PARAM_STR
        ],
        'start_time' => [
            'type' => \PDO::PARAM_STR
        ],
        'place_arrival' => [
            'type' => \PDO::PARAM_STR
        ],
        'end_time' => [
            'type' => \PDO::PARAM_STR
        ],
        'time' => [
            'type' => \PDO::PARAM_STR
        ],
        'date' => [
            'type' => \PDO::PARAM_STR
        ],
        'accept' => [
            'type' => \PDO::PARAM_INT
        ],
        'salary' => [
            'type' => \PDO::PARAM_INT
        ],
        'time_off' => [
            'type' => \PDO::PARAM_INT
        ],
        'precarity' => [
            'type' => \PDO::PARAM_INT
        ],
        'commission_forfaitaire' => [
            'type' => \PDO::PARAM_INT
        ],
        'commission_pax' => [
            'type' => \PDO::PARAM_INT
        ],
        'avance' => [
            'type' => \PDO::PARAM_INT
        ],
        'taux_horaire' => [
            'type' => \PDO::PARAM_INT
        ],
        'frais_forfaitaire' => [
            'type' => \PDO::PARAM_INT
        ],
        'commission_fofaitaire_pax' => [
            'type' => \PDO::PARAM_INT
        ],
        'commission_billeterie' => [
            'type' => \PDO::PARAM_INT
        ],
        'taux_commission_pax_heure' => [
            'type' => \PDO::PARAM_INT
        ],
        'taux_tva' => [
            'type' => \PDO::PARAM_INT
        ]

    ];


    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $mission_number;

    /**
     * @var string
     */
    protected $place_departure;

    /**
     * @var string
     */
    protected $place_arrival;

    /**
     * @var string
     */
    protected $time;

    /**
     * @var string
     */
    protected $start_time;

    /**
     * @var string
     */
    protected $end_time;

    /**
     * @var string
     */
    protected $date;

    /**
     * @return int
     */
    protected $accept;

    /**
     * @return mixed
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * @param mixed $user
     * @return $this
     */
    public function setAccept(\ConnecTravel\Model\User $user)
    {
        $email = $user->getEmail();
        $this->accept = $email;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getMissionNumber()
    {
        return $this->mission_number;
    }

    /**
     * @param int $mission_number
     * @return $this
     */
    public function setMissionNumber($mission_number)
    {
        $this->mission_number = $mission_number;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceDeparture()
    {
        return $this->place_departure;
    }

    /**
     * @param string $place_departure
     * @return $this
     */
    public function setPlaceDeparture($place_departure)
    {
        $this->place_departure = $place_departure;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceArrival()
    {
        return $this->place_arrival;
    }

    /**
     * @param string $place_arrival
     * @return $this
     */
    public function setPlaceArrival($place_arrival)
    {
        $this->place_arrival = $place_arrival;

        return $this;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     * @return $this
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param string $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param string $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }


}

