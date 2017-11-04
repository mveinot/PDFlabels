<?php

// subclass FPDF to add a header
require('PDF.inc.php');

// import label specifications
require('label-styles.inc.php');

// import subjects
require('subjects.inc.php');

// import miscelaneous string handling utils
require('misc.inc.php');

// retrieve the form data
$style = isset($_REQUEST['style'])?$_REQUEST['style']:'8161';
$names_list = isset($_REQUEST['names_list'])?$_REQUEST['names_list']:'';

// massage the list of names
$names = explode("\n", $names_list);
sort($names);

// create a new PDF object from our subclass
$pdf = new PDF('P','in','Letter');  // P = Portrait, in = units=inches, Letter = letter sized paper (8.5x11)

// import the converted Comic Sans font
$pdf->AddFont('ComicSansMS','','ComicSansMS.php');

// set the page specifications from the label style
$pdf->SetMargins($styles[$style]['margins'],$styles[$style]['top'],$styles[$style]['margins']);
$pdf->AddPage();

// set the font size
$pdf->SetFont('ComicSansMS','',$styles[$style]['font_size']);

// set up the PDF label parameters
$pdf->setStyle($styles[$style]);

// print out just the names first
foreach ($names as $name)
{
	$full_name = normalize_name($name);

	// print the name to the page if it's not empty
	if ($full_name != '')
	{
		$pdf->addCell(array($full_name));
	}
}

// then print out all the subjects with each name
foreach ($subjects as $subject)
{
	foreach ($names as $name)
	{
		$full_name = normalize_name($name);
		$pdf->addCell(array(urldecode($subject), $full_name));
	}
}

// print the PDF to the output
header("Content-type:application/pdf");
$pdf->Output();
?>
