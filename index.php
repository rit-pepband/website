<?php
include '.lib/fammel/fammel.php';
include '.lib/php_markdown/markdown.php';

render($_GET['page']);


function render($name){
    if($name == ''){
      $name = 'home';
    }
    $fammel = new Fammel();
    $fammel->parse_file('layout/page.haml');

    $source= ($fammel->render());
    
    $raw_content = file_get_contents('content/' . $name . '.markdown');
    $cleaned = preg_replace("/---.*---/sm", "", $raw_content, 1);
    $content = Markdown($cleaned);
    
    preg_match("/title: .*/", $raw_content, $title);
    $title = ($title[0]);
    $title = str_replace("title: ", "", $title);
    
    $nav = '';
    $nav = Markdown(file_get_contents('content/blocks/nav.markdown'));
    
    if ($name == 'home'){
        $nav = str_replace('href="./"', 'href="./" class="selected"', $nav);
    }
    else {
        $nav = str_replace('href="./' . $name . '"', 'href="./' . $name . '" class="selected"', $nav);
    }

    $right = '';
    $right = Markdown(file_get_contents('content/blocks/right.markdown'));
    
    
    $source = str_replace("[content]",$content,$source);
    $source = str_replace("[title]",$title,$source);
    $source = str_replace("[nav]",$nav,$source);
    $source = str_replace("[right]",$right,$source);
    echo $source;
}
?>
