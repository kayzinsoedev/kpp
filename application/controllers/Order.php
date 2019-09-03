<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // $staff = $this->session->userdata('staff');
        // if(!$staff) {
        //     redirect( base_url('/'), 'location');
        // }
    }

    private function _throwJSONOutput($resultValue, $outputData = NULL, $outputName = 'data')
    {
        $this->output->set_content_type('application/json');
        $messageArray = $outputData;
        die( json_encode(array("result" => $resultValue, $outputName => $messageArray)) );
    }

    public function index($order_id)
    {
        $this->load->model('get_orders_model');
        $job = $this->get_orders_model->orderByID($order_id);

        $source = FCPATH."files/".$job->job_session_id;
        $destination = FCPATH."files/".$job->job_session_id."/".$order_id.".zip";
        if ( $this->_zip($source, $destination, FALSE) ) {
             // $this->load->library('zip');
             // $path = base_url()."files/".$job->job_session_id
             // $this->zip->read_dir($path,FALSE);
             //
             // // Download the file to your desktop. Name it "my_backup.zip"
             // $this->zip->download('my_backup.zip');
            $data['destination'] = base_url()."files/".$job->job_session_id."/".$order_id.".zip";
        }
        $data['job'] = $job;

        $this->load->view('order_job_sheet', $data);
    }

    public function old_order($order_id = NULL)
    {
        $this->load->model('get_old_orders_model');
        $job = $this->get_old_orders_model->orderByID($order_id);

        $source = FCPATH."files/".$job->job_session_id;
        $destination = FCPATH."files/".$job->job_session_id."/".$order_id.".zip";
        if ( $this->_zip($source, $destination, FALSE) ) {
            $data['destination'] = base_url()."files/".$job->job_session_id."/".$order_id.".zip";
        }

        $data['job'] = $job;
        $this->load->view('order_job_sheet', $data);
    }

    public function user()
    {
        $this->load->model('get_orders_model');
        $data['orders'] = $this->get_orders_model->get(array('user_id'=>$this->session->userdata('user_id')));

        $this->load->view('order_history', $data);
    }

    public function all()
    {
        $this->load->model('get_orders_model');
        $data['orders'] = $this->get_orders_model->get();

        $this->load->view('all_orders', $data);
    }

    public function old()
    {
        $this->load->model('get_old_orders_model');
        $data['orders'] = $this->get_old_orders_model->get();

        $this->load->view('all_old_orders', $data);
    }

    public function review()
    {
        $data['session'] = $this->session->all_userdata();
        $this->load->view('order_review', $data);
    }

    public function order_submit()
    {
        $delivery_date = $this->session->userdata('delivery_date');
        $order_data = array(
            'user_id'                       => $this->session->userdata('user_id'),
            'name'                          => $this->session->userdata('name'),
            'email'                         => $this->session->userdata('email'),
            'contact'                       => $this->session->userdata('contact'),
            'po_number'                     => $this->session->userdata('po_number'),
            'entity'                        => $this->session->userdata('entity'),
            'division'                      => $this->session->userdata('division'),
            'intake'                        => $this->session->userdata('intake'),
            'module'                        => $this->session->userdata('module'),
            'job_name'                      => $this->session->userdata('job_name'),
            'attention_to'                  => $this->session->userdata('attention_to'),
            'delivery_date'                 => date("Y-m-d H:i:s", strtotime( str_replace("-","",$delivery_date) ) ),
            'delivery_location'             => $this->session->userdata('delivery_location'),
            'delivery_location_secondary'   => $this->session->userdata('delivery_location_secondary'),
            'job_session_id'                => $this->session->userdata('job_session_id'),
            'counter'                       => $this->session->userdata('counter'),
            'files'                         => serialize( $this->session->userdata('files') ),
            'order_date'                    => date('Y-m-d H:i:s'),
        );

        $this->load->model('set_orders_model');
        $insert_id = $this->set_orders_model->insert($order_data);

        if( is_int($insert_id) ) {

            foreach($this->session->userdata('files') as $file) {
                $report_data = array(
                    'oc_number'             => "04-".sprintf('%06d', $insert_id),
                    'po_number'             => ( empty($order_data['po_number']) ) ?'-' : $order_data['po_number'],
                    'file_name'             => ( isset($file['file_name']) ) ? $file['file_name'] : '-',
                    'user_id'               => $this->session->userdata('user_id'),
                    'requester'             => $this->session->userdata('name'),
                    'department'            => $this->session->userdata('department'),
                    'entity'                => $this->session->userdata('entity'),
                    'division'              => $this->session->userdata('division'),
                    'module'                => ( empty($order_data['module']) ) ? '-' : $order_data['module'],
                    'intake'                => ( empty($order_data['intake']) ) ? '-' : $order_data['intake'],
                    'order_date'            => $order_data['order_date'],
                    'delivery_date'         => $order_data['delivery_date'],
                    'delivery_location'     => $order_data['delivery_location'],
                    'quantity'              => ( empty($file['quantity']) )? 0 : $file['quantity'],
                    'content_pp'            => ( empty($file['content_pp']) )? 0 : $file['content_pp'],
                    'cover_included'        => ( isset($file['cover_included']) && $file['cover_included'] == 'yes' )? 1:0,
                    'cover_wire_bind'       => ($file['finishing'] == 'Wire Bind')? 1:0,
                    'cover_ring_bind'       => ($file['finishing'] == 'Ring Bind (P-C)' || $file['finishing'] == 'Ring Bind')? 1:0,
                    'cover_perfect_bind'    => ($file['finishing'] == 'Book Bind (P-B)' || $file['finishing'] == 'Book Bind')? 1:0,
                    'handouts_quantity'     => ( empty($file['handouts_quantity']) )? 0 : $file['handouts_quantity'],
                    'handouts_pp'           => ( empty($file['handouts_pp']) )? 0 : $file['handouts_pp'],
                );

                $this->load->model('set_reports_model');
                $id = $this->set_reports_model->insert($report_data);
            }

            $this->load->library('email');
            $mailConfig['mailpath'] = "/usr/lib/sendmail";
            $mailConfig['protocol'] = "smtp";
            // $mailConfig['smtp_host'] = "smtpout.secureserver.net";
            $mailConfig['smtp_host'] = "email-smtp.us-east-1.amazonaws.com";
            // $mailConfig['smtp_user'] = "do-not-reply@zapsw.com";
            $mailConfig['smtp_user'] = "AKIAIXYCRJJBSOG3JVGQ";
            // $mailConfig['smtp_pass'] = "Z@psw12345";
            $mailConfig['smtp_pass'] = "AnkGPsY59Ut9kaS3o19h+5lkJmt02IpvsovEdeORJp+e";
            // $mailConfig['smtp_port'] = "80";
            $mailConfig['smtp_port'] = "587";
            $mailConfig['mailtype'] = "html";
            $mailConfig['smtp_crypto'] = "ssl";
            $mailConfig['charset'] = 'utf-8';
            $mailConfig['newline'] = "\r\n";
            $mailConfig['validate'] = "TRUE";
            $this->email->initialize($mailConfig);
            $this->email->set_crlf( "\r\n" );

            $this->email->from('do-not-reply@zapsw.com', 'KAPLAN Print Order Portal');
            $this->email->to($this->session->userdata('email'));
            // $this->email->cc('kaplan@timesprinters.com,');
            $this->email->subject('KAPLAN Print Order NO: '.$insert_id);

            $data['session']    = $this->session->all_userdata();
            $data['order_id']   = $insert_id;
            $string = $this->load->view('email', $data, TRUE);
            $this->email->message($string);

            $this->email->send();
            //echo $this->email->print_debugger();
            $this->_throwJSONOutput(1, 'Submitted Successfully', 'success');
        }

    }

    private function _zip($source, $destination, $include_dir = FALSE)
    {

        if (!extension_loaded('zip') || !file_exists($source)) {
            return FALSE;
        }

        if (file_exists($destination)) {
            return TRUE;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));
        if (is_dir($source) === TRUE) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::CHILD_FIRST);
            if ($include_dir) {
                $arr = explode("/",$source);
                $maindir = $arr[count($arr)- 1];

                $source = "";
                for ($i=0; $i < count($arr) - 1; $i++) {
                    $source .= '/' . $arr[$i];
                }

                $source = substr($source, 1);

                $zip->addEmptyDir($maindir);
            }

            foreach ($files as $file)
            {
                $file = str_replace('\\', '/', $file);
                // Ignore "." and ".." folders
                if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

                // $file = realpath($file);
                if (is_dir($file) === true)
                {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                }
                else if (is_file($file) === true)
                {
                    // Get real and relative path for current file
                    // $path =str_replace('\\', '/', realpath($source));
                    // // $filePath = realpath($file);
                    // $relativePath = substr($file, strlen($path) + 1);
                    // // Add current file to archive
                    // $zip->addFile($file, $relativePath);

                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }
        else if (is_file($source) === true)
        {
            $zip->addFromString(basename($source), file_get_contents($source));
        }


        return $zip->close();
    }

    public function duplicate($order_id)
    {
        $this->load->model('get_orders_model');
        $job = $this->get_orders_model->orderByID($order_id);
        $source = FCPATH."files/".$job->job_session_id."/";
        $new_job_session_id = uniqid();
        $destination = FCPATH."files/".$new_job_session_id."/";
        if( $this->_copy_directory($source, $destination)) {
            $this->session->set_userdata('job_session_id', $new_job_session_id);
            $this->session->set_userdata('name', $job->name);
            $this->session->set_userdata('email', $job->email);
            $this->session->set_userdata('contact', $job->contact);
            $this->session->set_userdata('po_number', $job->po_number);
            $this->session->set_userdata('intake', $job->intake);
            $this->session->set_userdata('module', $job->module);
            $this->session->set_userdata('job_name', $job->job_name);
            $this->session->set_userdata('attention_to', $job->attention_to);
            $this->session->set_userdata('delivery_location', $job->delivery_location);
            $this->session->set_userdata('counter', $job->counter);
            $this->session->set_userdata('files', unserialize($job->files) );

            $this->_throwJSONOutput(1, 'Order Duplicated Successfully', 'success');
        }

    }

    private function _copy_directory($source, $destination) {
        $dir = opendir($source);
        @mkdir($destination);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($source . '/' . $file) ) {
                    $this->_copy_directory($source . '/' . $file,$destination . '/' . $file);
                }
                else {
                    $file_ext = pathinfo($file);
                    if( $file_ext['extension'] != 'zip' ) {
                        copy($source . '/' . $file, $destination . '/' . $file);
                    }
                }
            }
        }
        closedir($dir);

        return TRUE;
    }

    public function do_generate($order_id)
    {
        $this->load->model('get_orders_model');
        $data['job'] = $this->get_orders_model->orderByID($order_id);

        $this->load->view('order_do', $data);
    }

    // public function file_download($session_id,$order_id){
    //     $this->load->library('zip');
    //     $path = FCPATH.'/files/'.$session_id;
    //     $this->zip->read_dir($path,FALSE);
    //
    //     // Download the file to your desktop. Name it "my_backup.zip"
    //     $this->zip->download($order_id.'zip');
    // }


}
