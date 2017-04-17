<?php

namespace ConnecTravel\Model;

class Child extends \Modelight\Model
{

    /**
     * Table name
     *
     * @var string
     */
    protected $tableName = 'child';

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
        'firstname' => [
            'type' => \PDO::PARAM_STR
        ],
        'lastname' => [
            'type' => \PDO::PARAM_STR
        ],
        'birth_date' => [
            'type' => \PDO::PARAM_STR
        ]


    ];


    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $birth_date;

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
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * @param string $birth_date
     * @return $this
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;

        return $this;
    }


}
