
<?php 

include_once("../classes/its_workstation.php");
include_once("../classes/its_applications.php");
include_once("../classes/its_brandmodel.php");
include_once("../classes/its_mobile.php");
include_once("../classes/its_pcitems.php");


require_once('../assets/tcpdf/tcpdf.php');
session_start();
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(90,110), true, 'UTF-8', false);

$result ='';
$model = '';
$account ='';
$code ='';
$apps = '';

$pcname = $_GET['pcname'];
if(isset($_GET['pcname']))
{
  $pcname = $_GET['pcname'];

  $getrecord = new Its_Workstation();
  $getrecord->getRecord($pcname);
  $user = $getrecord->getDispatchTo();
  $location = $getrecord->getCompany()." ".$getrecord->getDepartment();
  $os = $getrecord->getOperatingSystem();
  $model = $getrecord->getModel();
  $mac = $getrecord->getMACaddress();


  $getpcitemrecord = new Its_PCitems();
  $getpcitemrecord->getPCMonitor($pcname);
  $getpcitemrecord->getPCProcessor($pcname);
  $getpcitemrecord->getPCMemory($pcname);
  $getpcitemrecord->getPCHdd($pcname);
  $getpcitemrecord->getPCKeyboard($pcname);
  $getpcitemrecord->getPCMouse($pcname);

  $serial = $pcname;
  $monitor  = $getpcitemrecord->getMonitor();
  $processor = $getpcitemrecord->getProcessor();
  $memory = $getpcitemrecord-> getMemory();
  $keyboard = $getpcitemrecord->getKeyboard();
  $hd = $getpcitemrecord->getHdd();
  $mouse = $getpcitemrecord->getMouse();

            // $getpcapprecord = Its_Applications::getRecordPCApp($pcname);
            // for($i=0;$i<count($getpcapprecord);$i++)
            // {
            //   $apps .=  "•"." ".$getpcapprecord[$i]->getApps() . " ";

            // }

}


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Computer Checksheet');
$pdf->SetSubject('TCPDF Tutorial');

$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 10, 'Computer Checksheet', '');
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 10));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', 10));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5, 10, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}



$pdf->SetFont('helvetica', 'B', 20);

// $pdf->SetLeftMargin(14);
// $pdf->SetTopMargin(2);
// $pdf->SetFont($fontname, '', '9');
// $pdf->setPrintHeader(false);
// $pdf->SetFooterMargin(0);
// $pdf->setPrintFooter(false);

$pdf->AddPage();
// $pdf->writeHTML($html, true, 0, true, 0);

// add a page
// $pdf->AddPage();
$pdf->SetLineStyle( array( 'width' => 2, 'color' => array(0,0,0)));

$pdf->Line(0,0,$pdf->getPageWidth(),0); 
$pdf->Line($pdf->getPageWidth(),0,$pdf->getPageWidth(),$pdf->getPageHeight());
$pdf->Line(0,$pdf->getPageHeight(),$pdf->getPageWidth(),$pdf->getPageHeight());
$pdf->Line(0,0,0,$pdf->getPageHeight());


$pdf->SetFont('helvetica', '', 7);


 
ob_end_clean();


$table ='';
    
 $current = "";

$sw = '';
$hw = '';
$m = '';
$mmc = '';
$hdd = '';
$proc = '';
$brand ='123';

$date = date('Y-m-d');
// Table with rowspans and THEAD
$tbl = <<<EOD
<table cellpadding="2">
<thead>
 <tr>
    <th><b>PC Name</b></th><td>$serial</td>
 </tr>
 <tr>
    <th><b>User</b></th><td>$user</td>
 </tr>
 <tr>
    <th><b>Location</b></th><td>$location</td>
 </tr>
 <tr>
    <th><b>Model</b></th><td>$model</td>
 </tr>
 <tr>
    <th><b>OS</b></th><td>$os</td>
 </tr>
 <tr>
    <th><b>MAC</b></th><td>$mac</td>
 </tr>
</thead>
<tr>
  <td><b>Hardware</b></td>
</tr>
<tr style="padding-bottom:10px;">
  <td>
     <table border="1" width="260" style="padding:3px;">
        <tr>
            <td><center><b>Monitor</b></center></td>
            <td><center><b>Memory</b></center></td>
            <td><center><b>HDD</b></center></td>
            <td><center><b>Processor</b></center></td>
        </tr>

        <tr>
            <td><center>$monitor</center></td>
            <td><center>$memory</center></td>
            <td><center>$hd</center></td>
            <td><center>$processor</center></td>
        </tr>
     </table>
  </td>
</tr>

<tr>
  <td><b>Application</b></td>
</tr>

<tr>
  <td>
     <table width="260" style="padding-bottom:5px;">
        <tr>
            
             <td><center>$apps</center></td>

        </tr>
       
        <tr>
            <td colspan="2" style="width:65px;"><br><br>____________</td>
            <td colspan="2" style="width:65px;"><br><br>____________</td>
            <td colspan="2" style="width:65px;"><br><br>____________</td>
            <td colspan="2" style="width:65px;"><br><br>____________</td>
        </tr>
     </table>
  </td>
</tr>
 <tr><td></td><td></td></tr>
 <tr><td></td><td></td></tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');


//Close and output PDF document

//============================================================+
// END OF FILE
//============================================================+

$pdf->SetLineStyle( array( 'width' => 2, 'color' => array(0,0,0)));

$pdf->Line(0,0,$pdf->getPageWidth(),0); 
$pdf->Line($pdf->getPageWidth(),0,$pdf->getPageWidth(),$pdf->getPageHeight());
$pdf->Line(0,$pdf->getPageHeight(),$pdf->getPageWidth(),$pdf->getPageHeight());
$pdf->Line(0,0,0,$pdf->getPageHeight());


$pdf->SetFont('helvetica', '', 7);


$table ='';
    
 $current = "";

$sw = '';
$hw = '';
$m = '';
$mmc = '';
$hdd = '';
$proc = '';
$brand ='123';

$date = date('Y-m-d');
// Table with rowspans and THEAD
$tbl = <<<EOD
<table cellpadding="2">
<thead>
 <tr>
    <th><b>PC Name</b></th><td>$serial</td>
 </tr>
 <tr>
    <th><b>User</b></th><td>$user</td>
 </tr>
 <tr>
    <th><b>Location</b></th><td>$location</td>
 </tr>
 <tr>
    <th><b>Model</b></th><td>$model</td>
 </tr>
 <tr>
    <th><b>OS</b></th><td>$os</td>
 </tr>
 <tr>
    <th><b>MAC</b></th><td>$mac</td>
 </tr>
</thead>
<tr>
  <td><b>Hardware</b></td>
</tr>
<tr style="padding-bottom:10px;">
  <td>
     <table border="1" width="260" style="padding:3px;">
        <tr>
            <td><center><b>Monitor</b></center></td>
            <td><center><b>Memory</b></center></td>
            <td><center><b>HDD</b></center></td>
            <td><center><b>Processor</b></center></td>
        </tr>

        <tr>
            <td><center>$monitor</center></td>
            <td><center>$memory</center></td>
            <td><center>$hd</center></td>
            <td><center>$processor</center></td>
        </tr>
     </table>
  </td>
</tr>

<tr>
  <td><b>Application</b></td>
</tr>

<tr>
  <td>
     <table width="260" style="padding-bottom:5px;">
        <tr>
            
             <td><center>$apps</center></td>

        </tr>
       
        <tr>
            <td colspan="2" style="width:65px;"><br><br>____________</td>
            <td colspan="2" style="width:65px;"><br><br>____________</td>
            <td colspan="2" style="width:65px;"><br><br>____________</td>
            <td colspan="2" style="width:65px;"><br><br>____________</td>
        </tr>
     </table>
  </td>
</tr>
 <tr><td></td><td></td></tr>
 <tr><td></td><td></td></tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document



// create new PDF document




$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
// set header and footer fonts

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5,0,5);
$pdf->SetHeaderMargin(20);
$pdf->setFooterMargin(20);


// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 30);



// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$style = array(
    'position' => 'L',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => false,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 0
);

    if(!empty($keyboard))
    {
    $pdf->write1DBarcode($keyboard.'-'.$keyboard, 'C39', '', '', 50, 8, 0.4, $style, 'N');
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Cell(50, 3, $pcname, 0, 1,'C');
    $pdf->Ln();

    $pdf->Ln();
    //$pdf->Line(5, $pdf->getY(), $pdf->getPageWidth()-5, $pdf->getY(), $line);
     }

     if(!empty($monitor)){
      $pdf->write1DBarcode($monitor.'-'.$monitor,'C39','','', 50,8, 0.4,$style, 'N');
      $pdf->SetFont('helvetica','',8);
      $pdf->Cell(50,3,$pcname, 0,1,'C');
      $pdf->Ln();
      $pdf ->Ln();
     }

      if(!empty($mouse)){
      $pdf->write1DBarcode($mouse.'-'.$mouse,'C39','','', 50,8, 0.4,$style, 'N');
      $pdf->SetFont('helvetica','',8);
      $pdf->Cell(50,3,$pcname, 0,1,'C');
      $pdf->Ln();
      $pdf ->Ln();
     }
     if(!empty($processor)){
      $pdf->write1DBarcode($processor.'-'.$processor,'C39','','', 50,8, 0.4,$style, 'N');
      $pdf->SetFont('helvetica','',8);
      $pdf->Cell(50,3,$pcname, 0,1,'C');
      $pdf->Ln();
      $pdf ->Ln();
     }



//Close and output PDF document
$pdf->Output('workstation-tag-'.date('Y-m-d').'.pdf', 'D');












?>


