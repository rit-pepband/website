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
    
	/* Declare content and title (for scope) */
	$content = "";
	$title = "";

    /* Handling History is a Special Case */
    if ($name == 'history') {
		$content = renderHistory();
		if ($_GET['year'] != "") {
			$title = "History: " . $_GET['year'] . " - " . (intval($_GET['year']) + 1);
		}
		else {
			$title = "History";
		}
	}
	else {
	    $raw_content = file_get_contents('content/' . $name . '.markdown');     
	    $cleaned = preg_replace("/---.*---/sm", "", $raw_content, 1);
	    $content = Markdown($cleaned);
    
	    preg_match("/title: .*/", $raw_content, $title);
	    $title = ($title[0]);
	    $title = str_replace("title: ", "", $title);
    }
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


/**
 *
 * renderHistory - Renders a history page
 *
 * Since history is a special case, use this helper function to render it.
 *
 * Returns an associative array: {title, content}
 */
function renderHistory() {
	$year = $_GET['year'];
    if ($year == '') {
        $year = 'index';
    }
	
	/* Grab the appropriate file contents */
	$raw_nav = file_get_contents('content/blocks/hist_nav.markdown');
	$raw_content = file_get_contents('content/history/' . $year . '.markdown');

	/* Generate the layout */
	$fammel = new Fammel();
	$fammel -> parse_file('layout/history.haml');
	$layout = $fammel -> render();

	/* Create HTML for the nav and content */
	$nav_html = Markdown($raw_nav);
	$content_html = Markdown($raw_content);

	/* Add the appropriate information to the page */
	$layout = str_replace('[nav]', $nav_html, $layout);
	$layout = str_replace('[content]', $content_html, $layout);

	/* Return the appropriate information */
	return $layout;
}

?>
