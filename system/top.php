<?php /**
        Author: SpringHack - springhack@live.cn
        Last modified: 2016-11-07 11:03:05
        Filename: top.php
        Description: Created by SpringHack using vim automatically.
**/ ?>
<?php
	if (!file_exists('.install'))
	{
		header('Location: Install.php');
		die();
	}
	require_once('api.php');
	$db = new MySQL();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Coder List</title>
    </head>
    <body>
    	<center>
        	<?php require_once("header.php"); ?>
        	<h1>Coder List</h1>
		<table border='1'>
            <tr>
                <td width='50'>#</td>
                <td width='200'>User ID</td>
                <td>Quote</td>
                <td width='50'>Accepted</td>
                <td width='50'>Submissions</td>
                <td width='50'>Ratio</td>
            </tr>
    	<?php
			$sstart = isset($_GET['page'])?(intval($_GET['page'])-1)*$Config['CODER_NUMBER_PER_PAGE']:0;
			$list = $db->from('Users')->order('DESC, su ASC', 'ac')->limit($Config['CODER_NUMBER_PER_PAGE'], $sstart)->select()->fetch_all();
			for ($i=0;$i<count($list);++$i)
				echo "<tr><td>".($sstart + $i + 1)."</td><td><a href='person.php?id=".$list[$i]['user']."'>".unserialize($list[$i]['json'])['nick']."</a></td><td>".unserialize($list[$i]['json'])['quote']."</td><td>".$list[$i]['ac']."</td><td>".$list[$i]['su']."</td><td>".intval($list[$i]['ac']*100/$list[$i]['su'])."%</td></tr>";
			echo "</table>";
		?><br /><br />
		<script language="javascript" src="Widget/pageSwitcher/pageSwitcher.js"></script>
		<br /><br />
        </center>
    </body>
</html>
