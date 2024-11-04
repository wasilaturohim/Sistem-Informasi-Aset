<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cAuth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('vAuth');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Prepare data for API request
            $postData = json_encode(array('username' => $username, 'password' => $password));
            $apiUrl = $this->config->item('api_url') . '/auth/login';

            // Initialize cURL
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            // Execute and get response
            $response = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Process response
            if ($statusCode == 200) {
                $authData = json_decode($response);

                // Save token and user ID to session
                $this->session->set_userdata(array(
                    'id' => $authData->id,
                    'token' => $authData->token
                ));

                // Redirect based on user role
                redirect(base_url('Admin/cDashboard'));
            } else {
                $this->session->set_flashdata('error', 'Username atau Password Salah!');
                redirect('cAuth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('token');
        $this->session->set_flashdata('success', 'Anda Berhasil Logout!');
        redirect('cAuth');
    }
}


/* End of file c.php */
