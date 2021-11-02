# PHP-TEMPLATE-PARSE

Salah satu cara untuk mempermudah membangun website dengan cara templating,
dengan membuat fungsi pada php untuk memanggil file template untuk di sajikan kepada client.


Related projects:



#### Php fungsi

Kita akan membuat sedikit function menggunakan php.

Berikut script sederhana untuk functionya:

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

Beberapa fungsi di terapkan untuk memanggil file template untuk proses memparse dan menampilkan objek.

### Template

Contoh sederhana kode html yang di simpan dalam file template

	dir dan file template
	
<code>/template/index.ollabs</code>

	contoh html kode pada file file <em>index.ollabs</em>
	
	<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Slide and Swipe Menu</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <!-- CSS stylesheet for example -->
          
        <!-- CSS stylesheet for sliding-swipe-menu -->
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
		<center>
	{_header}
		<h2>{_webname}</h2>
	<hr>
		{_pages}
	<br>
	<hr>
		{_footer}
	</body>
</html>


#NB-
 -Ini hanyalah sebagian dari yang sederhana dalam teknik templating pada php
 -Kurangnya dan lebihnya silahkan di koreksi dan di tambahkan 
 
 


