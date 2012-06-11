<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME'] || current_user_can('edit_posts') === false) { 
header("Location: http://www.telmeds.org/404.php");
die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); 
} ?>
<?php
/*
Template Name: Cronograma
*/
?>
<?php 
header('Content-type: text/html; charset=utf-8');
?>
<?php get_header();?>
<?php get_telmeds_head();?>

<div id="cuerpo">
<div class="wrapper">
<?php 
      /*
      global $current_user;
      get_currentuserinfo();

      echo 'Username: ' . $current_user->user_login . "\n";
      echo 'User email: ' . $current_user->user_email . "\n";
      echo 'User first name: ' . $current_user->user_firstname . "\n";
      echo 'User last name: ' . $current_user->user_lastname . "\n";
      echo 'User display name: ' . $current_user->display_name . "\n";
      echo 'User ID: ' . $current_user->ID . "\n";

      //echo 'Editor: ' . current_user_can('editor') . "\n";
      $capabilities = get_object_vars(get_role( 'editor' ));
      $capabilities = $capabilities["capabilities"];
      echo "<pre>"; print_r($capabilities); echo "</pre>"; 
      echo "<br/><br/>";
      */
?>
<script type = "text/javascript" src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/jquery-1.7.1.js"></script>

<style type="text/css">
#cronograma {
border-collapse:separate;
border: 1px solid black;
border-spacing:10px;

}
#cronograma tr td  {cursor:pointer; text-align:center; }
#cronograma tr td, th { background:#fff; padding:3px;}
#cronograma tr td.date:hover { background:#fff; cursor:auto;}
#cronograma tr td:hover { background:grey; }
#cronograma tr td.greensquare { background:#005511; color:white; }
#cronograma tr td.greensquare:hover { background:#007722; color:white; }
#cronograma tr td.redsquare { background:#550011; color:white; }
#cronograma tr td.redsquare:hover { background:#770022; color:white; }

#log { display: none; color:green; border-style:solid; border-width:1px; text-align:center;}
  </style>

<?php if(current_user_can('crono') === true){ ?>
<form action="http://www.telmeds.org/cronograma/" method="post">

Usage: Input date as month/day/year<br />
**Bold means repetition due to lack of members or bad luck on the yearly sectorial publication<br /><br />
From:
<input type="text" name="from_date" value=""/>
<br />
To:
<input type="text" name="to_date" value=""/>
<br />
<input type="submit" value="Generate" /> <input type="submit" name="id" value="Load" />
</form>
<?php } 
else {
Load(1);
}
?>


<?php
//Rules: 2 publicaciones por mes

$secciones = array("Prosalud", "Imagen médica", "Documentos", "Imagen reto", "Casos clínicos", "Cápsulas", "Artículos", "Quices", "Perlas", "Noticias");
$integrantes = array("Ruby", "Justo", "JoseMa", "Yashica", "Hector", "Oris", "Ivan", "Magda", "Zabdy", "Ken", "Kevin", "Eliany", "Manar", "Victor", "Itsa", "Juan", "Kenny", "Carlos", "Wister", "David", "Luis"); //"<b>EXTRA1</b>", "<b>EXTRA2</b>"
	//echo $integrantes[array_rand($integrantes)];
$sec_2w = array("Prosalud", "Casos clínicos", "Artículos");
$sec_2w_last;
$duty_array = array();

	foreach($secciones as $secc){
		$duty_array[$secc][0] = array();
	}

$fromDate;
$toDate;
$years;

if(!empty($_POST["from_date"])){
	$fromDate = $_POST["from_date"];
}
if(!empty($_POST["to_date"])){
	$toDate = $_POST["to_date"];
}

if(!empty($fromDate) && !empty($toDate)){
Main($fromDate, $toDate);
}
else if(!empty($_POST["id"])){
//Load($_POST["id"]);
Load(1);
}

else {
//echo "A date is missing.";
}
?>




<?php
function Load($id){
	$con = mysql_connect("localhost", WISTER_USER, WISTER_PASSWORD);
	if (!$con) { die('Could not connect: ' . mysql_error()); }
	mysql_select_db(WISTER_DATABASE, $con);
	
	$query = mysql_query("SELECT content FROM crono WHERE id='$id'");
	$query = mysql_fetch_row($query);
	mysql_close($con);

	echo '<div id="log"></div><br/>'."\n";
	echo '<table id="cronograma">'."\n";
	echo reverse_escape($query[0]);
	echo "</table>";
}

function Main($fromDate, $toDate){	
	global $secciones, $integrantes, $duty_array, $years;
	$fromDateTS = strtotime($fromDate);
	$toDateTS = strtotime($toDate);
	

	$years = ceil(($toDateTS - $fromDateTS)/(365*24*60*60));
//echo $years;
	//echo date("D",$fromDateTS);
	while(date("D",$fromDateTS) != "Sun"){ //Finds the first Sunday of the month.
		$fromDateTS += 24*60*60;
		//echo date("D d  ",$fromDateTS);		
	}
	
	echo '<div id="log"></div><br/>';
	echo '<table id="cronograma">'."\n<th>Date</th>"."\n";


	for($sec_i = 0; $sec_i < sizeof($secciones); $sec_i++){
			echo "<th>".$secciones[$sec_i]."</th>\n";	
			}

	for($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (24*60*60)){
		if(date("D",$currentDateTS) == "Sun"){
			$current_month = date("F", $currentDateTS);
			//echo date("D d M", $currentDateTS);
			//echo "<br />";
			echo "<tr>\n";
			if(empty($last_month) || $last_month != $current_month){
				echo '<td class="date"><strong>'.date("F", $currentDateTS)."</strong></td>";
				for($sec_i = 0; $sec_i < sizeof($secciones); $sec_i++){
					echo '<td class="date">'."</td>\n";
				}
				echo "</tr>\n";
				$currentDateTS -= (24*60*60);
				$last_month = $current_month;
			}			
			
			else {
			echo '<td class="date">'.date("D d", $currentDateTS)."</td>\n";
			for($sec_i = 0; $sec_i < sizeof($secciones); $sec_i++){
				
				if(isAbleSeccion($secciones[$sec_i], $currentDateTS)){
				echo "<td>";
					$listintegrantes = array();
					$listintegrantes = $integrantes;
					//echo "<pre>"; print_r($listintegrantes); echo "</pre>";
					$currentIntegrante = $integrantes[array_rand($integrantes)];
					$badluck = false;
					while(isAble($secciones[$sec_i], $currentDateTS, $currentIntegrante, $badluck) === false){
						set_time_limit(20);
						unset($listintegrantes[array_search($currentIntegrante, $listintegrantes)]);
						if(empty($listintegrantes)){
							$listintegrantes = $integrantes;
							$badluck = true;
							//exit();
							
						}
						//echo "<pre>"; print_r($listintegrantes); echo "</pre>";
						//$index = array_rand($listintegrantes);
						//echo "index:" . $index . "</br>";
						$currentIntegrante = $listintegrantes[array_rand($listintegrantes)];
						//if($badluck === true){$currentIntegrante = $currentIntegrante;}
					}
					$level = sizeof($duty_array[$secciones[$sec_i]]);
					//echo $level;
					if(sizeof($duty_array[$secciones[$sec_i]][$level-1]) == sizeof($integrantes)){
						$duty_array[$secciones[$sec_i]][$level][$currentDateTS] = $currentIntegrante;
					}
					else {
						$duty_array[$secciones[$sec_i]][$level-1][$currentDateTS] = $currentIntegrante;
					}
					if($badluck === true){echo "<strong>$currentIntegrante</strong>";}					
					else { echo $currentIntegrante; }
					unset($listintegrantes);
				echo"</td>\n";
				}
				else {
					echo '<td class="date">'."</td>\n";
				}
			}
			echo "</tr>\n";
			}
		}

	}

	echo "</table>";
	//echo "<pre>";print_r($duty_array);echo "</pre>";
}

function isAble($seccion, $currentDateTS, $currentIntegrante, $badluck){
	if(isAbleMonth($currentDateTS, $currentIntegrante, $badluck) && isAbleYear($seccion, $currentDateTS, $currentIntegrante, $badluck) && isAbleDay($currentDateTS, $currentIntegrante) && isAblePeriod($currentDateTS, $currentIntegrante)){
		return TRUE;
	}
	else {
		return FALSE;
	}
}

function isAblePeriod($currentDateTS, $currentIntegrante){
	global $duty_array;
	$period;
	foreach($duty_array as $key => $value){
		foreach($duty_array[$key] as $levelkey => $levelvalue){
			foreach($duty_array[$key][$levelkey] as $date => $person){
				if($person == $currentIntegrante){
					if(empty($period)){ $period = $date;}
					else if($date > $period){ $period = $date;}
				}

			}

		}
	}
	if(empty($period)){ return TRUE;}
	else if(($currentDateTS-$period) >= 14*24*60*60){ return TRUE;}
	else { return FALSE;}

}

function isAbleDay($currentDateTS, $currentIntegrante){
	global $duty_array;
	$maxpub = 1;
	$daycount = 1;
	foreach($duty_array as $key => $value){
		foreach($duty_array[$key] as $levelkey => $levelvalue){
			foreach($duty_array[$key][$levelkey] as $date => $person){
				if($person == $currentIntegrante && $date == $currentDateTS){
					//echo $date;
					$daycount++;
				}

			}

		}
	}

	if($daycount <= $maxpub){
		return TRUE;
	}
	else {
		return FALSE;
	}

}

function isAbleYear($seccion, $currentDateTS, $currentIntegrante, $badluck){
	global $duty_array, $years;
	$maxpub = 1;
	$sectioncount = 1;
	if($badluck === true){ $maxpub = $years * 3;}
	foreach($duty_array as $key => $value){
		foreach($duty_array[$key] as $levelkey => $levelvalue){
			foreach($duty_array[$key][$levelkey] as $date => $person){
				if($person == $currentIntegrante && $key == $seccion){
					//echo $date;
					$sectioncount++;
				}

			}

		}
	}

	if($sectioncount <= $maxpub){
		return TRUE;
	}
	else {
		return FALSE;
	}

}

function isAbleMonth($currentDateTS, $currentIntegrante, $badluck){
	global $duty_array;
	$month = date("F", $currentDateTS);
	$monthcount = 1;
	$maxpub = 2;
	if($badluck === true){ $maxpub = 3; }
	foreach($duty_array as $key => $value){
		foreach($duty_array[$key] as $levelkey => $levelvalue){
			foreach($duty_array[$key][$levelkey] as $date => $person){
				if($person == $currentIntegrante && date("F", $date) == $month){
					//echo $date;
					$monthcount++;
				}

			}

		}
	}
	//echo $monthcount;
	if($monthcount <= $maxpub){
		return TRUE;
	}
	else {
		return FALSE;
	}

}


function isAbleSeccion($seccion, $currentDateTS){
	global $sec_2w, $sec_2w_last;
	foreach($sec_2w as $sec){
		if($seccion == $sec && ($currentDateTS-$sec_2w_last) >= (14*24*60*60) || $currentDateTS == $sec_2w_last){
			$sec_2w_last = $currentDateTS;
			return TRUE;
		}
		else if($seccion == $sec && ($currentDateTS-$sec_2w_last) < (14*24*60*60)){
			return FALSE;
		}
	}
	return TRUE;
}

function reverse_escape($str)
{
  $search=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
  $replace=array("\\","\0","\n","\r","\x1a","'",'"');
  return str_replace($search,$replace,$str);
}
?>

<?php if(current_user_can('crono') === true){ ?>
<script>
var savetime;

$("#cronograma tr td:not(.date)").toggle(
    function () {
      $(this).addClass("greensquare");
	clearTimeout(savetime);
	savetime = setTimeout("ajaxsave()", 3000);
    },
    function () {
      $(this).addClass("redsquare").removeClass("greensquare");
	clearTimeout(savetime);
	savetime = setTimeout("ajaxsave()", 3000);
    },
    function () {
      $(this).removeClass("redsquare");
	clearTimeout(savetime);
	savetime = setTimeout("ajaxsave()", 3000);
    }
    
  );

function ajaxsave(){
var id = 1;
var content = $('#cronograma').html();
//var content = $.base64.encode($('#cronograma'))
//var content = "lola";
var datastring = "id="+id+"&content="+content;
//alert(datastring);
var request = $.ajax({
  url: "http://www.telmeds.org/wp-content/themes/telmedsv7/scripts/ajax.php",
  type: "POST",
  data: datastring,
  dataType: "html"
});

request.done(function(msg) {
  $("#log").html(msg).fadeIn(1500).fadeOut(1500);
  //$("#log").fadeIn("slow");

});

request.fail(function(jqXHR, textStatus) {
  //alert( "Request failed: " + textStatus );
$("#log").html(textStatus).fadeIn(1500).fadeOut(2000);
});

}
</script>
<?php } ?>
</div>
<br/>
</div>

<?php get_footer();?>