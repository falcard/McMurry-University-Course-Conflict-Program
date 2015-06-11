<?php

	// make data directory
	$currentDIR = getcwd();
	@mkdir($currentDIR ."/data", 0777);
	
  	// retrieve department info from file
	if (($handle_1 = fopen("depts.csv", "r")) !== FALSE) {
		$nn = 0;
		while (($data_1 = fgetcsv($handle_1, 1000, ",")) !== FALSE) {
			$c = count($data_1);
			for ($x = 0; $x < $c; $x++)
			{
				$deptsArray[$nn][$x] = $data_1[$x];
			}
			$nn++;
		}
		fclose($handle_1);
	}
	// length of class array
	$deptsLength = count($deptsArray);
	
	// retrieve class info from file
	if (($handle_2 = fopen("classlist.csv", "r")) !== FALSE) {
		$nn = 0;
		while (($data_2 = fgetcsv($handle_2, 1000, ",")) !== FALSE) {
			$c = count($data_2);
			for ($x = 0; $x < $c; $x++)
			{
				$dataArray[$nn][$x] = $data_2[$x];
			}
			$nn++;
		}
		fclose($handle_2);
	}
	// length of data array
	$dataLength = count($dataArray);

	// populate arrays 
	for ($i=0; $i<$dataLength; $i++) {
		$idArray[$i] = $dataArray[$i][1];
		$deptArray[$i] = $dataArray[$i][2];
		$classArray[$i] = $dataArray[$i][3];
		$codeArray[$i] = $dataArray[$i][4];
		$daysArray[$i] = $dataArray[$i][5];
		$startArray[$i] = $dataArray[$i][6];
		$endArray[$i] = $dataArray[$i][7];
	}
	
	// length of dept array
	$deptarrLength = count($deptArray);
	
	// populate all department strings 
	for ($i = 0; $i < $deptsLength; $i++) {
		$file_GEN = fopen('data/'.$deptsArray[$i][1].'.txt', "w") or die("Unable to open file!");
		$firstString = "<option value=\"0\" selected>-- Choose --</option>" . PHP_EOL;
		fwrite($file_GEN, $firstString);
		for ($j = 0, $k = 1; $j<$deptarrLength; $j++) {
			if ($dataArray[$j][0] == $deptsArray[$i][0] ) {
				$classString = (string)$classArray[$j];
				$arr = array('<option value="', ($k), '">', $classString, '</option>');
				$finalString = implode("", $arr);
				fwrite($file_GEN, $finalString.PHP_EOL);
				$k++;
			}
		}
	}
?>