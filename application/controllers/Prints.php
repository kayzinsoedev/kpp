<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('memory_limit', '6144M');
ini_set('max_execution_time', 100000);

class Prints extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!$user) {
            redirect( base_url('/'), 'location');
        }
    }

    private function _throwJSONOutput($resultValue, $outputData = NULL, $outputName = 'data')
    {
        $this->output->set_content_type('application/json');
        $messageArray = $outputData;
        die( json_encode(array("result" => $resultValue, $outputName => $messageArray)) );
    }

    private function _removeIncompleteUploadFiles()
    {

        if($this->session->userdata('files') != TRUE) {
            return FALSE;
        }

        $shortlist = $this->session->userdata('files');
        foreach ($shortlist as $key => $value) {
            if (!array_key_exists('form_id', $shortlist[$key])) {
                unset($shortlist[$key]);
                $this->session->set_userdata('files', $shortlist);
                $upload_path = FCPATH.'files/'.$this->session->userdata('job_session_id').'/'.$shortlist[$value].'/';
                $this->_removeDirectory($upload_path);
            }
            // $this->_throwJSONOutput(0,$shortlist, 'data');
        }
        return $shortlist;
    }

    private function _showUploadedFiles()
    {
        if( $this->session->userdata('files') ) {
            $data = [];
            $filteredFiles = $this->_removeIncompleteUploadFiles();
            $data['files'] = $filteredFiles;
        }else{
          $data = "";
        }

        return $data;
    }

    function index()
    {
        $data['session'] = $this->session->all_userdata();
        $this->load->view('print_details', $data);
    }

    function test()
    {
        $data['session'] = $this->session->all_userdata();
        $this->load->view('print_details_test', $data);
    }

    function print_validation()
    {
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('contact','Contact No.','required');
        $this->form_validation->set_rules('entity','Entity','required');
        $this->form_validation->set_rules('division','Division','required');
        $this->form_validation->set_rules('attention_to','Attention To','required');
        $this->form_validation->set_rules('delivery_date','Delivery Date','required');
        $this->form_validation->set_rules('delivery_location','Campus','required');

        if($this->form_validation->run() == FALSE) {
            $message = strip_tags(validation_errors());
            $this->_throwJSONOutput(0, $message);
        }


        $dir = FCPATH.'files/'.$this->session->userdata('job_session_id').'/';
        if( is_dir($dir) === FALSE )
        {
            $old = umask(0);
            if ( !mkdir($dir, 0777) ) {
               return FALSE;
            }
            umask($old);
        }

        $this->session->set_userdata( $this->input->post() );
        $this->_throwJSONOutput(1, base_url('prints/files/'), 'location');
    }

    public function files()
    {
        $data = $this->_showUploadedFiles();
        if( isset($data['files']) ){
          $data['session'] = $this->session->all_userdata();
          $this->load->view('file_upload', $data);
        }else{
           $my_session_data['session'] = $this->session->all_userdata();
           $this->load->view('file_upload', $my_session_data);
        }
    }

    public function files_test()
    {
        $data = $this->_showUploadedFiles();
        $data['session'] = $this->session->all_userdata();

        $this->load->view('file_upload_test', $data);
    }

    public function file_validation($content = NULL, $cover = NULL, $handouts = NULL)
    {
        $upload_path = FCPATH.'files/'.$this->session->userdata('job_session_id').'/'.$this->input->post('counter').'/';
        if(!is_dir($upload_path)) {
            mkdir($upload_path,0777,TRUE);
            mkdir($upload_path."content/",0777,TRUE);
            mkdir($upload_path."cover/",0777,TRUE);
            mkdir($upload_path."handouts/",0777,TRUE);
        }
        // Content
        if( !empty($_FILES['content_file']['name'][0]) ) {
            $this->form_validation->set_rules('content_side', 'Paper Side', 'required');
            $this->form_validation->set_rules('finishing', 'Finishing', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
            $this->form_validation->set_rules('file_name', 'File Name', 'required');
            $this->form_validation->set_message('numeric', 'Quantity must only contain numbers. It should not have any commas or other characters. Only whole numbers are accepted.');

            if($this->form_validation->run() == FALSE) {
                $message = strip_tags(validation_errors("For Content - "));
                $this->_throwJSONOutput(0, $message);
            }

            $content = $this->_uploadFiles($_FILES['content_file'], $upload_path, 'content', $this->input->post('content_side'));
            if( isset($content['error']) ) {
                $message = strip_tags($content['error']);
                $this->_removeDirectory($upload_path);
                $this->_throwJSONOutput(0, $message);
            }

            $contentUploaded = TRUE;
        }

        // Cover
        $cover_included_post = $this->input->post('cover_included');
        $cover_included = ( isset( $cover_included_post )  && $this->input->post('cover_included') == 'yes' )? TRUE: FALSE;
        if( !empty($_FILES['cover_file']['name'][0]) && $cover_included == FALSE && !empty($_FILES['content_file']['name'][0]) ) {
            if($this->form_validation->run() == FALSE) {
                $message = strip_tags(validation_errors("For Cover - "));
                $this->_throwJSONOutput(0, $message);
            }

            $cover = $this->_uploadFiles($_FILES['cover_file'], $upload_path, 'cover');
            if( isset($cover['error']) ) {
                $message =  strip_tags($cover['error']);
                $this->_removeDirectory($upload_path);
                $this->_throwJSONOutput(0, $message);
            }

            $coverUploaded = TRUE;
        }

        // Handouts
        if( !empty($_FILES['handouts_file']['name'][0]) ) {

            $this->form_validation->set_rules('handouts_side','Print Side','required');
            $this->form_validation->set_rules('handouts_quantity','Quantity','required|numeric');
            $this->form_validation->set_rules('file_name', 'File Name', 'required');

            if($this->form_validation->run() == FALSE) {
                $message = strip_tags(validation_errors("For Handouts - "));
                $this->_throwJSONOutput(0, $message);
            }

            $handouts = $this->_uploadFiles($_FILES['handouts_file'], $upload_path, 'handouts', $this->input->post('handouts_side'));
            if( isset($handouts['error']) ) {
                $message =  strip_tags($handouts['error']);
                $this->_removeDirectory($upload_path);
                $this->_throwJSONOutput(0, $message);
            }

            $handoutsUploaded = TRUE;
        }

        if( isset($contentUploaded) || isset($coverUploaded) || isset($handoutsUploaded) ) {

            $files = $this->session->userdata('files');
            $files[$this->input->post('counter')] = $this->_setSessionDetails($this->input->post(), $content, $cover, $handouts);

            $this->session->set_userdata('counter', $this->input->post('counter') );
            $this->session->set_userdata('files',$files);

            $this->_throwJSONOutput(1, 'Uploaded Successfully', 'success');

        }

        $this->_throwJSONOutput(0, 'No Files Uploaded, Try Again');

    }

    public function file_validation_test()
    {
        echo ini_get('upload_max_filesize');
        print_r($this->input->post());
    }

    public function delete($counter)
    {
        $files = $this->session->userdata('files');
        $directory = FCPATH.'files/'.$this->session->userdata('job_session_id').'/'.$counter;
        if( $this->_removeDirectory($directory) ) {
            unset($files[$counter]);
            $this->session->set_userdata('files', $files);
            $this->_throwJSONOutput(1, 'Deleted Successfully', 'success');
        }
        $this->_throwJSONOutput(0, 'Cannot Delete the Job.');
    }

    private function _uploadFiles($files, $upload_path, $folder, $side = NULL)
    {
        $data = array();
        $pages = 0;
        for($i=0; $i < count($files['name']); $i++) {

            $_FILES['file']['name']     = $files['name'][ $i ];
            $_FILES['file']['type']     = $files['type'][ $i ];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][ $i ];
            $_FILES['file']['error']    = $files['error'][ $i ];
            $_FILES['file']['size']     = $files['size'][ $i ];

            $config['upload_path'] = $upload_path . $folder . "/";
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = FALSE;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 0;
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('file')) {
                return array(
                    'error' => $this->upload->display_errors("<li>", "</li>"),
                );
            }
            $file = $this->upload->data();
            $data[$i] = $file;
            $pages += $this->_countPDFPages($file['full_path']);
        }

        if($side == 'Double' && $pages % 2 != 0) {
            $pages++;
        }

        $data['pp'] = $pages;

        return $data;
    }

    private function _setSessionDetails($postData, $content = NULL, $cover = NULL, $handouts = NULL)
    {
        $files = array(
            'form_id'               => $postData['counter'],
            'file_name'             => ( isset($postData['file_name']) )?$postData['file_name']:'',

            'content'               => $this->_filterUploadedFileData($content, 'content', $postData['counter']),
            'content_pp'            => $content['pp'],
            'content_color'         => 'Black & White',
            'content_side'          => $postData['content_side'],

            'cover_included'        => ( isset( $postData['cover_included'] )  && $postData['cover_included'] == 'yes' )? 'yes': 'no',
            'cover'                 => $this->_filterUploadedFileData($cover, 'cover', $postData['counter']),
            'cover_pp'              => ($cover != NULL) ? $cover['pp'] : '',
            'cover_color'           => ($cover != NULL) ? 'Colour' : '',
            'cover_side'            => ($cover != NULL) ? 'Double' : '',
            'finishing'             => $postData['finishing'],
            'size'                  => ($content != NULL) ? 'A4' : '',
            'quantity'              => $postData['quantity'],
            'additional_items'      => ( isset($postData['additional_items']) ) ? $postData['additional_items'] : '',
            'remarks'               => $postData['remarks'],

            'handouts'              => $this->_filterUploadedFileData($handouts, 'handouts', $postData['counter']),
            'handouts_pp'           => $handouts['pp'],
            'handouts_color'        => ($handouts != NULL) ? 'Black & White' : '',
            'handouts_side'         => $postData['handouts_side'],
            'handouts_size'         => ($handouts != NULL) ? 'A4' : '',
            'handouts_punch_hole'   => $postData['handouts_punch_hole'],
            'handouts_staple'       => $postData['handouts_staple'],
            'handouts_quantity'     => $postData['handouts_quantity'],
            'handouts_remarks'      => $postData['handouts_remarks'],
        );

        return $files;
    }

    private function _filterUploadedFileData($data, $dataName, $counter)
    {
        if($data == NULL) { return FALSE; }
        $dataFiles = array();

        foreach($data as $key => $value) {
            if($key !== "pp") {
                $dataFiles[$key] = array(
                    $dataName."_file" => $value['full_path'],
                    $dataName."_name" => $value['file_name'],
                );
            }
        }

        return $dataFiles;
    }

    private function _removeDirectory($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir")
                        $this->_removeDirectory($dir."/".$object);
                    else unlink($dir."/".$object);
                }
            }
            reset($objects);
            if( rmdir($dir) ){
                return TRUE;
            }
        }
        return NULL;
    }

    private function _countPDFPages($document)
    {
        $cmd = APPPATH."libraries/pdfinfo/pdfinfo";
        $pageCount = 0;
        // Parse entire output
        exec("$cmd \"$document\"", $output);

        // Iterate through lines
        foreach($output as $op) {
            // Extract the number
            if(preg_match("/Pages:\s*(\d+)/i", $op, $matches) === 1) {
                $pageCount = intval($matches[1]);
                break;
            }
        }

        return $pageCount;
    }


}
