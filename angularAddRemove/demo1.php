<?php
	$type = $_GET["type"];

	if (isset($type)) {//存在未true
		if ($type == "checkbooks") {
			$flag = true;
			$json = file_get_contents("books.json");//获取books.json里的数据，json格式
			$arr_json = json_decode($json,true);//将json格式的数据转化为数组类型的数据
			echo json_encode($arr_json);
		}

		if ( $type == "addbooks") {
			$flag =true;
			$id =$_GET['id'];
			$bookname = $_GET["bookname"];
			$authorname = $_GET["authorname"];
			$array = array("id" => $id,"book" => $bookname,"author" => $authorname );
			$json = file_get_contents("books.json");
			$arr_json = json_decode($json,true);
			array_push($arr_json,$array);
			$json = json_encode($arr_json);
			file_put_contents("books.json",$json);
			echo json_encode($arr_json);

		}

		if ($type == "delete") {
			$bookname = $_GET["bookname"];
			$flag = "";
			$json =file_get_contents("books.json");
			$arr_json = json_decode($json,true);
			for ($i=0; $i <count($arr_json) ; $i++) { 
				if ($arr_json[$i]["book"] == $bookname) {
					array_splice($arr_json,$i ,1);//删除后台数据
					$flag = true;
					$json = json_encode($arr_json);
					file_put_contents("books.json",$json);
					echo json_encode($arr_json);

				}
			}
		}
		if ($type == "modify") {
			$flag =true;
			$id =$_GET['id'];
			$bookname = $_GET["bookname"];
			$authorname = $_GET["authorname"];
			$json =file_get_contents("books.json");
			$arr_json = json_decode($json,true);
			for ($i=0; $i <count($arr_json) ; $i++) { 
				if ($arr_json[$i]["id"] == $id) {
					$arr_json[$i]["book"] = $bookname;
					$arr_json[$i]["author"] = $authorname;
					$json = json_encode($arr_json);
					file_put_contents("books.json",$json);
					echo json_encode($arr_json);

				}
			}
		}
	}