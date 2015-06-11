<?php
	
	require 'data-maker.php';
	
	// create variables to collect the data
	$department = $_POST['department'];
	$course	= $_POST['classID'];
	
	// get location of POST variable classID
	for ($i = 0; $i < $dataLength; $i++)
	{
		if ($dataArray[$i][2] == $department and $dataArray[$i][1] == $course)
		{
			$courseNAME = $dataArray[$i][3];
		}
	}
	
	// print to screen users input
	echo "Department: ";
	echo strtoupper($department);
	echo "<br />";
	echo "Course: ";
	echo strtoupper($courseNAME);
	echo "<br />";

	
	// check if scheduled days conflict
	for ($i = 0; $i < $dataLength; $i++) 
	{
		if ($dataArray[$i][2] == $department and $dataArray[$i][1] == $course)
		{
			echo "Days: ";
			echo strtoupper($dataArray[$i][5]);
			echo "<br />";
			$selectedDays = $dataArray[$i][5]; // save days into a variable for iteration
			
			echo "Start time: ";
			echo strtoupper($dataArray[$i][6]);
			echo "<br />";
			$selectedStartTime = DateTime::createFromFormat('H:i', $dataArray[$i][6]);
			
			echo "End Time: ";
			echo strtoupper($dataArray[$i][7]);
			echo "<br />";
			$selectedEndTime = DateTime::createFromFormat('H:i', $dataArray[$i][7]);
		};
	};	
	
	// change days variable from string to array and then to individual characters
	$selectedDays = str_split($selectedDays);
	
	$dayONE = @$selectedDays[0];
	$dayTWO = @$selectedDays[1];
	$dayTHREE = @$selectedDays[2];
	$dayFOUR = @$selectedDays[3];
	$dayFIVE = @$selectedDays[4];
	
	// convert times to useful form

	
	echo "<h2>Results:</h2>";
	// build table
	echo "<table border=1>
	<tr>
	<th>Department</th>
	<th>Course ID</th>
	<th>Title</th>
	<th>Days</th>
	<th>Start Time</th>
	<th>End Time</th>
	</tr>";
	
	// for loop to check for conflicts for days
	for ($i = 0; $i < $dataLength; $i++)
	{
		$dayTest = ($dataArray[$i][5]);
		
		$checkStartTime = DateTime::createFromFormat('H:i', $dataArray[$i][6]);
		$checkEndTime = DateTime::createFromFormat('H:i', $dataArray[$i][7]);
		
		if ((strpos($dayTest, $dayONE) !== false or strpos($dayTest, $dayTWO) !== false or strpos($dayTest, $dayTHREE) !== false or strpos($dayTest, $dayFOUR) !== false or strpos($dayTest, $dayFIVE) !== false) and ($dataArray[$i][5] != "TBA"))
		{
			if (((($selectedStartTime >= $checkStartTime) and ($selectedStartTime <= $checkEndTime)) or ($selectedEndTime <= $checkStartTime and $selectedEndTime >= $checkEndTime)) and ($dataArray[$i][6] != "TBA"))
			{
				echo "<tr>";
				echo "<td>" . $dataArray[$i][2] . "</td>";
				echo "<td>" . $dataArray[$i][3] . "</td>";
				echo "<td>" . $dataArray[$i][4] . "</td>";
				echo "<td>" . $dataArray[$i][5] . "</td>";
				echo "<td>" . $dataArray[$i][6] . "</td>";
				echo "<td>" . $dataArray[$i][7] . "</td>";
				echo "</tr>";			
			}
		}		
	}
	echo "</table>";
	
			
?>