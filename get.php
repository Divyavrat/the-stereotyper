<?php
$keyword = strtolower($_GET["url"]);
$search = 'why are '.$keyword.' ';

$link = 'http://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=en-US&q='.urlencode($search);

if (file_get_contents($link)) {
	$data = file_get_contents($link);
	
	if (($data = json_decode($data, true)) !== null) {
        $keywords = $data[1];
    }

    // converting to one line string and cleaning
	$oneline = implode(", ",$keywords);
    $oneline = str_replace("why ", " ", $oneline);
    $oneline = str_replace("are ", " ", $oneline);
    $oneline = str_replace($keyword, " ", $oneline);
    $oneline = str_replace(substr($keyword, 0, -1), " ", $oneline);
    
    if($oneline != ''){
	   echo $oneline;
    } else {
        echo "Sorry, nothing was found, please try a different keyword";
    }

} else {
	echo "Not Found";
}

/*
function getKeywordSuggestionsFromGoogle($keyword) {
    $keywords = array();
    $data = file_get_contents('http://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=en-US&q='.urlencode($keyword));
    if (($data = json_decode($data, true)) !== null) {
        $keywords = $data[1];
    }

    return $keywords;
}

var_dump(getKeywordSuggestionsFromGoogle('why are syrians'));
*/
?>