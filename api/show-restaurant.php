<?php
	header('Content-Type: application/json');
	require_once ("connect.php");

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {

		if (!isset($_GET['id'])) {
			echo json_encode(array(
				"status" => "error"
			));
			exit();
		}

		$restaurants = array();
		$sql = "select * from restaurant where id_res=".$_GET['id'];
		if ($result = $conn->query($sql)) {
			$header = array("status" => "success");
			$body = array();
			while ($row = $result->fetch_object()) {
		        $body = array(
					"id" => $row->id_res,
					"name" => $row->name_res,
					"type" => $row->type_res,
                    "map" => array(
                        "lat" => $row->map_lat,
                        "lng" => $row->map_lon
                    ),
                    "address" => $row->address_res,
					"area" => $row->area_res,
                    "tel" => $row->tel,
                    "content" => $row->content,
					"price" => array(
						"min" => $row->min_price,
						"max" => $row->max_price
					),
                    "score" => array(
                        "atm" => $row->score_atm,
                        "taste" => $row->score_taste,
                        "service" => $row->score_service
                    ),
                    "numVote" => $row->num_vote,
                    "service" => array(
                        "1" => $row->service_1,
                        "2" => $row->service_2,
                        "3" => $row->service_3,
                        "4" => $row->service_4,
                        "5" => $row->service_5
                    ),
					"img" => $row->img,
				);
		    }
			$restaurants = array_merge($header, array("body" => $body));
			echo json_encode($restaurants, JSON_UNESCAPED_UNICODE);
		} else {
			echo json_encode(array(
				"status" => "error"
			));
		}
	} else {
		echo json_encode(array(
			"status" => "error"
		));
	}
?>