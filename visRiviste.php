<?php
	include ("XHTMLfunctions.php");
    <div id="menu">
				<div id="page" class="container">
				<?php
					$query = mysql_query("SELECT r.*,cat.genere FROM Rivista AS r INNER JOIN Categoria AS cat ON cat.id_categoria=r.categoria ORDER BY titolo");
						$border="1";
				 		$cellspacing="1";
				 		$cellpadding="0";
				 		$indici=th("titolo").th("genere").th("cadenza").th("azioni(da fare!!)");
				 		$corpo=tr($indici);
							if($_SESSION['tipo']=='bibliotecario')
           					
           				}
           				$corpo.=tr($riga_dati);	
						}
						echo table($corpo, $border, $cellspacing, $cellpadding);
        			}
					mysql_close($con);