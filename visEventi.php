<?php	session_start();	include ("connettiDb.php");
	include ("XHTMLfunctions.php");
	if(!isset($_SESSION['log'])) header("Location:index.php");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">	<head>		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		<title>YourLibrary</title>		<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">	</head>	<body>     <div id="wrapper">			<div id="header" class="container">				<div id="logo">					<h1>YourLibrary</h1>           </div>
	<div id="menu">		<ul>			<li class="current_page_item"><a href="home.php">Home</a></li>			<li><a href="logout.php">logout</a></li>		</ul>   	</div>		</div><!-- end #header -->
		<div id="page" class="container">			<div id="marketing">				<p class="text1">Visualizza Eventi</p>			</div>			<div id="content">			<?php
			$query = mysql_query("SELECT * FROM Evento ORDER BY data DESC");	   	$righe=mysql_num_rows($query);			if($righe != 0)			{	        	$datequery=mysql_query("SELECT DATE_FORMAT( data,'%d/%m/%Y') datanew FROM Evento ORDER BY data DESC");				$border="1";
				$cellspacing="1";
				$cellpadding="0";
				$indici=th("data").th("titolo").th("ospite").th("descrizione").th();
				$corpo=tr($indici);			
				while($row=mysql_fetch_array($query,MYSQL_BOTH))		 		{
		 			$date=mysql_fetch_array($datequery);              	$riga_dati=td($date['datanew']).td($row['titolo']);										$d=$row['id_evento'];            
               $query2=mysql_query("SELECT * FROM Ospite WHERE evento='$d'");
               $ospiti="";               while($dati=mysql_fetch_array($query2))               {                 	$r=$dati['relatore'];
                  $querynome=mysql_query("SELECT * FROM Relatore WHERE id_relatore='$r'");                  $nom=mysql_fetch_array($querynome);                  $ospiti.=$nom['cognome']." ".$nom['nome']."-->";
                  if($dati['compenso']=="" or $dati['compenso']==0)                   	$ospiti.="gratis";                  else                    	$ospiti.=$dati['compenso'];
                  $ospiti.="<input type=button value=\"Elimina\" onclick=\"location.href='modEventi.php?action=cancOsp&data=".$d."&codF=".$r."&evento=".$t."'\"";
                  $ospiti.="<br>";					}					$riga_dati.=td($ospiti);
					$riga_dati.=td($row['descrizione']);					if($_SESSION['tipo']=='direttore')					{                 	$azioni="<input type=button value=\"Cancella\" onclick=\"location.href='cancEventi.php?action=cancvis&iddata=".$row['data']."&idtitolo=".$row['titolo']."'\"</center>";						$azioni.="<br>";                	
                	$azioni.="<input type=button value=\"Modifica\" onclick=\"location.href='modEventi.php?action=modvis&iddata=".$row['data']."&idtitolo=".$row['titolo']."'\"</center>";						$azioni.="<br>";
                  $azioni.="<input type=button value=\"Ospiti\" onclick=\"location.href='insOspiti.php?action=insosp&iddata=".$row['data']."&idtitolo=".$row['titolo']."'\"</center>";						$riga_dati.=td($azioni);					
					}
					$corpo.=tr($riga_dati);				}				echo table($corpo, $border, $cellspacing, $cellpadding);
			}			else			{				echo "<div class=\"post\"><h2 class=\"title\">Nessun Risultato</h2></div>";			}			mysql_close($con);		?>			</div><!-- end #content -->			</div><!-- end #page -->			</div><!-- end #wrapper -->			<?include ("footer.php");?>