<?php

namespace App\Models;

use CodeIgniter\Model;

class AduanModel extends Model
{
    protected $table = "aduan";
    protected $useTimestamps = true;
    protected $useAutoIncrement = true;
    protected $primaryKey = 'id';
    protected $createdField = 'create_at';
    protected $updatedField = 'update_at';
    protected $dataFormat = 'datetime';
    protected $allowedFields = ['judul', 'date', 'kategori', 'nama', 'alamat', 'nik', 'body', 'image', 'status'];


    public function getAduan($id)
    {
        // pembuatan query
        $sql = "SELECT * FROM aduan WHERE id='$id'";
        // Eksekusi query
        $query = $this->db->query($sql);
        // uraikan hasil kueri dalam bentuk array
        $data = $query->getResultArray();
        // Kembalikan hasil kueri ke kontroller
        return $data;
    }

    public function getLogin($id)
    {
        // pembuatan query
        $sql = "SELECT * FROM aduan WHERE id='$id'";
        // Eksekusi query
        $query = $this->db->query($sql);
        // uraikan hasil kueri dalam bentuk array

        return;
    }

    public function getUpdate($id)
    {
        if (isset($_POST['submit'])) {

            $id = $_POST['id'];
            $judul = $_POST['judul'];
            $date = $_POST['date'];
            $kategori = $_POST['kategori'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $nik = $_POST['nik'];
            $body = $_POST['body'];
            $image = $_POST['image'];
            // pembuatan query
            $sql = "UPDATE aduan SET judul='$judul',date='$date',kategori='$kategori',nama='$nama',alamat='$alamat',nik='$nik',body='$body',image='$image' WHERE id='$id'";
            // Eksekusi query
            $query = $this->db->query($sql);
            // uraikan hasil kueri dalam bentuk array

            return;
        }
    }
}
