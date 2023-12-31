<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
        $this->load->model('M_mahasiswa');
    }

    public function index()
    {
        $data['data'] = $this->M_mahasiswa->GetMahasiswaWithProdiAndSemesterAndKelas()->result();
        $data['pages'] = 'project/mahasiswa/mahasiswa';
        $this->load->view('template', $data);
    }

    function add()
    {
        $data['prodi_list'] = $this->M_mahasiswa->GetKodeProdi();
        $data['semester_list'] = $this->M_mahasiswa->GetIdSemester();
        $data['kelas_list'] = $this->M_mahasiswa->GetIdKelas();
        $data['pages'] = 'project/mahasiswa/add_mahasiswa';
        $this->load->view('template', $data);
    }

    public function create()
    {
        $post = $this->input->post();
        $data = [
            'id_mahasiswa' => $post['id_mahasiswa'],
            'foto' => $post['foto'],
            'nim' => $post['nim'],
            'nama_lengkap' => $post['nama_lengkap'],
            'email' => $post['email'],
            'gender' => $post['gender'],
            'status_study' => $post['status_study'],
            'jenjang_study' => $post['jenjang_study'],
            'semester_awal' => $post['semester_awal'],
            'kode_prodi' => $post['kode_prodi'],
            'id_semester' => $post['id_semester'],
            'id_kelas' => $post['id_kelas']
        ];
        $this->M_mahasiswa->Save($data);
        $this->session->set_flashdata('success', 'Data berhasil Di tambahkan');
        redirect(base_url('project/data_mahasiswa/mahasiswa'));
    }

    public function edit($id_mahasiswa)
    {
        $data['mahasiswa'] = $this->M_mahasiswa->Get();
        $data['prodi_list'] = $this->M_mahasiswa->GetKodeProdi();
        $data['semester_list'] = $this->M_mahasiswa->GetIdSemester();
        $data['kelas_list'] = $this->M_mahasiswa->GetIdKelas();
        $data['data'] = $this->M_mahasiswa->GetMahasiswaWithProdiAndSemesterAndKelas($id_mahasiswa)->row();
        $data['data'] = $this->M_mahasiswa->Get($id_mahasiswa)->row();
        $data['pages'] = 'project/mahasiswa/edit_mahasiswa';
        $this->load->view('template', $data);
    }

    public function Update()
    {
        $post = $this->input->post();
        $data = [
            'id_mahasiswa' => $post['id_mahasiswa'],
            'foto' => $post['foto'],
            'nim' => $post['nim'],
            'nama_lengkap' => $post['nama_lengkap'],
            'email' => $post['email'],
            'gender' => $post['gender'],
            'status_study' => $post['status_study'],
            'jenjang_study' => $post['jenjang_study'],
            'semester_awal' => $post['semester_awal'],
            'kode_prodi' => $post['kode_prodi'],
            'id_semester' => $post['id_semester'],
            'id_kelas' => $post['id_kelas']
        ];
        $this->M_mahasiswa->Updated($data, $post['where']);
        $this->session->set_flashdata('success', 'Data berhasil Di Update');
        redirect(base_url('project/data_mahasiswa/mahasiswa'));

    }

    function delete($id_mahasiswa)
    {
        $this->session->set_flashdata('success', 'Data berhasil Di Hapus');
        $this->M_mahasiswa->Deleted($id_mahasiswa);
        redirect(base_url('project/data_mahasiswa/mahasiswa'));
    }
}