<?php
    /**
     * Making a SPARQL SELECT query
     *
     * This example creates a new SPARQL client, pointing at the
     * dbpedia.org endpoint. It then makes a SELECT query that
     * returns all of the countries in DBpedia along with an
     * english label.
     *
     * Note how the namespace prefix declarations are automatically
     * added to the query.
     *
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */
    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/');
    require_once "rdf/EasyRdf.php";
    require_once "rdf/html_for_tag.php";
    // Setup some additional prefixes for DBpedia
    EasyRdf_Namespace::set('ns0', 'http://localhost/search-files/ontology.rdf');
    $sparql = new EasyRdf_Sparql_Client('http://localhost/search-files');
    
?>
<html>
<head>
    <title>EasyRdf Basic Sparql Example</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>EasyRdf Basic Sparql Example</h1>

<h2>List of countries</h2>
<ul>
    <?php
    $result = $sparql->query(
        'SELECT * WHERE {'.
        '  ?c ?e ?t'.
        '}'
    );




    foreach ($result as $row) {
        var_dump($row);
        print $row->label;
        print $row->country;
    }
    ?>
</ul>


</body>
</html>