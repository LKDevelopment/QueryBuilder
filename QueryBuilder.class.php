<?php
/* 
 * The MIT License
 *
 * Copyright 2014 Lukas Kämmerling.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */


/**
 * Dieser Klasse ermöglicht einfache Erstellung von Querys.
 * 
 * @package    lkdevelopment
 * @subpackage  QueryBuilder
 * @author     Lukas Kämmerling (18.12.2014)
 * @version    1.0.0
 */

namespace lkdevelopment;

//BSP:
//    $queryBuilderSELECT = new \simk\Framework\datenbank\QueryBuilder();
//$queryBuilderSELECT->select("bestellungID","bestellungDatum")->from("bestellungen","b")->where("b.bestellungID = :bid")->groupBy("b.bestellDatum")->limit(1,3);
//
//$queryBuilderInsert = new \simk\Framework\datenbank\QueryBuilder();
//$queryBuilderInsert->insertInto("bestellung_status", array("bestellung_id" => ":bestellungid", "rueckgabe" => ":rueckgabe"));
//
//$queryBuilderUpdate = new \simk\Framework\datenbank\QueryBuilder();
//$queryBuilderUpdate->update("bestellungen", array("bestellungDatum" => ":bDatum"))->where("bestellungID = :bid");
//
//$queryBuilderDelete = new \simk\Framework\datenbank\QueryBuilder();
//$queryBuilderDelete->deleteFrom("bestellungen")->where("bestellungDatem > :bDatum")->limit(2);
//
//$queryBuilderFree = new \simk\Framework\datenbank\QueryBuilder();
//$queryBuilderFree->query("TRUNCATE `bestellungen`");

class QueryBuilder {

    /**
     * Beinhaltet den Query
     * @var string
     */
    private $query;

    /**
     * Setzt den Query auf null
     */
    public function __construct() {
        $this->query = '';
    }

    /**
     * 
     * @return string
     */
    public function __toString() {
        return $this->query;
    }

    /*     * ************************** SELECT ********************************* */

    /**
     * Fängt den Bau einer SELECT abfrage an
     * @param array $felder 
     * @return lkdevelopment\QueryBuilder
     * @throws lkdevelopment\DatenbankException
     */
    public function select() {
        $this->query("SELECT ");
        if (empty(func_get_args())) {
            $this->addToQuery("*");
        } else {
            $this->addToQuery(implode(",", func_get_args()));
        }
        return $this;
    }

    /**
     * Fügt dem Query ein FROM Attribut hinzu
     * @param type $table
     * @param type $alias
     * @return \simk\Framework\datenbank\QueryBuilder
     */
    public function from($table, $alias = null) {
        if ($alias == null) {
            $alias = $table;
        }
        $this->addToQuery(" FROM `$table` as $alias");
        return $this;
    }

    /**
     * Fügt dem Query eine WHERE Bedingung hinzu
     * @param string $bedingung
     */
    public function where($bedingung) {
        $this->addToQuery(" WHERE $bedingung");
        return $this;
    }
    /**
     * Fügt dem Query eine WHERE Bedingung hinzu
     * @param string $bedingung
     */
    public function andWhere($bedingung) {
        $this->addToQuery(" AND $bedingung");
        return $this;
    }
     /**
     * Fügt dem Query eine WHERE Bedingung hinzu
     * @param string $bedingung
     */
    public function orWhere($bedingung) {
        $this->addToQuery(" OR $bedingung");
        return $this;
    }
    /**
     * Führt einen INNER JOIN aus
     * @param string $table
     * @param string $alias
     * @param string $bedingung
     * @return lkdevelopment\QueryBuilder
     */
    public function innerJoin($table, $alias, $bedingung) {
        $this->join("INNER", $table, $alias, $bedingung);
        return $this;
    }

    /**
     * Führt einen LEFT JOIN aus
     * @param string $table
     * @param string $alias
     * @param string $bedingung
     * @return lkdevelopment\QueryBuilder
     */
    public function leftJoin($table, $alias, $bedingung) {
        $this->join("LEFT", $table, $alias, $bedingung);
        return $this;
    }

    /**
     * Führt einen RIGHT JOIN aus
     * @param string $table
     * @param string $alias
     * @param string $bedingung
     * @return lkdevelopment\QueryBuilder
     */
    public function rightJoin($table, $alias, $bedingung) {
        $this->join("RIGHT", $table, $alias, $bedingung);
        return $this;
    }

    /**
     * Führt einen JOIN unabhänig vom Typ aus
     * @param string $typ
     * @param string $table
     * @param string $alias
     * @param string $bedingung
     * @return lkdevelopment\QueryBuilder
     */
    private function join($typ, $table, $alias, $bedingung) {
        $this->addToQuery(" $typ JOIN `$table` as $alias ON $bedingung ");
        return $this;
    }
    /**
     * Fügt dem Query ein BETWEEN hinzu
     * @param string $wert1
     * @param string $wert2
     * @return lkdevelopment\QueryBuilder
     */
    public function between($wert1,$wert2){
        $this->addToQuery(" BETWEEN $wert1 AND $wert2");
        return $this;
    }
    /**
     * Fügt dem Query ein LIMIT hinzu
     * @param int $minOffset
     * @param int $maxOffset
     */
    public function limit($minOffset, $maxOffset = 0) {
        if ($maxOffset != 0) {
            $this->addToQuery(" LIMIT $minOffset,$maxOffset");
        } else {
            $this->addToQuery(" LIMIT $minOffset");
        }
        return $this;
    }

    /**
     * Fügt dem Query ein GROUP BY hinzu
     * @param string $bedingung
     * @return lkdevelopment\QueryBuilder
     */
    public function groupBy($bedingung) {
        $this->addToQuery(" GROUP BY $bedingung");
        return $this;
    }
    /**
     * Fügt dem Query ein GROUP BY hinzu
     * @param string $bedingung
     * @return lkdevelopment\QueryBuilder
     */
    public function addGroupBy($bedingung) {
        $this->addToQuery(" , $bedingung");
        return $this;
    }

    /**
     * Fügt dem Query ein ORDER BY hinzu
     * @param string $bedingung
     * @return lkdevelopment\QueryBuilder
     */
    public function orderBy($spalte,$modus = "DESC") {
        $this->addToQuery(" ORDER BY $spalte $modus");
        return $this;
    }
    /**
     * Fügt dem Query ein ORDER BY hinzu
     * @param string $bedingung
     * @return lkdevelopment\QueryBuilder
     */
    public function addOrderBy($spalte,$modus = "DESC") {
        $this->addToQuery(",$spalte $modus");
        return $this;
    }
    /**
     * Erstellt einen INSERT INTO Query
     * @param string $table
     * @param array $values
     * @return lkdevelopment\QueryBuilder
     */
    public function insertInto($table, array $values) {
        $this->query("INSERT INTO `$table` SET ");
        $i = 0;
        foreach ($values as $spalte => $value) {
            if ($value == '') {
                unset($values[$spalte]);
            } else {
                if ($i == 0) {
                    $this->addToQuery("`$spalte` = '$value'");
                } else {
                    $this->addToQuery(",`$spalte` = '$value'");
                }
                $i++;
            }
        }
        return $this;
    }

    /**
     * Erstellt einen UPDATE Query
     * @param string $table
     * @param array $values
     * @return lkdevelopment\QueryBuilder
     */
    public function update($table, array $values) {
        $this->query("UPDATE `$table` SET ");
        $i = 0;
        foreach ($values as $spalte => $value) {
            if ($value == '') {
                unset($values[$spalte]);
            } else {
                if ($i == 0) {
                    $this->addToQuery("`$spalte` = $value");
                } else {
                    $this->addToQuery(",`$spalte` = $value");
                }
            }
            $i++;
        }
        return $this;
    }

    /**
     * Erstellt einen DELETE Query
     * @param string $table
     * @return lkdevelopment\QueryBuilder
     */
    public function deleteFrom($table) {
        $this->query("DELETE FROM `$table`");
        return $this;
    }

    /**
     * Überschreibt den hier gegeben Query sofern er leer ist.
     * @param string $query
     * @throws lkdevelopment\DatenbankException
     */
    public function query($query) {
        if ($this->query == '') {
            $this->query = $query;
            return $this;
        } else {
            throw new QueryBuilderException("The Query Value is not empty. Please instantiate a new QueryBuilder Instance.");
        }
    }

    /**
     * Fügt dem String weitere Query Bestandteile hinzu
     * @param string $query
     */
    public function addToQuery($query) {
        if ($this->query != '') {
            $this->query .= $query;
            return true;
        } else {
            throw new QueryBuilderException("The Query Value is empty. Please instantiate a new QueryBuilder Instance.");
        }
    }
}

class QueryBuilderException extends \Exception {
    
}
