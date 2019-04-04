<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_barang extends CI_Model
{
	public $table = 'barang';
	public $field_select = ["id_barang", "nama_barang", "harga_barang", "keterangan_barang", "gambar1_barang", "gambar2_barang", "gambar3_barang", "idkategori_barang", "idpersonal_barang", "status_barang"];

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch_data($data)
	{
		$this->db->select($data['fields'])
			->from($data['table_view']);
		$data['total']	= $this->db->count_all_results(null, false);
		$sql			= $this->db->get_compiled_select();
		$data['result']	= $this->db->query($sql)->result_array();
		//print('<pre>'); print_r($query); exit();
		return $data;
	}

	/* public function tampil($data)
	{
		$id_personal = ;
		$idpersonal_barang = $id_personal;
		$this->db->select()
			->from($this->table)
			->where("idpersonal_barang", $idpersonal_barang);
			$data['total']	= $this->db->count_all_results(null, false);
			$sql			= $this->db->get_compiled_select();
			$data['result']	= $this->db->query($sql)->result_array();

			return $data;	
	} */

	public function detail_barang($id_barang)
	{
		$this->db->select()
			->from($this->table)
			->where("id_barang", $id_barang);
		$query = $this->db->get_compiled_select();
		//print('<pre>'); print_r($query); exit();
		$data['result'] = $this->db->query($query)->row();
		return $data;
	}
	
	public function tambah_barang($data)
	{
		$this->db->select()
			->from($this->table);
		$query = $this->db->set($data)->get_compiled_insert();
		//print('<pre>'); print_r($query); exit();
		$this->db->query($query);
		return true;
	}

	public function ubah_barang($data)
	{
		$this->db->select()
			->from($this->table)
			->where("id_barang", $data['id_barang']);
		$query = $this->db->set($data)->get_compiled_update();
		//print('<pre>'); print_r($query); exit();
		$this->db->query($query);
		return true;
	}

	public function hapus($table, $id)
	{
		$this->db->select()
			->from($this->table)
			->where('id_barang', $id);
		$query = $this->db->get_compiled_delete();
		return true;
	}

	public function upload($data)
    {
        $this->db->select()
            ->from($this->table)
            ->where("id_barang", $data['id_barang']);
        $query = $this->db->set($data)->get_compiled_update();
        $this->db->query($query);    
        return true;
    }
/* 
	function get_kategori()
	{
        $hasil=$this->db->query("SELECT * FROM kategori");
        return $hasil;
    }
 
	function get_subkategori($id)
	{
        $hasil=$this->db->query("SELECT * FROM subkategori WHERE idkategori_subkategori='$id'");
        return $hasil->result();
	} */
	function dd_provinsi()
    {
        // ambil data dari db
        $this->db->order_by('provinsi', 'asc');
        $result = $this->db->get('provinsi');
        
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = 'Please Select';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->id_provinsi] = $row->provinsi;
            }
        }
        return $dd;
    }
}