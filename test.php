<?php

	function generate_app_id(){
		$tet = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','q','x','y','z','0'
			,'1','2','3','4','5','6','7','8','9');
		$cypher =' ';
		for($i=0;$i<10;$i++)
			$cypher .= $tet[rand(0,35)];

		return $cypher;
	}
	echo generate_app_id();
?>