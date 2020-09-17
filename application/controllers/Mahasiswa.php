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

    public function read($rowNo = 0)
    {
        if ($this->input->is_ajax_request()) {
            $rowPerpage = 5;
            if ($rowNo != 0) {
                $rowNo = ($rowNo - 1) * $rowPerpage;
            }

            $dataMahasiswa = $this->mahasiswa_model->getAllMahasiswa($rowPerpage, $rowNo);
            $dataMahasiswaCount = $this->mahasiswa_model->getMahasiswaCount();

            $config['base_url'] = base_url() . 'mahasiswa/read';
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $dataMahasiswaCount;
            $config['per_page'] = $rowPerpage;
            $config['num_links'] = 2;

            $config['full_tag_open']    = '<ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul>';

            $config['first_link']       = false;
            $config['last_link']       = false;

            $config['next_link']       = '<i class="fas fa-chevron-right"></i>';
            $config['next_tag_open']   = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link']       = '<i class="fas fa-chevron-left"></i>';
            $config['prev_tag_open']   = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open']   = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open']   = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';

            $config['attributes'] = array('class' => 'page-link');

            $this->pagination->initialize($config);
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['dataMahasiswa'] = $dataMahasiswa;
            $this->data['rowNo'] = $rowNo;
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
