<?php

namespace ConnecTravel\Model;

use ConnecTravel\Model;

class Companion extends \ConnecTravel\Model
{

    const CIVILITE_MR = 'Mr';
    const CIVILITE_MME = 'Mme';
    const CIVILITE_MLLE = 'Mlle';

    /** @var boolean Dés/Active le static storage de la classe */
    public static $useStorage = true;

    /** @var string */
    const TABLE_NAME = 'companion';

    /** @var string[] Liste des champs composants la clé primaire */
    private static $primaryKeyFieldList = array('id_companion');

    /** @var string Nom du champ d'auto increment */
    private static $autoIncrementField = 'id_companion';

    /** @var string[] Liste des champs de la table */
    private static $fieldList = array('id_utilisateur', 'firstname', 'lastname', 'birth_date', 'birth_place', 'nationality', 'adress', 'postal_code', 'city', 'email', 'phone', 'password', 'created_at', 'updated_at');

    /** @var bool[fieldName] Contient la liste des champs modifiés pour la table */
    private $dirtyBitListCompanion = array();

    /** @var int SQL int(10) unsigned */
    protected $id_companion;

    /** @var string SQL varchar(100) */
    protected $firstname;

    /** @var string SQL varchar(100) */
    protected $lastname;

    /** @var string|null SQL enum('Mr','Mme','Mlle') */
    protected $civilite;

    /** @var date SQL  */
    protected $birth_date;

    /** @var string SQL varchar(50) */
    protected $birth_place;

    /** @var string SQL varchar(100) */
    protected $nationality;

    /** @var string SQL varchar(100) */
    protected $adress;

    /** @var string SQL varchar(5) */
    protected $postal_code;

    /** @var string SQL varchar(100) */
    protected $city;

    /** @var string SQL varchar(255) */
    protected $email;

    /** @var string SQL varchar(10) */
    protected $phone;

    /** @var string SQL varchar(50) */
    protected $password;

    /** @var string*/
    protected $_clear_password;

    /** @var string SQL datetime */
    protected $created_at;

    /** @var string SQL datetime */
    protected $updated_at;


    protected static $storageByIdCompanion = array();

    protected static $tmpIdCounter = -1;

    /**
     * @param string $type
     * @return Database
     */
    public static function getDatabaseConnexion($type)
    {

    }

    /**
     * Liste des champs de la table companion
     * @return string[]
     */
    public static function getFieldList()
    {
        return self::$fieldList;
    }

    /**
     * Liste des champs composant la clé primaire de la table connect
     * @return string[]
     */
    public static function getPrimaryKeyFieldList()
    {
        return self::$primaryKeyFieldList;
    }

    /**
     * Renvoi le nom du champ en autoincrement
     * @return string
     */
    public static function getAutoIncrementField()
    {
        return self::$autoIncrementField;
    }

    /**
     * @return companion
     */
    public function __construct()
    {
        if ($this->id_companion === null) {
            $this->id_companion = self::$tmpIdCounter--;
        }
    }

    /**
     * Appelé lors de la désérialisation d'un objet Media (Session ou deserialize)
     */
    public function __wakeup()
    {
        if ($this->id_companion < 0) {
            self::$tmpIdCounter = min(self::$tmpIdCounter, $this->id);
        }
    }

    /**
     * Crypte un mot de pass via Crypt & BlowFish
     * @param string $possible liste des characteres utilisés pour générer le mot de passe
     * @return string Retourne le mot de passe crypté
     */
    public static function cryptPassword($password)
    {
        // On hash le pass avec la salt définié et on récupère la partie cryptée seulement
        // Inutil de stoquer la partie 1 de la string retournée (elle contient la salt et les détail du cryptage)
        $passfinal = substr(strrchr(crypt($password, '$2a$07$'.$_SERVER["HASH_SALT"].'$'), "$"), 1);
        return $passfinal;
    }

    //# Factories ----------------------------------------------------------#

    /**
     * Crée une instance de companion unique d'après
     * @param array $data Optionel
     * @param boolean $overWriteData Optionel. False par défaut. Si true, les champs des objets existants sont remplacés
     * @param boolean $clearDirtyBitList Optionel. Si false, ne nettoie pas les dirtyBit. Ne fais rien si l'instance existe déjà
     * @return Companion
     */
    public static function factory($data = null, $overWriteData = false, $clearDirtyBitList = true)
    {
        $companion = static::getInstance($data);
        if (!$companion || $overWriteData) {
            $companion = $companion ? $companion : new static();
            if (isset($data['id_companion'])) $companion->setIdCompanion($data['id_companion']);
            if (isset($data['firstname'])) $companion->setFirstName($data['firstname']);
            if (isset($data['lastname'])) $companion->setLastName($data['lastname']);
            if (isset($data['birth_date'])) $companion->setBirthDate($data['birth_date']);
            if (isset($data['birth_place'])) $companion->setBirthPlace($data['birth_place']);
            if (isset($data['nationality'])) $companion->setNationality($data['nationality']);
            if (isset($data['adress'])) $companion->setAdress($data['adress']);
            if (isset($data['postal_code'])) $companion->setPostalCode($data['postal_code']);
            if (isset($data['city'])) $companion->setCity($data['city']);
            if (isset($data['email'])) $companion->setEmail($data['email']);
            if (isset($data['phone'])) $companion->setPhone($data['phone']);
            if (isset($data['password'])) $companion->setPassword($data['password']);
            if (isset($data['created_at'])) $companion->setCreatedAt($data['created_at']);
            if (isset($data['updated_at'])) $companion->setUpdatedAt($data['updated_at']);

            if ($clearDirtyBitList) {
                $companion->dirtyBitListCompanion = array();
            }
        }
        return $companion;
    }

    /**
     * @param mixed|companion $companion Optionel
     * @return companion
     */
    protected static function getInstance($companion)
    {

        if (!static::$useStorage) {
            return null;
        }

        $UID = null;
        if ($companion instanceof companion) {
            $UID = $companion->getIdCompanion();
        } elseif (is_array($companion)) {
            $UID = isset($companion['id_companion']) ? $companion['id_companion'] : null;
        } elseif (!is_object($companion)) {
            $UID = $companion;
        }

        if ($UID !== null && isset(static::$storageByIdCompanion[$UID])) {
            return static::$storageByIdCompanion[$UID];
        }
        return null;

    }

    /**
     * Supprime du storage les instances connue
     */
    public static function clearStaticStorage()
    {
        static::$storageByIdCompanion = array();
    }


    //# Accessors ----------------------------------------------------------#

    /**
     * @return int id_companion
     */
    public function getIdCompanion()
    {
        return $this->id_companion;
    }

    /**
     * @return string firstname
     */
    public function getFirstName()
    {
        return $this->firstname;
    }

    /**
     * @return string lastname
     */
    public function getLastName()
    {
        return $this->lastname;
    }

    /**
     * @return date
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * @return string birth_place
     */
    public function getBirthPlace()
    {
        return $this->birth_place;
    }

    /**
     * @return string nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @return string adress
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @return string postalcode
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @return string city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string password
     */
    public function getClearPassword()
    {
        return $this->_clear_password !== null ? (string)$this->_clear_password : null;
    }

    /**
     * @return string|null civilite
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @return string created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return string updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    //# Mutators -----------------------------------------------------------#


    /**
     * Affecte le champ id
     * @param int $value
     * @return Companion
     */
    public function setIdCompanion($value)
    {
        if ($value === null) {
            throw new \UnexpectedValueException("Une clé primaire ne peut être vide");
        }
        $value = (int)$value;
        if (static::$useStorage) {
            if ($this->id_companion == $value) {
                return $this;
            }
            if (!isset(Companion::$storageByIdCompanion[$value])) {
                Companion::$storageByIdCompanion[$value] = $this;
                if ($this->id_companion > 0 && $this->id_companion != $value) {
                    unset(Companion::$storageByIdCompanion[$this->id_companion]);
                }
            } else {
                throw new \DomainException("L'objet référencé par id_companion == $value est déjà en mémoire.");
            }
        }
        if ($this->id_companion === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['id_companion'] = true;
        $this->id_companion = $value;
        return $this;
    }

    /**
     * Affecte le champ firstname
     * @param string $value
     * @return Companion
     */
    public function setFirstName($value)
    {
        $value = (int)$value;
        if ($this->firstname === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['firstname'] = true;
        $this->firstname = $value;
        return $this;
    }

    /**
     * Affecte le champ id_ref_pays
     * @param int $value
     * @return Companion
     */
    public function setLastName($value)
    {
        $value = (int)$value;
        if ($this->lastname === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['lastname'] = true;
        $this->lastname = $value;
        return $this;
    }

    /**
     * Affecte le champ critere
     * @param string|null $value
     * @return Companion
     */
    public function setBirthDate($value)
    {
        $value = ($value !== null) ? (string)$value : null;
        if ($this->birth_date === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['birth_date'] = true;
        $this->birth_date = $value;
        return $this;
    }

    /**
     * Affecte le champ birth_place
     * @param string $value
     * @return Companion
     */
    public function setBirthPlace($value)
    {
        $value = (string)$value;
        if ($this->birth_place === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['birth_place'] = true;
        $this->birth_place = $value;
        return $this;
    }

    /**
     * Affecte le champ nationality
     * @param string $value
     * @return Companion
     */
    public function setNationality($value)
    {
        $value = (string)$value;
        if ($this->nationality === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['nationality'] = true;
        $this->nationality = $value;
        return $this;
    }

    /**
     * Affecte le champ ordre
     * @param int $value
     * @return Companion
     */
    public function setAdress($value)
    {
        $value = (int)$value;
        if ($this->adress === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['adress'] = true;
        $this->adress = $value;
        return $this;
    }

    /**
     * Affecte le champ ordre
     * @param int $value
     * @return Companion
     */
    public function setPostalCode($value)
    {
        $value = (int)$value;
        if ($this->postal_code === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['ordre'] = true;
        $this->postal_code = $value;
        return $this;
    }

    /**
     * Affecte le champ ordre
     * @param int $value
     * @return Companion
     */
    public function setCity($value)
    {
        $value = (int)$value;
        if ($this->city === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['ordre'] = true;
        $this->city = $value;
        return $this;
    }

    /**
     * Affecte le champ ordre
     * @param int $value
     * @return Companion
     */
    public function setEmail($value)
    {
        $value = (int)$value;
        if ($this->email === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['email'] = true;
        $this->email = $value;
        return $this;
    }

    /**
     * Affecte le champ ordre
     * @param int $value
     * @return Companion
     */
    public function setPhone($value)
    {
        $value = (int)$value;
        if ($this->phone === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['phone'] = true;
        $this->phone = $value;
        return $this;
    }

    /**
     * Affecte le champ ordre
     * @param int $value
     * @return Companion
     */
    public function setPassword($value)
    {
        $value = (int)$value;
        if ($this->password === $value) {
            return $this;
        }
        $this->dirtyBitListCompanion['password'] = true;
        $this->password = $value;
        return $this;
    }

    /**
     * Affecte le champ clear_password
     * @param string $value
     * @return Companion
     */
    public function setClearPassword($value)
    {
        $this->_clear_password = ($value !== null) ? (string)$value : null;
        return $this;
    }

    /**
     * Affecte le champ civilite
     * @param string|null $value
     * @return Utilisateur
     */
    public function setCivilite($value)
    {
        $value = ($value !== null) ? (string)$value : null;
        if ($this->civilite === $value) {
            return $this;
        }
        $this->dirtyBitListUtilisateur['civilite'] = true;
        $this->civilite = $value;
        return $this;
    }



    /**
     * Affecte le champ ordre
     * @param @param int|SQLDate La date sous la forme d'un timestamp ou d'un datetime
     * @return Companion
     */
    public function setCreatedAt($date)
    {
        $date = Model::dateTimeSetter($date);
        if ($this->created_at === $date) {
            return $this;
        }
        $this->dirtyBitListCompanion['created_at'] = true;
        $this->created_at = $date;
        return $this;
    }


    /**
     * Affecte le champ ordre
     * @param int $value
     * @return Companion
     */
    public function setUpdatedAt($date)
    {
        $date = Model::dateTimeSetter($date);
        if ($this->updated_at === $date) {
            return $this;
        }
        $this->dirtyBitListCompanion['updated_at'] = true;
        $this->updated_at = $date;
        return $this;
    }


    //# Saving -------------------------------------------------------------#

    /**
     * Sauvegarde l'objet en base
     */
    public function save()
    {
        if ($this->getIdCompanion() < 0) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * Insère la donnée en base
     */
    public function insert()
    {

        $dsn = 'mysql:host=127.0.0.1;dbname=Connect;charset=utf8';
        $usr = 'root';
        $pwd = 'guerre1995';


        $query = Model::prepareInsertStatement('companion', self::getPrimaryKeyFieldList(), self::getFieldList());

        $database = new \PDO($dsn,$usr,$pwd);
        $stmt = $database->prepare($query);

        $stmt->bindValue(':id_companion', $this->getIdCompanion(), \PDO::PARAM_INT);
        $stmt->bindValue(':firstname', $this->getFirstName(), \PDO::PARAM_INT);
        $stmt->bindValue(':lastname', $this->getLastName(), \PDO::PARAM_STR);
        $stmt->bindValue(':birth_date', $this->getBirthDate(), \PDO::PARAM_STR);
        $stmt->bindValue(':birth_place', $this->getBirthPlace(), \PDO::PARAM_INT);
        $stmt->bindValue(':nationality', $this->getNationality(), \PDO::PARAM_INT);
        $stmt->bindValue(':adress', $this->getAdress(), \PDO::PARAM_INT);
        $stmt->bindValue(':postal_code', $this->getPostalCode(), \PDO::PARAM_INT);
        $stmt->bindValue(':city', $this->getCity(), \PDO::PARAM_INT);
        $stmt->bindValue(':email', $this->getEmail(), \PDO::PARAM_INT);
        $stmt->bindValue(':phone', $this->getPhone(), \PDO::PARAM_INT);
        $stmt->bindValue(':password', $this->getPassword(), \PDO::PARAM_INT);
        $stmt->bindValue(':created_at', $this->getCreatedAt(), \PDO::PARAM_INT);
        $stmt->bindValue(':updated_at', $this->getUpdatedAt(), \PDO::PARAM_INT);

        $stmt->execute();
        if ($stmt->rowCount()) {
            $this->id_companion = (int)$database->lastInsertId();
        }

        $this->dirtyBitListCompanion = array();

        $stmt->closeCursor();
        $stmt = null;

    }

    /**
     * Met à jour la donnée en base
     */
    public function update()
    {

        $dsn = 'mysql:host=127.0.0.1;dbname=Connect;charset=utf8';
        $usr = 'root';
        $pwd = 'guerre1995';

        $this->setCreatedAt(date('Y-m-d H:i:s'));
        $query = Model::prepareUpdateStatement('companion', self::getPrimaryKeyFieldList(), $this->dirtyBitListCompanion);
        if ($query === null) {
            return true;
        }

        $database = new \PDO($dsn,$usr,$pwd);
        $stmt = $database->prepare($query);

        $stmt->bindValue(':id_companion', $this->getIdCompanion(), \PDO::PARAM_INT);

        if (isset($this->dirtyBitListCompanion['firstname'])) {
            $stmt->bindValue(':firstname', $this->getFirstName(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['lastname'])) {
            $stmt->bindValue(':lastname', $this->getLastName(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['birth_date'])) {
            $stmt->bindValue(':birth_date', $this->getBirthDate(), \PDO::PARAM_STR);
        }
        if (isset($this->dirtyBitListCompanion['birth_place'])) {
            $stmt->bindValue(':birth_place', $this->getBirthPlace(), \PDO::PARAM_STR);
        }
        if (isset($this->dirtyBitListCompanion['nationality'])) {
            $stmt->bindValue(':nationality', $this->getNationality(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['adress'])) {
            $stmt->bindValue(':adress', $this->getAdress(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['postal_code'])) {
            $stmt->bindValue(':postal_code', $this->getPostalCode(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['city'])) {
            $stmt->bindValue(':city', $this->getCity(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['email'])) {
            $stmt->bindValue(':email', $this->getEmail(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['phone'])) {
            $stmt->bindValue(':phone', $this->getPhone(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['password'])) {
            $stmt->bindValue(':password', $this->getPassword(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['created_at'])) {
            $stmt->bindValue(':created_at', $this->getCreatedAt(), \PDO::PARAM_INT);
        }
        if (isset($this->dirtyBitListCompanion['updated_at'])) {
            $stmt->bindValue(':updated_at', $this->getUpdatedAt(), \PDO::PARAM_INT);
        }

        $stmt->execute();

        $this->dirtyBitListCompanion = array();

        $stmt->closeCursor();
        $stmt = null;

    }

    /**
     * Supprime la donnée en base
     * @param int[] $idCompanion
     */
    public function delete()
    {

        $dsn = 'mysql:host=127.0.0.1;dbname=Connect;charset=utf8';
        $usr = 'root';
        $pwd = 'guerre1995';

        $query    = "DELETE FROM companion WHERE id_companion = :id_companion";
        $database = new \PDO($dsn,$usr,$pwd);
        $stmt = $database->prepare($query);

        $stmt->bindValue(':id_companion', $this->getIdCompanion(), \PDO::PARAM_INT);

        $stmt->execute();
        $stmt->closeCursor();

        $stmt = null;
    }



    //# Loaders ------------------------------------------------------------#

    /**
     * @param int $idFreAmOe
     * @return Companion
     */
    public static function loadByIdCompanion($id_companion, $overWriteData = false)
    {
        if (!$overWriteData && static::$useStorage) {
            $companion = static::getInstance($id_companion);
            if ($companion) {
                return $companion;
            }
        }
        $CompanionCollection = CompanionCollection::loadByIdCompanion($id_companion, 1, 0, $overWriteData);
        if (!$CompanionCollection->count()) {
            return null;
        }
        return $CompanionCollection->getIterator()->current();
    }

}