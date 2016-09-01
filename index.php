<?php
/**
 * Construct a FOAF document with a choice of serialisations
 *
 * This example is similar in concept to Leigh Dodds' FOAF-a-Matic.
 * The fields in the HTML form are inserted into an empty
 * EasyRdf_Graph and then serialised to the chosen format.
 *
 * @package    EasyRdf
 * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
 * @license    http://unlicense.org/
 */
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/');
require_once "rdf/EasyRdf.php";
require_once "rdf/html_for_tag.php";

?>
<html>
<head>
    <title>search-rdf-files</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<?php

$base_ontology = "http://localhost/search-files/ontology.rdf";

$rdf = file_exists("files.rdf") ? "http://localhost/search-files/files.rdf" : create_or_replace_file_rdf("");


if (isset($rdf) and !empty($_FILES['file']['name'])) {

    //nome do arquivo
    $time = time();
    $name_file = "files/".$time.".".get_ext();

    if(move_uploaded_file($_FILES['file']['tmp_name'], $name_file)){
        $graph = new EasyRdf_Graph();
        $graph->load($rdf);

        # 1st Technique
        $me = $graph->resource($rdf."#".$time);
        $me->set($base_ontology.'#title', $_REQUEST['title']);

        if ($_REQUEST['author']) {
            $me->set($base_ontology.'#author', $_REQUEST['author']);
        }
        if ($_REQUEST['keywords']) {
            $me->set($base_ontology.'#keyword', $_REQUEST['keywords']);
        }

        $me->set($base_ontology.'#downloadURL', $name_file);
        $me->set($base_ontology.'#description', $_REQUEST['description']);





        # Finally output the graph
        $data = $graph->serialise('rdfxml');


        if (!is_scalar($data)) {
            $data = var_export($data, true);
        }

        print "<pre>".htmlspecialchars($data)."</pre>";

        //criando o arquivo rdf
        create_or_replace_file_rdf($data);
    }
}else{
    if(isset($_FILES['file']['name']))
        print "<div class=\"alert alert-danger\" role=\"alert\">Falha ao subir o arquivo</div>";
}


function get_ext(){
    return end(explode(".", $_FILES['file']['name']));
}

function clean_spaces($str){
    return str_replace(" ", "-", $str);
}

function create_or_replace_file_rdf($data){
    $path = "files.rdf";

    $file = fopen($path, "w");
    fwrite($file, $data);
    fclose($file);

    return $path;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center">Adicionar arquivo</h1>



            <?= form_tag(null, array('method' => 'POST', "enctype"=>"multipart/form-data", "class" => "form-group")) ?>

            <h2>Files details</h2>
            <?= labeled_text_field_tag('title', 'Mr', array('size'=>8, "class"=>"form-control")) ?><br />
            Descrição <br> <?= text_area_tag('description', 'Joseph', array("class"=>"form-control")) ?><br />
            <?= labeled_text_field_tag('author', 'Bloggs', array("class"=>"form-control")) ?><br />
            <?= labeled_text_field_tag('keywords', 'Joe', array("class"=>"form-control")) ?><br />

            <h2>upload</h2>
            arquivo <input type="file" name="file" class="form-control"><br />

            <?= submit_tag() ?>
            <?= form_end_tag() ?>

        </div>
    </div>
</div>
</body>
</html>