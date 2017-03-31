<style>

body {
    font-family: "Arial", Arial, Verdana, sans-serif;
}

.StyleTable {
  #width:100px;
  border-collapse: collapse;
  border: 1px solid #758de5;
}
.StyleTable th, .StyleTable td {
  border: 1px solid #a5b6f1;
}
}
</style>

<?php

if(isset($_GET['annee']))      $dDateDebut=htmlspecialchars($_GET['annee']);
else      $dDateDebut="";

/*if(isset($_GET['mode']))      $bSuppr=htmlspecialchars($_GET['mode']);
else      $bSuppr=0;*/

switch($_GET['mode']){
	case 1:
		/*Ajout*/
		$bAjout=1;
		break;
	case 2:
		/*Suppression*/		
		$bSuppr=1;
		break;
}

if(isset($_GET['debut']))      $dSupprDebut=htmlspecialchars($_GET['debut']);
else      $dSupprDebut="";

if(isset($_GET['fin']))      $dSupprFin=htmlspecialchars($_GET['fin']);
else      $dSupprFin="";

if(isset($_GET['zone']))      $sZone=htmlspecialchars($_GET['zone']);
else      $sZone="";

$bOk = mysql_connect('kartingctrot.mysql.db','kartingctrot','cAmw268s3FcA');
mysql_select_db("kartingctrot");

if($bOk){
	
	if($bSuppr == 1){
		$sRequeteSuppr = 'DELETE FROM afh_horaires
							WHERE annee = "'.$dDateDebut.'"
							AND debut = "'.$dSupprDebut.'"
							AND fin = "'.$dSupprFin.'"
							AND zone = "'.$sZone.'"	';
							
		$bOk = mysql_query($sRequeteSuppr);
	
		if($bOk == 1){
			echo 'Suppression effectuée <br /><br />';		
		}
	}

	if($bAjout == 1){
		$sRequeteAjout = 'INSERT INTO afh_horaires(annee, debut, fin, zone) VALUES("'.$dDateDebut.'", "'.$dSupprDebut.'", "'.$dSupprFin.'", "'.$sZone.'")';
		echo $sRequeteAjout;					
		$bOk = mysql_query($sRequeteAjout);
	
		if($bOk == 1){
			echo 'Ajout effectuée <br /><br />';		
		}
	}
	

	echo 'Dates deja saisies : <br /><br />'; 
	echo '<form action="calendrier.php" method="GET">';
	echo			'<select name="annee" id="annee">';
	echo			'<option value="2012" ';if($dDateDebut == 2012){echo ' selected';} echo '>2012</option>';
	echo			'<option value="2013" ';if($dDateDebut == 2013){echo ' selected';} echo '>2013</option>';
	echo			'<option value="2014" ';if($dDateDebut == 2014){echo ' selected';} echo '>2014</option>';
	echo			'<option value="2015" ';if($dDateDebut == 2015){echo ' selected';} echo '>2015</option>';
	echo			'<option value="2016" ';if($dDateDebut == 2016){echo ' selected';} echo '>2016</option>';
	echo			'<option value="2017" ';if($dDateDebut == 2017){echo ' selected';} echo '>2017</option>';
	echo			'<option value="2018" ';if($dDateDebut == 2018){echo ' selected';} echo '>2018</option>';
	echo			'<option value="2019" ';if($dDateDebut == 2019){echo ' selected';} echo '>2019</option>';
	echo			'</select>
				<input type="submit" value="Valider" />
			</form>';
	
	

	
	
	$sRequete = 'SELECT annee, zone, debut, fin 
					FROM afh_horaires
					';
					
	if($dDateDebut<>""){
		$sRequete = $sRequete .'WHERE annee = '.$dDateDebut;
	}				
	
	$rsResult = mysql_query($sRequete);/* or die('load1 -' .  mysql_error());*/
	
	$i = 0;
	
	echo '<table  class="StyleTable">';
	echo '<tr><th>Année</th><th>Zone</th><th>debut</th><th>fin</th><th>Suppr.</th></tr>';
	
	while ($row = mysql_fetch_array($rsResult, MYSQL_ASSOC)) {
		$i = $i+1;
		$dDebut = $row['debut'];
		$dFin = $row['fin'];
		printf('<tr><td>%s</td>', $row['annee']);
		printf('<td>%s</td>', $row['zone']);
		printf('<td>%s</td>', $dDebut);
		printf('<td>%s</td>', $dFin);
		printf('<td>%s</td></tr>', '<a href="calendrier.php?mode=2&annee='.$row['annee'].'&debut='.$dDebut.'&fin='.$dFin.'&zone='.$row['zone'].'"><img src="suppr.png" /></a>');
	}
	
	echo '</table>';

	echo '<br /><br />';
	
	echo '<form action="calendrier.php" method="GET">';
	echo '<input type="hidden" name="mode" value="1">';
	echo 'annee : <input type="text" name="annee">';
	echo '&nbsp&nbsp debut : <input type="text" name="debut">';
	echo '&nbsp&nbsp fin : <input type="text" name="fin">';
	echo '&nbsp&nbsp zone : <input type="text" name="zone">';
	echo '&nbsp&nbsp<input type="submit" value="Valider" />
			</form>';
	
}
else {
	print('toto');
}
	
mysql_close();

?>
