<?php

class Mcrud extends CI_Model
{

    public function get_all_data($table)
    {
        $q = $this->db->get($table);
        return $q;
    }

    public function cek($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get()->num_rows();
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function get_by_id($table, $id)
    {
        return $this->db->get_where($table, $id);
    }

    public function update($table, $data, $pk, $id)
    {
        $this->db->where($pk, $id);
        $this->db->update($table, $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function dataOrder()
    {
        $this->db->select('*, p.id AS idpesan, m.nama AS menu');
        $this->db->from('tbl_order p');
        $this->db->join('tbl_menu m', 'm.id=p.id_menu');
        $this->db->order_by('p.id', 'DESC');
        return $this->db->get();
    }

    public function dataPayment()
    {
        $this->db->select('*, m.id AS idpem');
        $this->db->from('tbl_payment m');
        $this->db->join('tbl_order p', 'p.id=m.id_pesan');
        $this->db->order_by('m.id', 'DESC');
        return $this->db->get();
    }

    public function getOrderById($id)
    {
        $this->db->select('namaPemesan, total');
        $this->db->from('tbl_order');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getPendapatan()
    {
        $this->db->select_sum('total');
        $this->db->from('tbl_order');
        $this->db->where('status_bayar', 'Y');
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function getOrder()
    {
        return $this->db->count_all_results('tbl_order');
    }

    public function getBelumBayar()
    {
        $this->db->select('COUNT(id) as belum');
        $this->db->from('tbl_order');
        $this->db->where('status_bayar', 'N');
        $query = $this->db->get();
        return $query->row()->belum;
    }

    public function getSudahBayar()
    {
        $this->db->select('COUNT(id) as sudah');
        $this->db->from('tbl_order');
        $this->db->where('status_bayar', 'Y');
        $query = $this->db->get();
        return $query->row()->sudah;
    }
}
