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
        <meta charset="utf-8">
        <title>Query Builder by LK-Development</title>
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
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Titel und Schalter werden für eine bessere mobile Ansicht zusammengefasst -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Navigation ein-/ausblenden</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Query Builder by LK-Development</a>
                </div>

                <!-- Alle Navigationslinks, Formulare und anderer Inhalt werden hier zusammengefasst und können dann ein- und ausgeblendet werden -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#info">INFO</a></li>
                        <li><a href="#select">SELECT</a></li>
                        <li><a href="#insert">INSERT INTO</a></li>
                        <li><a href="#update">UPDATE</a></li>
                        <li><a href="#free">Freier Query</a></li>
                        <li><a href="#other">Andere</a></li>
                        <li><a href="http://querybuilder.lk-development.de/doku">API Doku</a></li>
                        <li><a href="https://github.com/GMacx3/QueryBuilder">Download (auf Github)</a></li>
                        <li><a href="https://www.lukas-kaemmerling.de/?page=legalnotice" target="_blank">Impressum</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <h3><a name="info">INFO</a></h3>
        <pre>
            Wer kennt es nicht? Man hat einen ellen langen SQL Query, er wird so lang das man ihn nicht mehr auf einen Blick versteht. 
            Um diesem Entgegen zu setzen gibt es sogenannte OR-Mapper (object-relational mapping, kurz: ORM). Sie lassen schwere Query Konstrukte einfacher dastellen.
            Da ein ganzer ORM Mapper viel mehr funktionen hat als nur das einfache erstellen von Query, habe ich mir einen QueryBuilder geschrieben.
            So lässt sich einfach und verständlich, riesen große Query Konstrukte bauen. Wie das ganze Funktioniert sehen Sie weiter unten. 

            Dies ist ein freies Projekt. Die Nutzung ist unter der MIT Lizenz gewährt.
            Aktuelle Version : 1.0.0
            Mindest PHP Version: 5.3.X
        </pre>
        <hr>
        <h3><a name="select">SELECT Abfragen</a></h3>

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
            $queryBuilderSELECT->select("b.bestellungID", "b.bestellungDatum","p.p_name")
                    ->from("bestellungen", "b")
                    ->innerJoin("praemie", "p", "b.p_id = p.p_id")
                    ->where("b.bestellungID = :bid")
                    ->orWhere("b.bestellungZeitraum > :timestampGestern");
            echo $queryBuilderSELECT;
            ?></samp>


        <hr>
        <h3><a name="insert">INSERT INTO</a></h3>

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
        <h3><a name="update">UPDATE</a></h3>
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
        <h3><a name="free">Freier Query</a></h3>
        <pre>
        <label>Quellcode</label>
        <code class="php">
        $queryBuilderFree = new lkdevelopment\QueryBuilder();
        $queryBuilderFree->query("TRUNCATE `bestellungen`");
        echo $queryBuilderFree;
            </code>
        </pre>
        <label>Ergebnis:</label>
        <samp>
            <?php
            $queryBuilderFree = new lkdevelopment\QueryBuilder();
            $queryBuilderFree->query("TRUNCATE `bestellungen`");
            echo $queryBuilderFree;
            ?>
        </samp>
    </body>
</html>
