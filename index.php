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
require_once 'QueryBuilder.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="windows-1252">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/default.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>

    </head>
    <body>
        <h3>SELECT Abfragen</h3>
        <pre>
        <label>Quellcode</label>
            <code class="php">
        require_once 'QueryBuilder.class.php';
        $queryBuilderSELECT = new lkdevelopment\QueryBuilder();
        $queryBuilderSELECT->select("bestellungID", "bestellungDatum")->from("bestellungen", "b")->where("b.bestellungID = :bid")->groupBy("b.bestellDatum")->limit(1, 3);
        echo  $queryBuilderSELECT;
            </code>
        </pre>
        <label>Ergebnis:</label>
        <samp> <?php
            
            $queryBuilderSELECT = new lkdevelopment\QueryBuilder();
            $queryBuilderSELECT->select("bestellungID", "bestellungDatum")->from("bestellungen", "b")->where("b.bestellungID = :bid")->groupBy("b.bestellDatum")->limit(1, 3);
            echo $queryBuilderSELECT;
            ?></samp>


        <hr>
        <h3>INSERT INTO</h3>
        <pre>
        <label>Quellcode</label>
            <code class="php">
        $queryBuilderInsert = new lkdevelopment\QueryBuilder();
        $queryBuilderInsert->insertInto("bestellung_status", array("bestellung_id" => ":bestellungid", "rueckgabe" => ":rueckgabe"));
        echo $queryBuilderInsert;
            </code>
        </pre>
        <label>Ergebnis:</label>
        <samp>  <?php
            $queryBuilderInsert = new lkdevelopment\QueryBuilder();
            $queryBuilderInsert->insertInto("bestellung_status", array("bestellung_id" => ":bestellungid", "rueckgabe" => ":rueckgabe"));
            echo $queryBuilderInsert;
            ?>
        </samp>


        <hr>
        <h3>UPDATE</h3>
        <pre>
        <label>Quellcode</label>
            <code class="php">
        $queryBuilderUpdate = new lkdevelopment\QueryBuilder();
        $queryBuilderUpdate->update("bestellungen", array("bestellungDatum" => ":bDatum"))->where("bestellungID = :bid");
        echo $queryBuilderUpdate;
            </code>
        </pre>
        <label>Ergebnis:</label>
        <samp> <?php
            $queryBuilderUpdate = new lkdevelopment\QueryBuilder();
            $queryBuilderUpdate->update("bestellungen", array("bestellungDatum" => ":bDatum"))->where("bestellungID = :bid");
            echo $queryBuilderUpdate;
            ?></samp>

        <hr>
        <h3>UPDATE</h3>
        <pre>
        <label>Quellcode</label>
        <code class="php">
        $queryBuilderDelete = new lkdevelopment\QueryBuilder();
        $queryBuilderDelete->deleteFrom("bestellungen")->where("bestellungDatem > :bDatum")->limit(2);
        echo $queryBuilderDelete;
            </code>
        </pre>
        <label>Ergebnis:</label>
        <samp><?php
            $queryBuilderDelete = new lkdevelopment\QueryBuilder();
            $queryBuilderDelete->deleteFrom("bestellungen")->where("bestellungDatem > :bDatum")->limit(2);
            echo $queryBuilderDelete;
            ?></samp>

        <hr>
        <h3>Freier Query</h3>
        <pre>
        <label>Quellcode</label>
        <code class="php">
        $queryBuilderFree = new lkdevelopment\QueryBuilder();
        $queryBuilderFree->query("TRUNCATE `bestellungen`");
        echo $queryBuilderFree;
            </code>
        </pre>
        <label>Ergebnis:</label>
        <samp><?php
            $queryBuilderFree = new lkdevelopment\QueryBuilder();
            $queryBuilderFree->query("TRUNCATE `bestellungen`");
            echo $queryBuilderFree;
            ?></samp>
    </body>
</html>
