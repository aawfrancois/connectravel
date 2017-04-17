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
        'place_arrival' => [
            'type' => \PDO::PARAM_STR
        ],
        'time' => [
            'type' => \PDO::PARAM_STR
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

}

