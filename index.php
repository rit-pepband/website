<?php
include '.lib/fammel/fammel.php';
include '.lib/php_markdown/markdown.php';

render($_GET['page']);

function render($name){
    $fammel = new Fammel();
    $fammel->parse_file('layout/page.haml');

    $source= ($fammel->render());
    
    $raw_content = file_get_contents('content/' . $name . '.markdown');
    $cleaned = preg_replace("/---.*---/sm", "", $raw_content, 1);
    $content = Markdown($cleaned);
    
    preg_match("/title: .*/", $raw_content, $title);
    $title = ($title[0]);
    $title = str_replace("title: ", "", $title);
    
    $source = str_replace("[content]",$content,$source);
    $source = str_replace("[title]",$title,$source);
    echo $source;
}
?>
