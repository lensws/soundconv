<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>SoundConv Stat</title>

    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <!--<![endif]-->
    
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="css/layouts/marketing.css">
        <!--<![endif]-->
</head>
<body>


    <div class="content-head is-center">
        <h1 class="content-head is-center">Статистика</h1>
		<?php
		//random password here
		if ($_REQUEST['key']=='key123') {
			//login and pass for mysql
			$mysqli = new mysqli("localhost", "login", "pass", "db");
			/* проверка соединения */
			if ($mysqli->connect_errno) {
				printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
				exit();
			}			
			$mysqli->set_charset("utf8");
			
			
			echo('<h3 class="content-head is-center">'.date('d.M.y',time()-2629743).'  -  '.date('d.M.y').'</h3>');
			
			//Всего
			echo('<h1 class="content-head is-center">Конвертировано</h1>');			
			$result = $mysqli->query("SELECT COUNT(*) AS `month_total` FROM `stat` WHERE `whenwas` > (CURRENT_DATE - INTERVAL 1 MONTH)");
			$row = $result->fetch_assoc();
			$result = $mysqli->query("SELECT COUNT(*) AS `total` FROM `stat` WHERE 1");
			$row = $row + $result->fetch_assoc();
			echo('<h1 style="font-size: 3em;">'.$row['month_total'].'</h1>');
			echo('<div>файлов<br/>это '.round($row['month_total']/$row['total']*100).' от обещго числа '.$row['total'].'</div>');
			//echo ('<h4 class="content-head is-center">всех файлов<br/>'."{$row['month_total']} из {$row['total']}</h4>");
			$month_total=$row['month_total'];
			$result->free();
			
			echo('<h1 class="content-head is-center">Форматы</h1>');
			$result = $mysqli->query("SELECT RIGHT(`file`, 4) AS `ext`, COUNT(*) AS `total` FROM `stat` WHERE `whenwas` > (CURRENT_DATE - INTERVAL 1 MONTH) GROUP BY `ext` ORDER by `total` DESC");
			echo('<div style="width: 250px; margin-left: 40%; text-align: left;">');
			while ($row = $result->fetch_assoc()) {
				echo('<div>');
				echo(str_replace(".", "", $row['ext']));
				if (!(isset($c))) {$c=100/$row['total'];}
				echo('<div style="color: white; background-color: #34495E; width: '.round($row['total']/$month_total*100*$c).'%; min-width: 30px; padding-left: 5px;">'.round($row['total']/$month_total*100).'%</div>');
				//echo (round($row['total']/$month_total*100));
				echo('</div>');
			}
			echo('</div>');
			
			
			
			$result->free();
			
			echo('<h1 class="content-head is-center">Час дня</h1>');
			$result = $mysqli->query("SELECT HOUR(`whenwas`) AS `hours`, COUNT(*) AS `total` FROM `stat` WHERE `whenwas` > (CURRENT_DATE - INTERVAL 1 MONTH) GROUP BY `hours`");
			
			
			echo('<center>');
				$hh=array();
				while ($row = $result->fetch_assoc()) {
					if (!(isset($min))) {$min=$row['hours'];}
					$max=$row['hours'];
					$hh1 = array($row['hours'] => $row['total']);
					$hh = $hh + $hh1;
					}
				echo('<table style="width: 100%; max-width: 500px;">');
				echo('<tr style="vertical-align: bottom; padding: 5px; color: #34495E;">');
				for ($i=$min;$i<=$max;$i++) {
					echo('<td style="color: #34495E;">');
					echo('<div style="min-height: 1px; height: '.$hh[$i].'em; width: 1em; background-color: #34495E;"></div>');
					echo('<p style="width: 2em; color: #34495E;">'.$i.'</p>');
					echo('</td>');
					
				}
				echo('</tr>');
				echo('</table>');
			echo('</center>');
			echo('<p><br/><br/><br/><br/></p>');
			$result->free();
			$mysqli->close();
			}
		else {
			echo('
				<center><form class="pure-form pure-form-aligned" method="post" style="max-width: 320px;">
					<fieldset>
						<div class="pure-control-group">
							<label for="password">Password</label>
							<input id="password" name="key" type="password" placeholder="Password">
						</div>
							<button type="submit" class="pure-button pure-button-primary">Login</button>
						</div>
					</fieldset>
				</form></center>
			');
		}
		?>
    </div>

    <div class="footer l-box">
		<a href="http://lensws.be" style="color: white;">by Lensws</a>
    </div>

</div>




</body>
</html>
