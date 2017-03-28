<?php

namespace ConnecTravel\Model;

use Slim\Collection;

class CompanionCollection extends Collection
{

    /**
     * Appends the value
     * @link http://php.net/manual/en/arrayobject.append.php
     * @param mixed $value <p>
     * The value being appended.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function append($value) { }

    protected static $objectClassName = "Companion";

    /**
     * @return Database
     */
    public static function getDatabaseConnexion($type)
    {
        $objectClassName = self::$objectClassName;
        return $objectClassName::getDatabaseConnexion($type);
    }


    /** Contient la liste des Utilisateur triés par la clé primaire id_utilisateur */
    protected $storageByIdUtilisateur = array();

    /**
     * @param Companion[] $array
     */
    public function __construct($array = null)
    {
        parent::__construct();
        if (is_array($array)) {
            foreach ($array as $value) {
                $this->append($value);
            }
        }
    }

    /**
     * Définit une valeur dans la collection
     * @param mixed $index
     * @param Utilisateur $utilisateur
     */
    public function offsetSet($index, $utilisateur)
    {
        if (!$utilisateur instanceof Utilisateur) {
            throw new UnexpectedValueException("Un objet Utilisateur était attendu en paramètre.");
        }

        $this->storageByIdUtilisateur[$utilisateur->getIdUtilisateur()] = $utilisateur;

        parent::offsetSet($index, $utilisateur);
    }

    //# Sort methods -------------------------------------------------------#


    /**
     * Tri la collection par id_utilisateur
     * @param bool $desc True: tri croissant. False: tri décroissant.
     * @return CompanionCollection
     */
    public function sortByIdCompanion($desc = true)
    {
        $array = $this->getArrayCopy();
        if ($desc) {
            usort($array, array($this, '__compareByIdUtilisateur'));
        } else {
            usort($array, array($this, '__compareByIdUtilisateurReverse'));
        }
        $this->exchangeArray($array);
        return $this;
    }
    private function __compareByIdUtilisateur($a, $b)
    {
        if ($a->getIdUtilisateur() == $b->getIdUtilisateur()) {
            return 0;
        }
        return ($a->getIdUtilisateur() > $b->getIdUtilisateur()) ? -1 : 1;
    }
    private function __compareByIdUtilisateurReverse($a, $b)
    {
        if ($a->getIdUtilisateur() == $b->getIdUtilisateur()) {
            return 0;
        }
        return ($a->getIdUtilisateur() < $b->getIdUtilisateur()) ? -1 : 1;
    }

    //# List methods -------------------------------------------------------#


    /**
     * Renvoi la liste des id_utilisateur
     * @return int[]
     */
    public function getIdUtilisateurList()
    {
        return array_keys($this->storageByIdUtilisateur);
    }


    //# Filter methods -----------------------------------------------------#

    /**
     * Renvoi l'instance Utilisateur stockée
     * @param int $idUtilisateur
     * @return Companion Null si idUtilisateur n'est pas dans la collection
     */
    public function getByIdUtilisateur($idUtilisateur)
    {
        return isset($this->storageByIdUtilisateur[$idUtilisateur]) ? $this->storageByIdUtilisateur[$idUtilisateur] : null;
    }

    /**
     * Filtre la collection par $idUtilisateur
     * @param int|int[] $idUtilisateur Liste de filtrage
     * @param int       $method INCLUDE_FILTER | EXCLUDE_FILTER
     * @return CompanionCollection
     */
    public function filterByIdUtilisateur($idUtilisateur, $method = INCLUDE_FILTER)
    {
        $newList = array();
        if ($method === INCLUDE_FILTER) {
            $newList = array_intersect_key($this->storageByIdUtilisateur, array_fill_keys((array)$idUtilisateur, false));
        } elseif ($method === EXCLUDE_FILTER) {
            $newList = array_diff_key($this->storageByIdUtilisateur, array_fill_keys((array)$idUtilisateur, false));
        }
        return new static($newList);
    }


    //# Saving -------------------------------------------------------------#

    /**
     * Sauvegarde la collection de Utilisateur en base
     */
    public function save()
    {
        foreach ($this as $object) {
            $object->save();
        }
    }

    //# Loaders ------------------------------------------------------------#

    /**
     * @param \PDOStatement $stmt
     * @param boolean $overWriteData Optionel. False par défaut. Si true, les champs des objets existants sont remplacés
     * @return CompanionCollection
     */
    public static function factoryFromPDOStatement(\PDOStatement $stmt, $overWriteData = false)
    {

        $utilisateurCollection = new static();
        $stmt->execute();
        if (strpos($stmt->queryString, 'SQL_CALC_FOUND_ROWS') !== false) {
            $utilisateurCollection->found = $stmt->getFoundRows();
        }
        $className = static::$objectClassName;
        $utilisateurCollection->start = $stmt->getBindedValue(':_limit_offset');
        $utilisateurCollection->rows  = $stmt->getBindedValue(':_limit_row_count');
        while ($utilisateur = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $utilisateur = $className::factory($utilisateur, $overWriteData);
            $utilisateurCollection->append($utilisateur);
        }
        $stmt->closeCursor();
        $stmt = null;
        return $utilisateurCollection;

    }

    /**
     * @param int|int[] $idCompanion
     * @param boolean $overWriteData Optionel. False par défaut. Si true, les champs des objets existants sont remplacés
     * @return CompanionCollection
     */
    public static function loadByIdCompanion($idCompanion, $rowCount = null, $offset = 0, $overWriteData = false)
    {

        $dsn = 'mysql:host=127.0.0.1;dbname=Connect;charset=utf8';
        $usr = 'root';
        $pwd = 'guerre1995';

        $idCompanion = \Database::cleanIdList((array)$idCompanion);
        if (!count($idCompanion)) {
            return new static();
        }

        $query = "
            SELECT *
            FROM `companion`
			WHERE `id_companion` IN (" . implode(', ', $idCompanion) . ")
		";
        if ((int)$rowCount > 0) {
            $query .= " LIMIT :_limit_offset, :_limit_row_count";
        }

        $database = new \PDO($dsn,$usr,$pwd);
        $stmt = $database->prepare($query);
        if ((int)$rowCount > 0) {
            $stmt->bindValue(':_limit_offset', (int)$offset, PDO::PARAM_INT);
            $stmt->bindValue(':_limit_row_count', (int)$rowCount, PDO::PARAM_INT);
        }
        return static::factoryFromPDOStatement($stmt, $overWriteData);

    }

    /**
     * Test l'identification d'un utilisateur Back office
     * @param string $email
     * @param string $password
     * @param boolean $overWriteData Optionel. False par défaut. Si true, les champs des objets existants sont remplacés
     * @return CompanionCollection
     */
    public static function loadByEmailAndPassword($email, $password, $rowCount = null, $offset = 0, $overWriteData = false)
    {
        $dsn = 'mysql:host=127.0.0.1;dbname=Connect;charset=utf8';
        $usr = 'root';
        $pwd = 'guerre1995';

        $passwordCrypte = Companion::cryptPassword($password);

        $query = "  SELECT *
					FROM ". Dispatch::getReseau('read') . ".utilisateur
                    WHERE email = :email
					AND password = :password";
        if ((int)$rowCount > 0) {
            $query .= " LIMIT :_limit_offset, :_limit_row_count";
        }

        $database = new \PDO($dsn,$usr,$pwd);
        $stmt = $database->prepare($query);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $passwordCrypte, PDO::PARAM_STR);
        if ((int)$rowCount > 0) {
            $stmt->bindValue(':_limit_offset', (int)$offset, PDO::PARAM_INT);
            $stmt->bindValue(':_limit_row_count', (int)$rowCount, PDO::PARAM_INT);
        }
        return static::factoryFromPDOStatement($stmt, $overWriteData);
    }

    /**
     * @param string $email
     * @param boolean $overWriteData Optionel. False par défaut. Si true, les champs des objets existants sont remplacés
     * @return CompanionCollection
     */


    /**
     * @param boolean $calcFoundRows Calcul le nombre d'enregistrement total (Pour la pagination)
     * @param boolean $overWriteData Optionel. False par défaut. Si true, les champs des objets existants sont remplacés
     * @return CompanionCollection
     * Le résultat est mis en cache. Un nouvel appel avec $overWriteData à false rénverra le dernier résultat.
     */
    public static function loadAll($rowCount = null, $offset = 0, $calcFoundRows = false, $overWriteData = false)
    {
        $dsn = 'mysql:host=127.0.0.1;dbname=Connect;charset=utf8';
        $usr = 'root';
        $pwd = 'guerre1995';

        $calcFoundRows = $calcFoundRows ? "SQL_CALC_FOUND_ROWS" : "";
        $query = "
            SELECT $calcFoundRows *
            FROM `companion`
		";
        if ((int)$rowCount > 0) {
            $query .= " LIMIT :_limit_offset, :_limit_row_count";
        }

        $database = new \PDO($dsn,$usr,$pwd);
        $stmt = $database->prepare($query);
        if ((int)$rowCount > 0) {
            $stmt->bindValue(':_limit_offset', (int)$offset, \PDO::PARAM_INT);
            $stmt->bindValue(':_limit_row_count', (int)$rowCount, \PDO::PARAM_INT);
        }
        return static::factoryFromPDOStatement($stmt, $overWriteData);
    }
}