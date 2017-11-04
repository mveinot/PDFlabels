<?php

require('label-styles.inc.php');

function decimal_to_fraction($fraction) {
  $base = floor($fraction);
  $fraction -= $base;
  if( $fraction == 0 ) return $base;
  list($ignore, $numerator) = preg_split('/\./', $fraction, 2);
  $denominator = pow(10, strlen($numerator));
  $gcd = gcd($numerator, $denominator);
  $fraction = ($numerator / $gcd) . '/' . ($denominator / $gcd);
  if( $base > 0 ) {
    return $base . '-' . $fraction;
  } else {
    return $fraction;
  }
}

# Borrowed from: http://www.php.net/manual/en/function.gmp-gcd.php#69189
function gcd($a,$b) {
  return ($a % $b) ? gcd($b,$a % $b) : $b;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>PDF Label Generator</title>
		<style type="text/css">
body {
	width: 100%;
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 12pt;
}

#content {
	width: 450px;
	margin: 50px auto;
	background-color: #cfcfcf;
	padding: 10px;
	border-radius: 10px;
}
		</style>
	</head>
	<body>
	<form method="POST" action="labels.php">
	<div id="content">
	<table>
		<tr>
			<td>Names list</td>
			<td>Label style</td>
		</tr>
		<tr>
			<td><textarea name="names_list" rows="30" cols="25"></textarea></td>
			<td valign="top"><select name="style">
<?php
foreach ($styles as $name => $style) {
$count = $style['rows']*$style['columns'];
$height = decimal_to_fraction($style['height']);
$width = decimal_to_fraction($style['width']);
?>
				<option value="<?=$name?>">Avery <?=$name?> (<?=$height?>"x<?=$width?>", <?=$count?> per sheet)</option>
<?php
}
?>
			</select><br />
			<input type="submit" name="submit" value="Generate" />
			</td>
		</tr>
	</table>
	</div>
	</form>
	</body>
</html>
