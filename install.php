<?php if( !isset($_REQUEST[ 'install' ]) || $_REQUEST[ 'install' ] > 1 ): ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Install</title>
	</head>
	<body>
		<div style="position: absolute; top: 10px; width: 100%;">
			<div style="width: 500px; margin: 0 auto; text-align: center;">
				<h1>Установка приложения</h1>
				<button id="install" style="cursor: pointer;">Начать</button>
				<p>
					<progress id="progress" value="<?php echo ((isset($_REQUEST[ 'install' ]))?(0.6):(0)); ?>"></progress>
				</p>
				<div id="res" style="font-weight: bold;"><?php if (isset($_REQUEST[ 'install' ])) echo "
				Инициализация..."; ?></div>
			</div>
		</div>
	</body>
	<?php if(!isset($_REQUEST[ 'install' ])): ?>
	<script>
		document.getElementById( 'install' ).onclick = function(){
			document.getElementById('progress').value = 0.15;
			document.getElementById('res').innerHTML = 'Скачивание и распаковка...';
			setTimeout(function() {
				document.getElementById('progress').value = 0.3;
			}, 1000);
			var xhr = new XMLHttpRequest();
			xhr.open('GET', location.href + '?install=1', true);
			xhr.send();
			xhr.onreadystatechange = function() {
					document.getElementById('progress').value = 0.45;
					document.getElementById('res').innerHTML = `Введите данные MySQL:
					<form>
					<p>host: <input type="text" name="host"></p>
					<p>dbname: <input type="text" name="dbname"></p>
					<p>username: <input type="text" name="username"></p>
					<p>password: <input type="text" name="password"></p>
					<input type="hidden" name="install" value="2">
					<input type="submit">
					</form>`;
			}
		};
	</script>
<?php else: ?>
	<script>
		setInterval(function(){
			content=document.getElementById("fin").innerHTML
			if (content == 7) {
				setTimeout(function() {
					location.href = location.origin;
				}, 700);
				document.getElementById('progress').value = 0.9;
				//location.href = location.origin;
			}
			else document.getElementById('progress').value = 0.75;
		}, 300);
	</script>
<?php endif; ?>
</html>
<?php endif; ?>
<?php

if( isset( $_REQUEST[ 'install' ] ) ) {
	if ($_REQUEST[ 'install' ] == 1) {
		$html = @file_get_contents( 'https://github.com/iissemenow/napopravku/archive/master.zip' );
		file_put_contents( dirname(__FILE__).'/master.zip', $html );
		$zip = new ZipArchive;
		if ( $zip->open( dirname(__FILE__).'/master.zip' ) === TRUE) {
	    	$zip->extractTo( dirname(__FILE__) );
	    	$zip->close();
		} else {
		}
	}
	if ($_REQUEST[ 'install' ] == 2) {
		$data = "<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=".$_REQUEST['host'].";dbname=".$_REQUEST['dbname']."',
    'username' => '".$_REQUEST['username']."',
    'password' => '".$_REQUEST['password']."',
    'charset' => 'utf8',
];
";
		rename(dirname(__FILE__).'/napopravku-master/yii2app', dirname(__FILE__).'/yii2app');
		@file_put_contents(dirname(__FILE__).'/yii2app/config/db.php', $data);
		@unlink('./install.php');
		@unlink('./master.zip');
		$commands = @file_get_contents(dirname(__FILE__).'/napopravku-master/napopravku.sql');
		rename(dirname(__FILE__).'/napopravku-master/.htaccess', dirname(__FILE__).'/.htaccess');

function dirDel ($dir) 
{  
    $d=opendir($dir);  
    while(($entry=readdir($d))!==false) 
    { 
        if ($entry != "." && $entry != "..") 
        { 
            if (is_dir($dir."/".$entry)) 
            {  
                dirDel($dir."/".$entry);  
            } 
            else 
            {  
                unlink ($dir."/".$entry);  
            } 
        } 
    } 
    closedir($d);  
    rmdir ($dir);  
} 

dirDel ('./napopravku-master');

		//@unlink('./napopravku-master');
		$db = new PDO("mysql:host=".$_REQUEST['host'].";dbname=".$_REQUEST['dbname'].";charset=utf8",
			$_REQUEST['username'],
			$_REQUEST['password']);
		try {
    		$db->exec($commands);
		}
		catch (PDOException $e)
		{
    		echo $e->getMessage();
    		//die();
		}
		echo '<div id="fin">7</div>';
	}
}