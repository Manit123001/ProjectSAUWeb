<?php
	$cards = array();
	for ($i = 0; $i < 12; $i++) { //ระบุจำนวนที่ต้องการคือ 12 หลัก
        	$card = mt_rand(1, 50);
        	if(!in_array($card, $cards)){
        		$cards[$i] = $card;
		}else{
			$i--;
		}
		//$cards = array_unique($cards);//สำหรับตัดตัวเลขที่ซ้ำออก
    	}

	$count_arr=count($cards); //นับจำนวนตัวเลขใน Array
	echo $count_arr."<br>";

    	foreach ($cards as $cards) {
		echo $cards.",";
 	}
?>
