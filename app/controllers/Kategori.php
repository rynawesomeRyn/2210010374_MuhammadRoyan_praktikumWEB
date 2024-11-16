<?php
class Kategori extends Controller
{
    public function index()
    {
        $data['title'] = 'Data Kategori';
        $data['kategori'] = $this->Model('KategoriModel')->getAllKategori();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('Kategori/index', $data);
        $this->view('templates/footer');
    }
    public function cari()
    {
        $data['title'] = 'Data Kategori';
        $data['kategori'] = $this->Model('KategoriModel')->cariKategori();
        $data['key'] = $_POST['key'];
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('Kategori/index', $data);
        $this->view('templates/footer');
    }
    public function edit($id)
    {
        $data['title'] = 'Detail Kategori';
        $data['kategori'] = $this->Model('KategoriModel')->getKategoriById($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('kategori/edit', $data);
        $this->view('templates/footer');
    }
    public function tambah()
    {
        $data['title'] = 'Tambah Kategori';
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('Kategori/create', $data);
        $this->view('templates/footer');
    }
    public function simpanKategori()
    {
        if ($this->Model('KategoriModel')->tambahKategori($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/Kategori');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'di tambahkan', 'danger');
            header(' location: ' . base_url . '/Kategori');
            exit;
        }
    }
    public function updateKategori()
    {
        if ($this->Model('KategoriModel')->updateDataKategori($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location: ' . base_url . '/Kategori');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location: ' . base_url . '/Kategori');
            exit;
        }
    }
    public function hapus($id)
    {
        if ($this->Model('KategoriModel')->deleteKategori($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location: ' . base_url . '/Kategori');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/Kategori');
            exit;
        }
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
