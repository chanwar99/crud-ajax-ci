<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    private $tableMahasiswa = 'mahasiswa';
    private $tableJurusan = 'jurusan';

    public function rules()
    {
        return array(
            array(
                'field' => 'npm',
                'label' => 'Npm',
                'rules' => 'required|numeric|is_unique[mahasiswa.npm]|exact_length[10]',
                'errors' => array(
                    'required' => 'Kolom {field} tidak boleh kosong.',
                    'numeric' => '{field} wajib angka.',
                    'is_unique' => '{field} sudah ada.',
                    'exact_length' => '{field} wajib {param} angka.'
                ),
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom {field} tidak boleh kosong.',
                ),
            ),
            array(
                'field' => 'id_jurusan',
                'label' => 'Jurusan',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom {field} tidak boleh kosong.',
                ),
            )
        );
    }

    public function getAllMahasiswa($limit, $offset)
    {
        $this->db->join($this->tableJurusan, $this->tableJurusan . '.id = ' . $this->tableMahasiswa . '.id_jurusan', 'inner');
        $this->db->order_by('date_created', 'DESC');
        return $this->db->get($this->tableMahasiswa, $limit, $offset)->result();
    }

    public function getAllJurusan()
    {
        return $this->db->get($this->tableJurusan)->result();
    }

    public function getSigleMahasiswa($id)
    {
        return $this->db->get_where($this->tableMahasiswa, array('id' => $id))->row();
    }

    public function insertDataMahasiswa($data)
    {
        return $this->db->insert($this->tableMahasiswa, $data);
    }

    public function updateDataMahasiswa($data, $id)
    {
        return $this->db->update($this->tableMahasiswa, $data, array('id' => $id));
    }

    public function deleteDataMahasiswa($id)
    {
        return $this->db->delete($this->tableMahasiswa, array('id' => $id));
    }
}
