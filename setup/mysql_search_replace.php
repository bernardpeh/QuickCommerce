<?php

// You don't have to use quickcommerce.dev. 
// This is a useful script to change the domains in your sql really quickly.
// Bernard Peh 25 Oct 2013

if (count($argv) != 2) {
	echo "\nPls enter an argument for the search term. for eg, php mysql_search_replace.php quickcommerce.dev\n\n";
	exit;
}
// Config
$server = "localhost";
$username = "root";
$passwd = "";
$db = "quickcommerce";
$searchTerm = $argv[1];

// leave $replaced empty if you want to search only
$replaced = "mynewdomain.com";
$log = "mysql_search.log";
// --- END OF CONFIGURATION -- //
mysql_connect($server, $username, $passwd);
mysql_select_db("$db");
$r = mysql_query("show tables");

while ($table = mysql_fetch_array($r, MYSQL_ASSOC)) {
  $r1 = mysql_query("show columns from ".$table['Tables_in_'.$db]);
  while ($col = mysql_fetch_array($r1, MYSQL_ASSOC)) {
    $r2 = mysql_query("Select * from ".$table['Tables_in_'.$db]." where ". $col['Field']." like '%$searchTerm%'");
    while ($match = mysql_fetch_array($r2)) {
        $str = "table(".$table['Tables_in_'.$db].") - First_column_id ($match[0]) - column_matched (". $col['Field'].")\n";
        echo $str;
	if ($replaced != "") {
	  mysql_query("update ".$table['Tables_in_'.$db]." set ".$col['Field']."=replace(".$col['Field'].", '$searchTerm', '$replaced') where ".$col['Field']." like '%$searchTerm%'");
	  $str .= "replaced $searchTerm\n";
	  echo $str;
	}
        $fp = fopen($log, 'a+');
        fwrite($fp, $str);
        fclose($fp);
    }
  }
}
