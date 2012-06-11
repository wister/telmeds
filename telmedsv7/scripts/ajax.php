<?php if ($_SERVER['HTTP_REFERER'] != "http://www.telmeds.org/cronograma/") { 
header("Location: http://www.telmeds.org/404.php");
//die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); 
} ?>
<?php
//echo $_SERVER['HTTP_REFERER'];
//echo $_SERVER['SCRIPT_FILENAME'];

require_once("../../../../wp-config.php");
if(!empty($_POST["id"]) && !empty($_POST["content"])){
	$id = $_POST["id"];
	$content = $_POST["content"];
	
	$con = mysql_connect("localhost", WISTER_USER, WISTER_PASSWORD);
	if (!$con) { die('Could not connect: ' . mysql_error()); }
	mysql_select_db(WISTER_DATABASE, $con) or die("Could not select database");

	$query = sprintf("UPDATE crono SET content='%s' WHERE id='%s'", escape($content), escape($id));
	$query = mysql_query($query);
	mysql_close($con);
	
        //echo $myrows[0];
	if($query){echo "Successfuly saved.";}
}
else { echo '<font color="red">Something went bad.</font>';}
?>

<?php
function escape($str)
        {
                $search=array("\\","\0","\n","\r","\x1a","'",'"');
                $replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
                return str_replace($search,$replace,$str);
        }
?>