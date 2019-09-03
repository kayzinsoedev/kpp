<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }

    function index() {

        $this->load->library('GetPDF');
        $pdf = new GetPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetMargins(0, 0, 0, false);
        $pdf->setHeaderMargin(0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator('JCS Digital Solutions');
        $pdf->SetAuthor('JCS Digital Solutions');
        $pdf->SetTitle('INSEAD Name Card');
        $pdf->SetSubject('INSEAD Name Card');
        $pdf->SetKeywords('INSEAD');
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $l = ''; // To hide error inside IDE
        if (@file_exists(FCPATH .'libraries/tcpdf/lang/eng.php')) {
            require_once(FCPATH .'libraries/tcpdf/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pageSize = array(55, 85);
        $pdf->setPageUnit("mm");

        // Front Page
        $pdf->AddPage('L', $pageSize, false, false);
        $pdf->SetAutoPageBreak(false, 0);

        $pdf->setFontSubsetting(true);
        $fontFile = FCPATH . "public/fonts/name-card/Rockwell2.ttf";

        $rockwell = TCPDF_FONTS::addTTFfont($fontFile, 'TrueTypeUnicode');
        $pdf->SetFont($rockwell, '', 13);

        // Insead Logo
        $inseadLogo = FCPATH . "public/images/insead/inseadLogo.png";
        $pdf->Image($inseadLogo, 5, 5, 24.87, 13.31);

        // QR Code
        $name = 'Mathieu Bèland';
        $phone = '+65 9896 8472';
        $email = 'mathieu.beland@insead.edu';

        // we building raw data
        $codeContents  = 'BEGIN:VCARD'."\n";
        $codeContents .= 'FN:'.$name."\n";
        $codeContents .= 'TEL;WORK;VOICE:'.$phone."\n";
        $codeContents .= 'EMAIL:'.$email."\n";
        $codeContents .= 'END:VCARD';

        $style = array(
            'border' => FALSE,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

        $pdf->write2DBarcode("\xEF\xBB\xBF".$codeContents, 'QRCODE,L', $x = '60', $y = '3', $w = '20', $h = '20', $style = '', $align = 'T', $distort = false);

        // Student Name
        $pdf->SetTextColor(100, 30, 92, 47);
        $pdf->SetFontSize(13);
        $pdf->MultiCell( 0, 0, 'VAIBHAV SIDAPARA', $border = 0, $align = 'L', $fill = false, $ln = 1, $x = '17.65', $y = '23.24', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'T', $fitcell = false);

        // Student Details
        $pdf->SetTextColor(0, 4, 3, 59);
        $pdf->SetFontSize(8);
        $pdf->MultiCell( 0, 0, 'MBA Participant', $border = 0, $align = 'L', $fill = false, $ln = 1, $x = '17.65', $y = '28.56', $reseth = true, $stretch = 0, $ishtml = true, $autopadding = false, $maxh = 0, $valign = 'T', $fitcell = false);
        $pdf->MultiCell( 0, 0, 'Class of December 2017', $border = 0, $align = 'L', $fill = false, $ln = 1, $x = '17.65', $y = '31.91', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'T', $fitcell = false);

        $pdf->MultiCell( 0, 0, 'MBA Programme', $border = 0, $align = 'L', $fill = false, $ln = 1, $x = '5', $y = '40.49', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'T', $fitcell = false);
        $pdf->MultiCell( 0, 0, 'Mobile: 97735024', $border = 0, $align = 'L', $fill = false, $ln = 1, $x = '5', $y = '43.87', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'T', $fitcell = false);
        $pdf->MultiCell( 0, 0, '2nd Mobile: 97735024', $border = 0, $align = 'L', $fill = false, $ln = 1, $x = '37.55', $y = '43.87', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'T', $fitcell = false);
        $pdf->MultiCell( 0, 0, 'Email: vaibhav.sidapara@insead.edu', $border = 0, $align = 'L', $fill = false, $ln = 1, $x = '5', $y = '47.29', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = false, $maxh = 0, $valign = 'T', $fitcell = false);

        //Back Page
        $pdf->AddPage('L', $pageSize, false, false);
        $pdf->SetAutoPageBreak(false, 0);

        $pdf->Rect(0, 0, 85.00, 55.00, 'F', array(), array(100, 30, 92, 47));
        $inseadBackPage = FCPATH . "public/images/insead/backPageText.png";
        $pdf->Image($inseadBackPage, 0, 0, 85.00, 55.00);

        $pdfFile = $pdf->Output('JCS.pdf', 'S');

        $data = array(
            'type' => 'application/pdf',
            'file' => $pdfFile,
        );

        $this->load->view('file_view', $data);

    }

    function test() {
        $this->load->view('file_view');
    }

}