<?php
defined('BASEPATH') or exit('No direct script access allowed');

// application/helpers/auth_helper.php
function is_logged_in()
{
    $ci = get_instance();
    $token = $ci->session->userdata('token');

    if (!$token) {
        // Jika tidak ada token, redirect ke halaman login
        redirect('cAuth');
    } else {
        // Verifikasi token melalui request ke backend
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ci->config->item('api_url') . '/auth/verify');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $token"
        ));
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status == 401) { // Token tidak valid atau kedaluwarsa
            $ci->session->unset_userdata('token');
            $ci->session->set_flashdata('error', 'Session has expired. Please log in again.');
            redirect('cAuth');
        }
    }
}
