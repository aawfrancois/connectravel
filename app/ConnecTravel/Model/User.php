<?php

namespace ConnecTravel\Model;

class User extends \Modelight\Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_COMPANION = 'companion';


    const CIVILITE_MR = 'Mr';
    const CIVILITE_MME = 'Mme';

    /**
     * Table name
     *
     * @var string
     */
    protected $tableName = 'user';

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
        'role' => [
            'type' => \PDO::PARAM_STR
        ],
        'civility' => [
            'type' => \PDO::PARAM_STR
        ],
        'firstname' => [
            'type' => \PDO::PARAM_STR
        ],
        'lastname' => [
            'type' => \PDO::PARAM_STR
        ],
        'birth_date' => [
            'type' => \PDO::PARAM_STR
        ],
        'birth_place' => [
            'type' => \PDO::PARAM_STR
        ],
        'nationality' => [
            'type' => \PDO::PARAM_STR
        ],
        'adress' => [
            'type' => \PDO::PARAM_STR
        ],
        'postal_code' => [
            'type' => \PDO::PARAM_STR
        ],
        'city' => [
            'type' => \PDO::PARAM_STR
        ],
        'phone' => [
            'type' => \PDO::PARAM_STR
        ],
        'email' => [
            'type' => \PDO::PARAM_STR
        ],
        'password' => [
            'type' => \PDO::PARAM_STR
        ],
        'created_at' => [
            'type' => \PDO::PARAM_STR
        ],
        'updated_at' => [
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
    protected $role;

    /**
     * @var string
     */
    protected $civility;

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
     * @var string
     */
    protected $birth_place;

    /**
     * @var string
     */
    protected $nationality;

    /**
     * @var string
     */
    protected $adress;

    /**
     * @var string
     */
    protected $postal_code;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @var string
     */
    protected $updated_at;

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
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * @param null|string $civility
     * @return $this
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

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
     * @return String
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * @param String $birth_date
     * @return $this
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthPlace()
    {
        return $this->birth_place;
    }

    /**
     * @param string $birth_place
     * @return $this
     */
    public function setBirthPlace($birth_place)
    {
        $this->birth_place = $birth_place;

        return $this;
    }

    /**
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     * @return $this
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param string $adress
     * @return $this
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @param string $postal_code
     * @return $this
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
