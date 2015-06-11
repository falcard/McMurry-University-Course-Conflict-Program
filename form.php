<?php require('data-maker.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>McMurry Course Conflict</title>
</head>

<body>
<h1>McMurry Course Conflict Menu</h1>
<form id="conflict" name="conflict" method="post">
  <p>
  <?php
  	// retrieve department info from file
	if (($handle = fopen("depts.csv", "r")) !== FALSE) {
		$nn = 0;
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$c = count($data);
			for ($x = 0; $x < $c; $x++)
			{
				$deptsArray[$nn][$x] = $data[$x];
			}
			$nn++;
		}
		fclose($handle);
	}
	// length of class array
	$deptsLength = count($deptsArray);
	?>
	
	<label for="department">Department:</label>
	<select name="department" id="department">
		<option value="0" selected>-- Choose --</option>	
    <?php
	for($i = 0; $i < $deptsLength; $i++) {
		echo '<option value="' .
		$deptsArray[$i][1] .
		'">' .
		$deptsArray[$i][1] . 
		'</option>'.
		"\n";
	}	 
	?>  
	</select>
  </p>
  <p>
  	<label for="classID">Class:</label>
    <select name="classID" disabled id="classID">
    	<option value ="0">-- Choose --</option>
    </select>
  </p>
  <p>
    <input type="submit" name="submit" id="submit" value="Submit">
  </p>

	<?php
        if (isset($_POST['submit'])){
            include 'parse.php';
        }
    ?>    
</form>
<script type="text/javascript" src="scripts/jquery-1.11.3.min.js">
</script>
<script>
$(function() {
	var classID = $('#classID');
	
	$('#department').change(function(e) {
		var sel = $(this).val();
		classID.html('');
		if (sel != '0') {
			$.get('data/' + sel + '.txt', function(response) {
				classID.html(response);
				classID.removeAttr('disabled');
				$('option[value="0"]', e.target).remove();
			});
		}
	});
	
	classID.change(function(e) {
		if ($(this).val() != '0') {
			$('option[value="0"]', e.target).remove();
		}
	});
});
</script>
</body>
</html>

