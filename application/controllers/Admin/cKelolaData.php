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

    public function createpegawai()
    {
        $data = array(
            'nip_pegawai' => $this->input->post('nip_pegawai'),
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'jabatan' => $this->input->post('jabatan'),
            'satker_1' => $this->input->post('satker_1'),
            'satker_2' => $this->input->post('satker_2'),
            'tmt' => $this->input->post('tmt')
        );
        $this->mKelolaData->insert_pegawai($data);
        $this->session->set_flashdata('success', 'Data Pegawai Berhasil Disimpan!');
        redirect('Admin/cKelolaData/pegawai');
    }
    public function updatepegawai($id)
    {
        $data = array(
            'nip_pegawai' => $this->input->post('nip'),
            'nama_pegawai' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'satker_1' => $this->input->post('satker_1'),
            'satker_2' => $this->input->post('satker_2'),
            'tmt' => $this->input->post('tmt'),
        );
        // $this->mKelolaData->updatepegawai($id, $data);
        $this->session->set_flashdata('success', 'Data Pegawai Berhasil Update!');
        redirect('Admin/cKelolaData/pegawai');
    }
    public function deletepegawai($id)
    {
        // $this->mKelolaData->deletepegawai($id);
        $this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus!');
        redirect('Admin/cKelolaData/pegawai');
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

    public function createtablet()
    {
        $data = array(
            'imei_tab' => $this->input->post('imei'),
            'device' => $this->input->post('device'),
            'no_bmn' => $this->input->post('no_bmn'),
        );
        // $this->mKelolaData->insert_tablet($data);
        $this->session->set_flashdata('success', 'Data Tablet Berhasil Ditambahkan!');
        redirect('Admin/cKelolaData/tablet');
    }

    public function updatetablet($id)
    {
        $data = array(
            'imei_tab' => $this->input->post('imei'),
            'device' => $this->input->post('device'),
            'no_bmn' => $this->input->post('no_bmn'),
        );
        // $this->mKelolaData->updatedata($id, $data);
        $this->session->set_flashdata('success', 'Data Tablet Berhasil Diperbaharui!');
        redirect('Admin/cKelolaData/tablet');
    }
    public function deletetablet($id)
    {
        // $this->mKelolaData->deletetablet($id);
        $this->session->set_flashdata('success', 'Data tablet Berhasil Dihapus!');
        redirect('Admin/cKelolaData/tablet');
    }

    //lokasi
    public function lokasi()
    {
        $data = array(
            // 'lokasi' => $this->mKelolaData->select_lokasi()
        );
        $this->load->view('Admin/Layout/head');
        $this->load->view('Admin/Layout/aside');
        $this->load->view('Admin/lokasi/vlokasi', $data);
        $this->load->view('Admin/Layout/footer');
    }
    public function createlokasi()
    {
        $data = array(
            'nama_lokasi' => $this->input->post('nama'),
            'alamat_lengkap' => $this->input->post('alamat')
        );
        // $this->mKelolaData->insert_lokasi($data);
        $this->session->set_flashdata('success', 'Data Lokasi Berhasil Disimpan!');
        redirect('Admin/cKelolaData/lokasi');
    }
    public function updatelokasi($id)
    {
        $data = array(
            'nama_lokasi' => $this->input->post('nama'),
            'alamat_lengkap' => $this->input->post('alamat')
        );
        // $this->mKelolaData->updatelokasi($id, $data);
        $this->session->set_flashdata('success', 'Data Lokasi Berhasil Diperbaharui!');
        redirect('Admin/cKelolaData/lokasi');
    }
    public function deletelokasi($id)
    {
        // $this->mKelolaData->deletelokasi($id);
        $this->session->set_flashdata('success', 'Data Lokasi Berhasil Dihapus!');
        redirect('Admin/cKelolaData/lokasi');
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
        $data = array(
            // 'transaksi' => $this->mKelolaData->select_transaksi(),
            // 'tablet' => $this->mKelolaData->get_all_tablets(), // Ambil semua data tablet
            // 'pegawai' => $this->mKelolaData->get_all_pegawai() // Ambil semua data pegawai
        );

        $this->load->view('Admin/Layout/head');
        $this->load->view('Admin/Layout/aside');
        $this->load->view('Admin/Transaksi/vtransaksi', $data);
        $this->load->view('Admin/Layout/footer');
    }
    public function get_all_tablets()
    {
        $this->db->select('imei_tab');
        $this->db->from('tablet'); // Sesuaikan nama tabel jika perlu
        return $this->db->get()->result();
    }

    public function get_all_pegawai()
    {
        $this->db->select('nip_pegawai');
        $this->db->from('pegawai'); // Sesuaikan nama tabel jika perlu
        return $this->db->get()->result();
    }


    public function createtransaksi()
    {
        $data = array(
            'imei_tab' => $this->input->post('imei_tab'),
            'nip_pegawai' => $this->input->post('nip_pegawai'),
            'tanggal_bast' => $this->input->post('tanggal_bast'),
            'transaksi' => $this->input->post('transaksi'),
            'status' => $this->input->post('status'),
            'kondisi' => $this->input->post('kondisi'),
        );
        // $this->mKelolaData->insert_transaksi($data);
        $this->session->set_flashdata('success', 'Data Transaksi Berhasil Disimpan!');
        redirect('Admin/cKelolaData/transaksi');
    }
    public function updatetransaksi($id)
    {
        $data = array(
            'imei_tab' => $this->input->post('imei_tab'),
            'nip_pegawai' => $this->input->post('nip_pegawai'),
            'tanggal_bast' => $this->input->post('tanggal_bast'),
            'transaksi' => $this->input->post('transaksi'),
            'status' => $this->input->post('status'),
            'kondisi' => $this->input->post('kondisi'),
        );
        // $this->mKelolaData->updatetransaksi($id, $data);
        $this->session->set_flashdata('success', 'Data Transaksi Berhasil Update!');
        redirect('Admin/cKelolaData/transaksi');
    }
    public function deletetransaksi($id)
    {
        // $this->mKelolaData->deletetransaksi($id);
        $this->session->set_flashdata('success', 'Data Transaksi Berhasil Dihapus!');
        redirect('Admin/cKelolaData/transaksi');
    }
}

/* End of file cKelolaData.php */
