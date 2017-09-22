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
        'commission_forfaitaire_pax' => [
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
     * @return string
     */
    protected $accept;

    /**
     * @var int
     */
    protected $salary;

    /**
     * @var int
     */
    protected $time_off;

    /**
     * @var int
     */
    protected $precarity;

    /**
     * @var int
     */
    protected $commission_forfaitaire;

    /**
     * @var int
     */
    protected $commission_pax;

    /**
     * @var int
     */
    protected $avance;

    /**
     * @var int
     */
    protected $taux_horaire;

    /**
     * @var int
     */
    protected $frais_forfaitaire;

    /**
     * @var int
     */
    protected $commission_forfaitaire_pax;

    /**
     * @var int
     */
    protected $commission_billeterie;

    /**
     * @var int
     */
    protected $taux_commission_pax_heure;

    /**
     * @var int
     */
    protected $taux_tva;



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

    /**
     * @return mixed
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * @param $accept
     * @return $this
     */
    public function setAccept ($accept)
    {
        $this->accept = $accept;

        return $this;
    }

    /**
     * @return int
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param int $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return int
     */
    public function getTimeOff()
    {
        return $this->time_off;
    }

    /**
     * @param int $time_off
     */
    public function setTimeOff($time_off)
    {
        $this->time_off = $time_off;
    }

    /**
     * @return int
     */
    public function getPrecarity()
    {
        return $this->precarity;
    }

    /**
     * @param int $precarity
     */
    public function setPrecarity($precarity)
    {
        $this->precarity = $precarity;
    }

    /**
     * @return int
     */
    public function getCommissionForfaitaire()
    {
        return $this->commission_forfaitaire;
    }

    /**
     * @param int $commission_forfaitaire
     */
    public function setCommissionForfaitaire($commission_forfaitaire)
    {
        $this->commission_forfaitaire = $commission_forfaitaire;
    }

    /**
     * @return int
     */
    public function getCommissionPax()
    {
        return $this->commission_pax;
    }

    /**
     * @param int $commission_pax
     */
    public function setCommissionPax($commission_pax)
    {
        $this->commission_pax = $commission_pax;
    }

    /**
     * @return int
     */
    public function getAvance()
    {
        return $this->avance;
    }

    /**
     * @param int $avance
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;
    }

    /**
     * @return int
     */
    public function getTauxHoraire()
    {
        return $this->taux_horaire;
    }

    /**
     * @param int $taux_horaire
     */
    public function setTauxHoraire($taux_horaire)
    {
        $this->taux_horaire = $taux_horaire;
    }

    /**
     * @return int
     */
    public function getFraisForfaitaire()
    {
        return $this->frais_forfaitaire;
    }

    /**
     * @param int $frais_forfaitaire
     */
    public function setFraisForfaitaire($frais_forfaitaire)
    {
        $this->frais_forfaitaire = $frais_forfaitaire;
    }

    /**
     * @return int
     */
    public function getCommissionForfaitairePax()
    {
        return $this->commission_forfaitaire_pax;
    }

    /**
     * @param int $commission_forfaitaire_pax
     */
    public function setCommissionForfaitairePax($commission_forfaitaire_pax)
    {
        $this->commission_forfaitaire_pax = $commission_forfaitaire_pax;
    }

    /**
     * @return int
     */
    public function getCommissionBilleterie()
    {
        return $this->commission_billeterie;
    }

    /**
     * @param int $commission_billeterie
     */
    public function setCommissionBilleterie($commission_billeterie)
    {
        $this->commission_billeterie = $commission_billeterie;
    }

    /**
     * @return int
     */
    public function getTauxCommissionPaxHeure()
    {
        return $this->taux_commission_pax_heure;
    }

    /**
     * @param int $taux_commission_pax_heure
     */
    public function setTauxCommissionPaxHeure($taux_commission_pax_heure)
    {
        $this->taux_commission_pax_heure = $taux_commission_pax_heure;
    }

    /**
     * @return int
     */
    public function getTauxTva()
    {
        return $this->taux_tva;
    }

    /**
     * @param int $taux_tva
     */
    public function setTauxTva($taux_tva)
    {
        $this->taux_tva = $taux_tva;
    }




}

