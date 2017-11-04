<?php

require('fpdf/fpdf.php');

class PDF extends FPDF
{
	private $params = array();

	function setStyle($_style)
	{
		$this->params = $_style;
	}

	function Header()
	{
		global $style, $styles;
		$this->SetFont('Helvetica','',8);
		$this->SetXY(0,0);
		$this->Cell(0,0.5,"Avery $style",0,0,'C');
		$this->SetXY($styles[$style]['margins'],$styles[$style]['top']);
	}

	function addCell($text)
	{
        	static $col_count = 0;
        	static $row_count = 0;
        	static $adv = 0;
        	static $new_page = 0;
        	static $page_x = 0;
        	static $page_y = 0;

        	// save the current page position
        	$page_x = $this->GetX();
        	$page_y = $this->GetY();

        	// determine if we're at the last column and need a new line
        	if ($col_count == ($this->params['columns'] - 1))
        	{
                	$adv = 0;
        	} else
        	{
                	$adv = 1;
        	}

        	// determine if we're at the last row and need a new page
        	if ($row_count == ($this->params['rows'] - 2))
        	{
                	$new_page = 1;
        	} else
        	{
                	$new_page = 0;
        	}

        	// format output for one or two rows of text
        	if (count($text) == 1)
        	{
                	$height = $this->params['height'];
                	$cell_text = $text[0];
        	} else {
                	$height = ($this->params['height']/2);
                	$cell_text = "$text[0]\n$text[1]";
        	}

        	// output the cell content
        	$this->MultiCell($this->params['width'],$height,$cell_text,0,'C');

        	// advance to the next column or next line
        	if ($adv)
        	{
                	$col_count++;
                	$this->SetXY($page_x + ($this->params['width']+$this->params['h_space']), $page_y);
        	} else
        	{
                	$this->Ln(0);
                	$col_count = 0;
                	$row_count++;
        	}

        	// add a new page if required
        	if ($new_page && !$adv)
        	{
                	$this->AddPage();
                	$row_count = 0;
        	}
	}
}

?>
