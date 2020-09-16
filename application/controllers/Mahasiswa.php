<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();

        $this->data['css'] = array(
            'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        );
        $this->data['js'] = array(
            'https://code.jquery.com/jquery-3.2.1.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
            'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
            'https://kit.fontawesome.com/7ff2fae3fd.js',
            base_url('assets/js/mahasiswa.js')
        );

        $this->data['title'] = 'Mahasiswa';
    }

    public function index()
    {
        $this->data['dataJurusan'] = $this->mahasiswa_model->getAllJurusan();
        $this->load->view('header_view', $this->data);
        $this->load->view('mahasiswa_view');
        $this->load->view('footer_view');
    }

    public function read()
    {
        if ($this->input->is_ajax_request()) {
            $this->db->start_cache();
            $this->data['dataMahasiswa'] = $this->mahasiswa_model->getAllMahasiswa(0, 0);
            $this->db->flush_cache();
            $this->load->view('mahasiswa_data_view', $this->data);
        } else {
            show_404();
        }
    }

    public function create()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules($this->mahasiswa_model->rules());
            if ($this->form_validation->run()) {
                $data = array(
                    'npm' => $this->input->post('npm'),
                    'nama' => $this->input->post('nama'),
                    'id_jurusan' => $this->input->post('id_jurusan'),
                    'date_created' => date('Y-m-d H:i:s')
                );
                $result = $this->mahasiswa_model->insertDataMahasiswa($data);
                $arr = array('data' => $result);
            } else {
                $arr = array(
                    'error' => true,
                    'npmError' => form_error('npm', '<small class="text-danger">', '</small>'),
                    'namaError' => form_error('nama', '<small class="text-danger">', '</small>'),
                    'jurusanError' => form_error('id_jurusan', '<small class="text-danger">', '</small>'),
                );
            }
            echo json_encode($arr);
        } else {
            show_404();
        }
    }

    public function test()
    {
        var_dump($this->mahasiswa_model->getAllMahasiswa(0, 0));
    }
}
