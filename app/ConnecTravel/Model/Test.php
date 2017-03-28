<?php
/**
 * Created by PhpStorm.
 * User: antoinefrancois
 * Date: 26/03/2017
 * Time: 17:54
 */

namespace ConnecTravel\Model;


class Test
{
    /**
     * @var int
     */
    protected $idTest = null;

    /**
     * @return int
     */
    public function getIdTest()
    {
        return $this->idTest;
    }

    /**
     * @param int $idTest
     */
    public function setIdTest($idTest)
    {
        $this->idTest = $idTest;
    }
}
