<?php

namespace ConnecTravel;

abstract class Model
{

    /**
     * Gestion de la sauvegarde de l'objet
     */
    abstract public function save();

    /**
     * Construction de l'objet
     * @param string[] $data
     * @param boolean $overWriteData
     * @param boolean $clearDirtyBitList
     */
    public static function factory($data = null, $overWriteData = false, $clearDirtyBitList = true)
    {
        throw new \RuntimeException("Must be coded");
    }

    /**
     * Renvoi la connection à la base de donnée pour cette classe
     * @return Database
     */
    public static function getDatabaseConnexion($type)
    {
        throw new \RuntimeException("Must be coded");
    }

    /**
     * Vide les statics storages de la classe
     */
    public static function clearStaticStorage()
    {
        throw new \RuntimeException("Must be coded");
    }

    /**
     * Renvoi la liste des champs en base pour la table que représente la classe Model
     * @return string[]
     *
     * Renvoyez self::$fieldList ou défaut parent::getFieldList()
     */
    public static function getFieldList()
    {
        throw new \RuntimeException("Must be coded");
    }

    /**
     * Renvoi la liste des champs composant la PK en base pour la table que représente la classe Model
     * @return string[]
     *
     * Renvoyez self::$primaryKeyFieldList ou défaut parent::getPrimaryKeyFieldList()
     */
    public static function getPrimaryKeyFieldList()
    {
        throw new \RuntimeException("Must be coded");
    }

    /**
     * Prépare la condition WHERE
     */
    public static function prepareWhereForPrimaryKey($primaryKeyFieldList)
    {
        $whereParts = array();
        foreach ($primaryKeyFieldList as $fieldName) {
            $whereParts[] = "`" . $fieldName . "` = :" . $fieldName;
        }
        return implode(' AND ', $whereParts);
    }

    /**
     * Prépare la requête d'insert
     * @param string $tableName
     * @param string[] $primaryKeyFieldList
     * @param string $tableName
     * @param string|null $databaseName utilisé par les bdds marque blanche
     * @return string|null Null si rien a mettre à jour en BDD
     */
    public static function prepareInsertStatement($tableName, $primaryKeyFieldList, $fieldList, $databaseName = null)
    {
        if (!count($fieldList)) {
            return null;
        }
        $qry = "INSERT INTO " . ($databaseName ? "`" . $databaseName . "`." : '') . "`" . $tableName . "` SET ";
        $parts = array();
        foreach ($fieldList as $fieldName) {
            if (!in_array($fieldName, $primaryKeyFieldList)) {
                $parts[] = "`" . $fieldName . "` = :" . $fieldName;
            }
        }
        $qry .= implode(', ', $parts);
        return $qry;
    }

    /**
     * Prépare la requête d'update
     * @param string $tableName
     * @param string[] $primaryKeyFieldList
     * @param string $tableName
     * @param string|null $databaseName utilisé par les bdds marque blanche
     * @return string|null Null si rien a mettre à jour en BDD
     */
    public static function prepareUpdateStatement($tableName, $primaryKeyFieldList, $dirtyBitList, $databaseName = null)
    {
        if (!count($dirtyBitList)) {
            return null;
        }
        $qry = "UPDATE " . ($databaseName ? "`" . $databaseName . "`." : '') . "`" . $tableName . "` SET ";
        $parts = array();
        foreach ($dirtyBitList as $fieldName => $value) {
            $parts[] = "`" . $fieldName . "` = :" . $fieldName;
        }
        $qry .= implode(', ', $parts) . " WHERE " . self::prepareWhereForPrimaryKey($primaryKeyFieldList);
        return $qry;
    }

    /**
     * Prépare la requête d'insertion avec un ON DUPLICATE KEY UPDATE
     * @param string $tableName
     * @param string[] $primaryKeyFieldList
     * @param string $tableName
     * @param string|null $databaseName utilisé par les bdds marque blanche
     * @return string|null NUll si rien à insérer/MAJ en BDD
     *
     * Nous avons laissé la possibilité de spécifier le domaine de création de la requête afin de
     * permettre la création d'objet hérité/composés dont le stockage est réparti sur plusieurs tables/bdd
     */
    public static function prepareInsertUpdateStatement($tableName, $primaryKeyFieldList, $fieldList, $dirtyBitList, $databaseName = null)
    {
        if (!count($dirtyBitList)) {
            return null;
        }
        $qry = "INSERT " . ($databaseName ? "`" . $databaseName . "`." : '') . "`" . $tableName . "` SET ";
        $parts = array();
        $duplicateParts = array();
        foreach ($fieldList as $fieldName) {
            $parts[] = "`" . $fieldName . "` = :" . $fieldName;
        }
        foreach ($dirtyBitList as $fieldName => $value) {
            if (!in_array($fieldName, $primaryKeyFieldList)) {
                $duplicateParts[] = "`" . $fieldName . "` = VALUES(`" . $fieldName . "`)";
            }
        }
        $qry .= implode(', ', $parts);
        if (count($duplicateParts)) {
            $qry .= " ON DUPLICATE KEY UPDATE " . implode(', ', $duplicateParts);
        }
        return $qry;
    }


    /**
     * Renvoi la liste des propriétés exportables pour une classe
     * @param string $className
     * @return string[]
     * return : array(
     *  'bo_id' => 'getBoId',
     *  'url'   => 'getUrl'
     * );
     *
     * Définition d'ue variable exportable:
     *  Une donnée membre exportable est déclaré en tant que tel dans son bloc PHP-DOC
     * grace au mot clé @exportable(<methode>). Etant donné que la plupart des données
     * sont privées/protégées, le mot clé attend le nom de la méthode qui permet de
     * récupérer cette donnée.
     * Exemple:
     *  @var int SQL int(11) unsigned @exportable(getBoId)
     *  protected $bo_id;
     */
    public static function getExportablePropertiesList($className, $keyAsCamelCase = false)
    {

        if (!class_exists($className, false)) {
            return null;
        }

        static $exportableProperties = array();

        if (!isset($exportableProperties[$className])) {
            $propertyList = array();
            $reflection = new ReflectionClass($className);
            $properties = $reflection->getProperties();
            foreach ($properties as $property) {
                $docComment = $property->getDocComment();
                if ($pos = strpos($docComment, "@exportable")) {
                    $pos = strpos($docComment, "(", $pos);
                    $params = explode(',', substr($docComment, $pos + 1, strpos($docComment, ")", $pos) - $pos - 1));
                    $publicMethod = $params[0];
                    $propertyName = isset($params[1]) ? $params[1] : $property->getName();
                    $propertyName = $keyAsCamelCase ? String::toLowerCamelCase($propertyName) : $propertyName;
                    $propertyList[$propertyName] = $publicMethod;
                }
            }
            $exportableProperties[$className] = $propertyList;
        }

        return $exportableProperties[$className];

    }

    /**
     * @param array $fieldList (key=fieldName, value=fieldValue)
     * @param string $prefixe (nom de la table concerné auquel on ajoutera $prefixeGlue)
     * @param string $prefixeGlue Permet d'identifier les champs préfixés
     * @return array
     */
    public static function getUnprefixedFieldList(array $fieldList, $prefixe, $prefixeGlue = "_prefixed_field_")
    {
        $prefixeLength = strlen($prefixe.$prefixeGlue);
        $fieldsList = array();
        foreach ($fieldList as $fieldName => $value) {
            if (substr($fieldName, 0, $prefixeLength) == $prefixe.$prefixeGlue) {
                $fieldsList[substr($fieldName, $prefixeLength)] = $value;
            }
        }
        return $fieldsList;
    }

    /**
     * Permet d'éviter les doublons au sein d'un requête en préfixant la liste des champs transmis
     * Format : <tableAlias>.<$prefixe><fieldName>
     * @param Array $fieldList
     * @param string $tableAlias Alias de la table concernée
     * @param string $prefixe (nom de la table concerné auquel on ajoutera $prefixeGlue)
     * @param string $prefixeGlue Permet d'identifier les champs préfixés
     * @return string
     */
    public static function getPrefixedFieldList(array $fieldList, $tableAlias, $prefixe, $prefixeGlue = "_prefixed_field_")
    {
        foreach ($fieldList as $field) {
            if (!isset($fieldsQuery)) {
                $fieldsQuery = $tableAlias .'.'. $field . ' as '.$prefixe.$prefixeGlue.$field;
            } else {
                $fieldsQuery .= ', '. $tableAlias .'.'. $field . ' as '.$prefixe.$prefixeGlue.$field;
            }
        }
        return $fieldsQuery;
    }

    /**
     * Utilisé par les mutateurs des objets pour affecter un dateTime
     * @param int|string|null $date
     * @return string|null
     */
    public static function dateTimeSetter($date)
    {
        if ($date === null || $date === '') {
            return null;
        } elseif (is_numeric($date)) {
            return date('Y-m-d H:i:s', $date);
        } elseif ($date == '0000-00-00 00:00:00') {
            return null;
        } else {
            return $date;
        }
    }

    /**
     * Méthod plus rapide qu'un strtotime pour convertir une date SQL DateTime/Date en Timestamp Unix
     * @param string $sqlDate
     * @return int Timestamp UNIX
     */
    public static function sqlDateToTS($sqlDate)
    {
        if ($sqlDate === null || substr($sqlDate, 0, 5) == "0000-") {
            return null;
        }
        list($Y, $M, $d, $H, $i, $s) = preg_split('/[-\:\/ ]/', $sqlDate);
        return mktime($H, $i, $s, $M, $d, $Y);
    }

    /**
     * Vide TOUS les static storages
     */
    public static function clearAllStaticStorage()
    {
        $classList = get_declared_classes();
        foreach ($classList as $class) {
            if (!in_array($class, array('Model', 'ModelExpo')) && method_exists($class, 'clearStaticStorage')) {
                call_user_func($class . '::clearStaticStorage');
            }
        }
    }
}