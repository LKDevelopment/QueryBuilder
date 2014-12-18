  The MIT License
 
  Copyright 2014 Lukas Kämmerling.
 
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:
 
  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.
 
  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 
 [Homepage](querybuilder.lk-development.de)
 
 [API Dokumentation](querybuilder.lk-development.de/doku/)
        <h3>SELECT Abfragen</h3>
        <pre>
        <label>Quellcode</label>
            <code>
        $queryBuilderSELECT = new lkdevelopment\QueryBuilder();
        $queryBuilderSELECT->select("bestellungID", "bestellungDatum")->from("bestellungen", "b")->where("b.bestellungID = :bid")->groupBy("b.bestellDatum")->limit(1, 3);
        echo  $queryBuilderSELECT;
            </code>
        </pre>
        <label>Ergebnis:</label>
        <samp> SELECT bestellungID,bestellungDatum FROM `bestellungen` as b WHERE b.bestellungID = :bid GROUP BY b.bestellDatum LIMIT 1,3</samp>

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
        <samp> INSERT INTO `bestellung_status` SET `bestellung_id` = :bestellungid,`rueckgabe` = :rueckgabe
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
        <samp>UPDATE `bestellungen` SET `bestellungDatum` = :bDatum WHERE bestellungID = :bid</samp>

        <hr>
        <h3>Freier Query</h3>
        <pre>
        <label>Quellcode</label>
        <code class="php">
        $queryBuilderDelete = new lkdevelopment\QueryBuilder();
        $queryBuilderDelete->deleteFrom("bestellungen")->where("bestellungDatem > :bDatum")->limit(2);
        echo $queryBuilderDelete;
            </code>
        </pre>
        <label>Ergebnis:</label>
