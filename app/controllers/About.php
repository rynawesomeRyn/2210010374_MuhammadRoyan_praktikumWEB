<?php
class About extends Controller
{
    public function index()
    {
        $data['title'] = 'Halaman AboutMe';
        $data['nama'] = 'Muhammad Royan';
        $data['alamat'] = 'Jl.Kuin Selatan';
        $data['no_hp'] = '087794036988';

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }
    public function __construct()
    {
        if ($_SESSION['session_login'] != 'sudah_login') {
            Flasher::setMessage('Login', 'Tidak ditemukan.', 'danger');
            header('location: ' . base_url . '/login');
            exit;
        }
    }
}
