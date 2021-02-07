<?php
	
		
	$manager = new MongoDB\Driver\Manager("mongodb+srv://bot:Hv11NXFH6zpf2h6M@pds.twdrk.mongodb.net/bot_translator?retryWrites=true&w=majority");
	$query = new MongoDB\Driver\Query(['_id'=>'001']);
	$rows = $manager->executeQuery("bot_translator.status",$query);

	$res = null;
	foreach($rows as $row)
	{
		$res = $row;
	}

	echo $res->_id;
		
?>