<?
	define("PERM_VISCLIENTI", 1);
	define("PERM_CLIENTI", 2);
	define("PERM_DIPENDENTI", 3);
	define("PERM_EVENTI", 4);
	define("PERM_RIVISTE", 5);
	define("PERM_LIBRI", 6);
	define("PERM_RELATORI", 7);
	define("PERM_STEMPE_INTERNET", 8);
	
	define("ERR_LOGIN", "Errore, password o nickname non corretti");

	$con;	
	
	function Abilitato($permesso)
	{
	 
		 global $_SESSION;
		 $ret = false;
		 if (substr($_SESSION['sess_utente']->permessi, $permesso - 1, 1) == '1')
			$ret = true;
		 return $ret;
	}
	
	function str_quoted( $x )
	{
 		return "'" . str_replace ("'", "''", $x) . "'";
	}	
	
	function Connetti()
	{
		$con = mysql_pconnect( "localhost", "yourlibrary", "cufpifepme70") or die( "Impossibile collegarsi al database"); 
		mysql_select_db("my_yourlibrary", $con) or die( "Impossibile selezionare il database");
		return $con;
	}
	
	function Disconnetti($con)
	{
		mysql_close($con);
	}
	
	function getvar($nome_variabile,$default='')
	{
		 global $_GET, $_POST;
		 
		 /*if (isset($_GET[$nome_variabile]))
		  return stripcslashes($_GET[$nome_variabile]);
		 else if (isset($_POST[$nome_variabile]))
		  return stripcslashes($_POST[$nome_variabile]);
		 else*/
		 if (isset($_POST[$nome_variabile]))
		  return $_POST[$nome_variabile];
		 else if (isset($_GET[$nome_variabile]))
		  return $_GET[$nome_variabile];
		 else
		  return $default;
	}
	
	
?>