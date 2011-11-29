<?php
include '.lib/fammel/fammel.php';
include '.lib/php_markdown/markdown.php';

render($_GET['page']);

function render($name){
    $fammel = new Fammel();
    $fammel->parse_file('layout/page.haml');

    $source= ($fammel->render());
    $content = Markdown(file_get_contents('content/' . $name . '.markdown'));

    $source = str_replace("[content]",$content,$source);
    echo $source;
}
?>
