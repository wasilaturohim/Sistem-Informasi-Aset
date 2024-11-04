<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cDashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
{
    $token = $this->session->userdata('token'); // Ambil token dari sesi
    
    // Pastikan token tersedia
    if (!$token) {
        $this->session->set_flashdata('error', 'Anda belum login!');
        redirect('cAuth');
    }

    // Siapkan header untuk request
    $headers = array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json',
    );

    $apiUrl = $this->config->item('api_url') . '/transaksi/counts';

    // Inisialisasi CURL untuk mendapatkan data dari API
    $ch = curl_init($apiUrl);
    // curl_setopt($ch, CURLOPT_URL, 'http://localhost:3000/transaksi/counts');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    // Decode respons JSON menjadi array
    $transaksi = json_decode($response, true);

    // Kirim data ke view jika respons valid, atau set sebagai array kosong
    $data['transaksi'] = $transaksi ?: [
        'kondisi' => ['BERFUNGSI' => 0, 'TIDAK_BERFUNGSI' => 0],
        'status' => ['LENGKAP' => 0, 'TIDAK_LENGKAP' => 0],
        'transaksi' => ['PENERIMAAN' => 0, 'PENGEMBALIAN' => 0],
    ];

    // Tampilkan view dengan data
    $this->load->view('Admin/Layout/head');
    $this->load->view('Admin/Layout/aside');
    $this->load->view('Admin/vDashboard', $data);
    $this->load->view('Admin/Layout/footer');
}

}


/* End of file cDashboard.php */