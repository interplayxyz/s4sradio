<?php

// Used for creating new channels

class Create extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('room_model', '', TRUE);
        $this->load->model('create_model', '', TRUE);
        $this->load->library('session');
    }
// Process new channel request
    public function make_room($slug) {
// Validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|alpha_dash|min_length[1]|max_length[100]|matches[confirm_password]');
        $slug       = strtolower($slug);
        $check_slug = $this->room_model->check_slug_exists($slug);
        
// If validation fails
        if ($this->form_validation->run() == FALSE) {
// Reload create page
            $data['title'] = 'Problem with your form';
            $this->load->view('templates/form_header', $data);
            $this->load->view('room/new', $data);
            $this->load->view('templates/form_footer', $data);
        } else if ($check_slug) {
// Room is already taken. Redirect to home page
            redirect('/', 'refresh');
        } else {
            $password = $this->input->post('password');
            $result   = $this->create_model->new_room($slug, $password);
            $result   = $this->room_model->verify_room_password($slug, $password);
            if ($result) {
                $sess_array = array();
                foreach ($result as $row) {
                    $sess_array = array(
                        'username' => $row->slug
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                }
            }
// Redirect to start page
            redirect('' . $slug . '/start', 'refresh');
        }
    }
// Landing page after creating room
    public function start($slug) {
        $data['slug']  = $slug;
        $data['title'] = 'Get Started';
        $this->load->view('templates/form_header', $data);
        $this->load->view('command/start', $data);
        $this->load->view('templates/form_footer', $data);
    }
    
}

?>