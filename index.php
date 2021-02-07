<?php
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Headers:*");
	header("Content-type: application/json");

	$json = null;
	foreach($_POST as $post)
		$json = $post;
	
	if($json!=null){
		$json = json_decode($json,true);

		$manager = new MongoDB\Driver\Manager($_ENV['URL_MONGODB']);
		$query = new MongoDB\Driver\Query(['_id'=>'001']);
		$rows = $manager->executeQuery("bot_translator.status",$query);

		$response = null;
		foreach ($rows as $row)
			$response = $row;
		
		$response->running = $json["status"];
		$response->now = $json["normal"];
		$response->success_list = $json["suc_list"];
		$response->fails_list = $json["fail_list"];
		$response->count_success = $json["suc_count"];
		$response->count_fails = $json["fail_count"];

		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update(['_id'=>$response->_id],$response);

		$res = $manager->executeBulkWrite("bot_translator.status",$bulk);

		echo "Success";

	}
	else
		echo "error";
		
?>