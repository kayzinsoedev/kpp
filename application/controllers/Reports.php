<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    private function _throwJSONOutput($resultValue, $outputData = NULL, $outputName = 'data')
    {
        $this->output->set_content_type('application/json');
        $messageArray = $outputData;
        die( json_encode(array("result" => $resultValue, $outputName => $messageArray)) );
    }

    public function index()
    {
        $this->load->view('reports_generate');
    }


    public function refactor()
    {
        /*
         * Change delivery_date to datetime
         */
        //$this->load->model('set_reports_model');
        //$reports = $this->set_reports_model->get();
        //
        //foreach($reports as $report) {
        //    $delivery_date = date("Y-m-d H:i:s", strtotime( str_replace("-","",$report['delivery_date']) ) );
        //
        //    $this->set_reports_model->update(array(
        //        'delivery_date' => $delivery_date
        //    ), $report['id']);
        //    echo $report['id']."<br />";
        //}
        //echo "<pre>";
        //print_r(json_encode($reports));

        /*
         * Copy All Data From Orders
         */
        //$this->load->model('get_orders_model');
        //$this->load->model('get_users_model');
        //$this->load->model('set_reports_model');
        //$orders = $this->get_orders_model->get();
        //
        //foreach($orders as $job) {
        //    $requester_details = $this->get_users_model->get($job['user_id']);
        //    $files = unserialize($job['files']);
        //
        //    foreach($files as $file) {
        //        $order_data = array(
        //            'oc_number'             => $job['prefix']."-".$job['id'],
        //            'po_number'             => ( empty($job['po_number']) ) ?'-' : $job['po_number'],
        //            'file_name'             => ( isset($file['file_name']) ) ? $file['file_name'] : '-',
        //            'user_id'               => $job['user_id'],
        //            'requester'             => $job['name'],
        //            'department'            => $requester_details[0]['department'],
        //            'module'                => ( empty($job['module']) ) ? '-' : $job['module'],
        //            'intake'                => ( empty($job['intake']) ) ? '-' : $job['intake'],
        //            'order_date'            => $job['order_date'],
        //            'delivery_date'         => $job['delivery_date'],
        //            'delivery_location'     => $job['delivery_location'],
        //            'quantity'              => ( empty($file['quantity']) )? 0 : $file['quantity'],
        //            'content_pp'            => ( empty($file['content_pp']) )? 0 : $file['content_pp'],
        //            'cover_included'        => ( isset($file['cover_included']) && $file['cover_included'] == 'yes' )? 1:0,
        //            'cover_wire_bind'       => ($file['finishing'] == 'Wire Bind')? 1:0,
        //            'cover_ring_bind'       => ($file['finishing'] == 'Ring Bind (P-C)' || $file['finishing'] == 'Ring Bind')? 1:0,
        //            'cover_perfect_bind'    => ($file['finishing'] == 'Book Bind (P-B)' || $file['finishing'] == 'Book Bind')? 1:0,
        //            'handouts_quantity'     => ( empty($file['handouts_quantity']) )? 0 : $file['handouts_quantity'],
        //            'handouts_pp'           => ( empty($file['handouts_pp']) )? 0 : $file['handouts_pp'],
        //        );
        //
        //        $id = $this->set_reports_model->insert($order_data);
        //        echo $id."<br/>";
        //    }
        //
        //}

    }

    public function generate()
    {
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $entity = $this->input->post('entity');
        $division = $this->input->post('division');

        $data = array();
        $data['MONTH(delivery_date)'] = $month;
        $data['YEAR(delivery_date)'] = $year;

        if( $entity != "All" ) {
            $data['entity'] =  $entity;
        }

        if( $division != "All" ) {
            $data['division'] = $division;
        }

        $this->load->model('set_reports_model');
        $reports = $this->set_reports_model->get($data);

        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->setTitle("$entity - $division");

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'JCS Monthly Report (KAPLAN)');
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);

        $month = DateTime::createFromFormat('!m', $month)->format('F');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', "Printing for the month of $month $year for Entity $entity & Division $division");
        $objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
        $objPHPExcel->getActiveSheet()->getStyle("A2:H2")->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle("A2:H2")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(-1);

        $objPHPExcel->getActiveSheet()->SetCellValue('A4', "Date:");
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', date('d M Y'));
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', "Attn:");
        $objPHPExcel->getActiveSheet()->SetCellValue('B5', "Accounts Payable");

        $objPHPExcel->getActiveSheet()->SetCellValue('A7', "Delivery Locations");
        $objPHPExcel->getActiveSheet()->mergeCells('A7:B7');

        $objPHPExcel->getActiveSheet()->SetCellValue('A8', "Pomo:");
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', "A");
        $objPHPExcel->getActiveSheet()->SetCellValue('A9', "Wilkie Egde:");
        $objPHPExcel->getActiveSheet()->SetCellValue('B9', "B");
        $objPHPExcel->getActiveSheet()->SetCellValue('A10', "J.East:");
        $objPHPExcel->getActiveSheet()->SetCellValue('B10', "C");
        $objPHPExcel->getActiveSheet()->SetCellValue('A11', "3rd Party:");
        $objPHPExcel->getActiveSheet()->SetCellValue('B11', "D");

        $objPHPExcel->getActiveSheet()->SetCellValue('L13', "Book");
        $objPHPExcel->getActiveSheet()->mergeCells('L13:P13');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q13', "Handouts");
        $objPHPExcel->getActiveSheet()->mergeCells('Q13:S13');

        $objPHPExcel->getActiveSheet()->SetCellValue('M14', "0.0126");
        $objPHPExcel->getActiveSheet()->SetCellValue('N14', "0.90");
        $objPHPExcel->getActiveSheet()->SetCellValue('O14', "0.90");
        $objPHPExcel->getActiveSheet()->SetCellValue('P14', "0.60");
        $objPHPExcel->getActiveSheet()->SetCellValue('S14', "0.0126");

        $objPHPExcel->getActiveSheet()->SetCellValue('A15', 'OC Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('B15', 'PO Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C15', 'Requester');
        $objPHPExcel->getActiveSheet()->SetCellValue('D15', 'Department');
        $objPHPExcel->getActiveSheet()->SetCellValue('E15', 'Intake');
        $objPHPExcel->getActiveSheet()->SetCellValue('F15', 'Module');
        $objPHPExcel->getActiveSheet()->SetCellValue('G15', 'Description');
        $objPHPExcel->getActiveSheet()->SetCellValue('H15', 'Order Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('I15', 'Delivery Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('J15', 'Delivery Location');
        $objPHPExcel->getActiveSheet()->SetCellValue('K15', 'Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('L15', 'Text (PP)');
        $objPHPExcel->getActiveSheet()->SetCellValue('M15', 'Text (S$)');
        $objPHPExcel->getActiveSheet()->SetCellValue('N15', 'Cover + Wire Bind (S$)');
        $objPHPExcel->getActiveSheet()->SetCellValue('P15', 'Cover + Perfect Bind (S$)');
        $objPHPExcel->getActiveSheet()->SetCellValue('O15', 'Cover + Ring Bind (S$)');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q15', 'Handouts Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('R15', 'Handouts (PP)');
        $objPHPExcel->getActiveSheet()->SetCellValue('S15', 'Handouts (S$)');
        $objPHPExcel->getActiveSheet()->SetCellValue('T15', 'Total');

        $objPHPExcel->getActiveSheet()->getStyle("A15:T15")->getFont()->setBold(true);

        $rowCount = 16;
        foreach($reports as $report) {

            if($report['cover_wire_bind'] == 1) {
                if($report['cover_included'] == 1) {
                    $report['content_pp'] = $report['content_pp'] - 2;
                }
            }

            if($report['cover_perfect_bind'] == 1) {
                if($report['cover_included'] == 1) {
                    $report['content_pp'] = $report['content_pp'] - 1;
                }
            }

            if($report['delivery_location'] == "KAPLAN Pomo Campus, 1 Selegie Road, Level 7 (S) 188306.") { $report['delivery_location'] = 'A'; }
            if($report['delivery_location'] == "KAPLAN City Campus, 8 Wilkie Road, Wilkie Edge (S) 228095.") { $report['delivery_location'] = 'B'; }
            if($report['delivery_location'] == "KAPLAN Jurong East") { $report['delivery_location'] = 'C'; }
            if($report['delivery_location'] == "3rd Party") { $report['delivery_location'] = 'D'; }

            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $report['oc_number']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, ( empty($report['po_number']) )?'-':$report['po_number'] );
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $report['requester']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $report['department']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $report['intake']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $report['module']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $report['file_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $report['order_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $report['delivery_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $report['delivery_location']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, ( empty($report['quantity']) )?0:$report['quantity'] );
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, ( empty($report['content_pp']) )?0:$report['content_pp'] );
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, '=K'.$rowCount.'*L'.$rowCount.'*M14'); //Content
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, ($report['cover_wire_bind'] == 1)?'=K'.$rowCount.'*(N14)':'0'); //WireBind
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, ($report['cover_ring_bind'] == 1)?'=K'.$rowCount.'*(O14)':'0'); //RingBind
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, ($report['cover_perfect_bind'] == 1)?'=K'.$rowCount.'*(P14)':'0'); //PerfectBind
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, ( empty($report['handouts_quantity']) )?0:$report['handouts_quantity'] );
            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, ( empty($report['handouts_pp']) )?0:$report['handouts_pp'] );
            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, '=Q'.$rowCount.'*R'.$rowCount.'*S14');
            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, '=M'.$rowCount.'+N'.$rowCount.'+O'.$rowCount.'+P'.$rowCount.'+S'.$rowCount);

            $rowCount++;
        }

        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, "=SUM(T16:T".--$rowCount.")");
        $objPHPExcel->getActiveSheet()->getStyle('T'.++$rowCount)->getFont()->setBold(true);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="KAPLANReport-'.$entity."_".$division.'-'.$month.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save("php://output");


    }


}