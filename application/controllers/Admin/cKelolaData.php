<?php
defined('BASEPATH') or exit('No direct script access allowed');

#[AllowDynamicProperties]
class cKelolaData extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('mKelolaData');
    }


    public function pegawai()
    {
        $token = $this->session->userdata('token'); // Get JWT token from session
        $apiUrl = $this->config->item('api_url') . '/pegawai/';

        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode response, ensuring it's a valid array
        $pegawaiData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($pegawaiData)) {
            $pegawaiData = []; // Use an empty array if the response is invalid
        }

        $data = array(
            'pegawai' => json_decode($response, true)
        );

        $this->load->view('Admin/Layout/head');
        $this->load->view('Admin/Layout/aside');
        $this->load->view('Admin/Pegawai/vpegawai', $data);
        $this->load->view('Admin/Layout/footer');
    }

    //barang
    public function tablet()
    {
        $token = $this->session->userdata('token');
        $apiUrl = $this->config->item('api_url') . '/tab/';

        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode response, ensuring it's a valid array
        $tabletData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($tabletData)) {
            $tabletData = []; // Use an empty array if the response is invalid
        }

        $data = array(
            'tablet' => json_decode($response, true)
        );

        $this->load->view('Admin/Layout/head');
        $this->load->view('Admin/Layout/aside');
        $this->load->view('Admin/Tablet/vtablet', $data);
        $this->load->view('Admin/Layout/footer');
    }

    //user
    public function user()
    {
        $token = $this->session->userdata('token'); // Get JWT token from session
        $apiUrl = $this->config->item('api_url') . '/user/';
        // $apiUrl = 'http://localhost:3000/user';

        // Siapkan header untuk request
        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = array(
            'user' => json_decode($response)
        );

        $this->load->view('Admin/Layout/head');
        $this->load->view('Admin/Layout/aside');
        $this->load->view('Admin/user/vuser', $data);
        $this->load->view('Admin/Layout/footer');
    }

    public function currentuser()
    {
        $token = $this->session->userdata('token'); // Get JWT token from session
        $apiUrl = $this->config->item('api_url') . '/user/me';

        // Set up headers for the request
        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $user = json_decode($response);

        // Pass the user data to the views
        $data = array(
            'user' => $user
        );

        $this->load->view('Admin/Layout/head');
        $this->load->view('Admin/Layout/aside', $data); // Pass $data here
        $this->load->view('Admin/user/vuser', $data);
        $this->load->view('Admin/Layout/footer');
    }


    public function createuser()
    {
        $token = $this->session->userdata('token');
        $apiUrl = $this->config->item('api_url') . '/user';

        $postData = json_encode(array(
            'name' => $this->input->post('name'),
            'nomor_hp' => $this->input->post('nomor_hp'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'role' => $this->input->post('role')
        ));

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        curl_exec($ch);
        curl_close($ch);

        $this->session->set_flashdata('success', 'Data User Berhasil Disimpan!');
        redirect('Admin/cKelolaData/user');
    }

    public function updateuser($id)
    {
        $token = $this->session->userdata('token');
        $apiUrl = $this->config->item('api_url') . '/user/' . $id;
        // $apiUrl = 'http://localhost:3000/user/' . $id;

        $postData = json_encode(array(
            'name' => $this->input->post('name'),
            'nomor_hp' => $this->input->post('nomor_hp'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'role' => $this->input->post('role')
        ));

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        curl_exec($ch);
        curl_close($ch);

        $this->session->set_flashdata('success', 'Data User Berhasil Diperbaharui!');
        redirect('Admin/cKelolaData/user');
    }

    public function deleteuser($id)
    {
        $token = $this->session->userdata('token');
        $apiUrl = $this->config->item('api_url') . '/user/' . $id;
        // $apiUrl = 'http://localhost:3000/user/' . $id;

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));

        curl_exec($ch);
        curl_close($ch);

        $this->session->set_flashdata('success', 'Data User Berhasil Dihapus!');
        redirect('Admin/cKelolaData/user');
    }

    //transaksi
    public function transaksi()
    {
        $token = $this->session->userdata('token');
        $apiUrl = $this->config->item('api_url') . '/transaksi?tmt=asc';

        $headers = array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        );

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        // Decode response, ensuring it's a valid array
        $transaksiData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($transaksiData)) {
            $transaksiData = []; // Use an empty array if the response is invalid
        }

        $data = array(
            'transaksi' => json_decode($response, true)
        );

        $this->load->view('Admin/Layout/head');
        $this->load->view('Admin/Layout/aside');
        $this->load->view('Admin/Transaksi/vtransaksi', $data);
        $this->load->view('Admin/Layout/footer');
    }

    public function createtransaksi()
    {
        $token = $this->session->userdata('token');
        $apiUrl = $this->config->item('api_url') . '/user';

        $postData = json_encode(array(
            'imei_tab' => $this->input->post('imei_tab'),
            'nip_pegawai' => $this->input->post('nip_pegawai'),
            'tanggal_bast' => $this->input->post('tanggal_bast'),
            'transaksi' => $this->input->post('transaksi'),
            'status' => $this->input->post('status'),
            'kondisi' => $this->input->post('kondisi')
        ));

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        curl_exec($ch);
        curl_close($ch);

        $this->session->set_flashdata('success', 'Data Transaksi Berhasil Disimpan!');
        redirect('Admin/cKelolaData/transaksi');
    }

    public function updatetransaksi($id_transaksi)
    {
        $token = $this->session->userdata('token');
        $apiUrl = $this->config->item('api_url') . '/transaksi/' . $id_transaksi;

        $postData = json_encode(array(
            'imei_tab' => $this->input->post('imei_tab'),
            'nip_pegawai' => $this->input->post('nip_pegawai'),
            'tanggal_bast' => $this->input->post('tanggal_bast'),
            'transaksi' => $this->input->post('transaksi'),
            'status' => $this->input->post('status'),
            'kondisi' => $this->input->post('kondisi')
        ));

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        curl_exec($ch);
        curl_close($ch);

        $this->session->set_flashdata('success', 'Data Transaksi Berhasil Diperbaharui!');
        redirect('Admin/cKelolaData/transaksi');
    }

    public function deletetransaksi($id_transaksi)
    {
        $token = $this->session->userdata('token');
        $apiUrl = $this->config->item('api_url') . '/transaksi/' . $id_transaksi;

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ));

        curl_exec($ch);
        curl_close($ch);

        $this->session->set_flashdata('success', 'Data Transaksi Berhasil Dihapus!');
        redirect('Admin/cKelolaData/transaksi');
    }
}

/* End of file cKelolaData.php */
