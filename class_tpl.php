<?php

/**********************************************\
*	 Copyright (c) 2021 						*
*	script create & editing Ganjar seftian       *
* www.antarz.com
\**********************************************/
 
function template_parse($dirtpl,$params) {
	$templateFile = $params["templateFile"];
	$keyValues = $params["keyValues"];
	
	if(!(substr($templateFile, 0, 10) === "template/")) {
	$templateFile = "template/".$dirtpl."/" . $templateFile;
	}
	if(!file_exists($templateFile)) { 
	
	$templateFile = "template/index.ollabs";
	}
	$output = file_get_contents($templateFile);
	
	 foreach ($keyValues as $key => $value) {
	 $tagToReplace = "{_$key}";
	 $output = str_replace($tagToReplace, $value, $output);
	}
	return $output;
	}
	
	
define("_HEADER","INI HEADER");
define("_WEBNAME","My Webname");
define("_PAGES","INI PAGE");
define("_FOOTER","&copy; Copyright 2021 <a href='http://antarz.com'>www.antarz.com</a>");


$keyValues = array(
	"webname"	=>	_WEBNAME,
	"header"	=>	_HEADER,
	"footer"	=>	_FOOTER,
	"pages"		=>	_PAGES
	);

$brekele = array("templateFile"=>"index.ollabs", "keyValues"=>$keyValues);

$final = template_parse("default",$brekele);
echo $final;
die();


?>
