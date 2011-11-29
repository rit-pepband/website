<?php
include '.lib/fammel/fammel.php';
include '.lib/php_markdown/markdown.php';

$fammel = new Fammel();
$fammel->parse_file('layout/page.haml');

$source= ($fammel->render());
$content = Markdown(file_get_contents('home.markdown'));

$source = str_replace("[content]",$content,$source);
echo $source;
?>
