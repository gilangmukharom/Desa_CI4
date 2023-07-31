<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AduanModel;
use App\Models\PengajuanModel;

class Admin extends BaseController
{
    protected $AduanModel;
    protected $PengajuanModel;

    public function __construct()
    {
        $this->AduanModel = new AduanModel();
        $this->PengajuanModel = new PengajuanModel();
    }


    public function dashboard_admin()
    {

        $data = [
            'title' => 'Dashboard',
        ];

        echo view('pages/template/header', $data);
        echo view('pages/dashboard/dashboard_admin');
        echo view('pages/template/footer');
    }



    public function response_layanan()
    {

        $layanan = $this->PengajuanModel->findAll();

        $data = [
            'title' => 'Responses Layanan',
            'layanan' => $layanan
        ];

        echo view('pages/template/header');
        echo view('pages/admin/pengajuan', $data);
        echo view('pages/template/footer');
    }
    // menampilkan data aduan
    public function aduan()
    {

        $aduan = $this->AduanModel->findAll();

        $data = [
            'title' => 'Daftar Aduan',
            'aduan' => $aduan
        ];

        echo view('pages/template/header');
        echo view('pages/admin/show_aduan', $data);
        echo view('pages/template/footer');
    }

    //delete aduan
    public function delete_aduan($id)
    {


        $aduan = new AduanModel();
        $aduan->where('id', $id);
        $aduan->delete();
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to(site_url('Admin/aduan'));
    }

    // delete layanan
    public function delete_layanan($id)
    {


        $layanan = new PengajuanModel();
        $layanan->where('id', $id);
        $layanan->delete();
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to(site_url('Admin/response_layanan'));
    }

    // Edit Aduan, mengambil parametr id
    public function edit_aduan($id)
    {


        $data = [
            'title' => 'Edit Aduan',
            'validation' => \Config\Services::validation(),
            'aduan' => $this->AduanModel->getAduan($id)
        ];


        echo view('pages/template/header');
        echo view('pages/admin/edit_aduan', $data);
        echo view('pages/template/footer');
    }

    public function edit_layanan($id)
    {


        $data = [
            'title' => 'Edit Layanan',
            'validation' => \Config\Services::validation(),
            'layanan' => $this->PengajuanModel->getLayanan($id)
        ];


        echo view('pages/template/header');
        echo view('pages/admin/edit_layanan', $data);
        echo view('pages/template/footer');
    }

    public function update_aduan($id)
    {


        $data = $this->request->getPost();
        $this->AduanModel->update($id, $data);

        // $this->AduanModel->getUpdate([
        //     'id' => $id,
        //     'judul' => $this->request->getVar('judul'),
        //     'date' => $this->request->getVar('date'),
        //     'kategori' => $this->request->getVar('kategori'),
        //     'nama' => $this->request->getVar('nama'),
        //     'alamat' => $this->request->getVar('alamat'),
        //     'nik' => $this->request->getVar('nik'),
        //     'body' => $this->request->getVar('body'),
        //     'image' => $this->request->getVar('image'),
        // ]);

        // $data['aduan'] = $this->AduanModel->getUpdate($id);

        session()->setFlashdata('pesan', 'Data Aduan Berhasil diubah.');
        return redirect()->to(site_url('Admin/aduan'))->with('Success', 'Data Berhasil di input');
    }
    public function update_layanan($id)
    {


        $data = $this->request->getPost();
        $this->PengajuanModel->update($id, $data);


        session()->setFlashdata('pesan', 'Data Layanan SKTP Berhasil diubah.');
        return redirect()->to(site_url('Admin/response_layanan'))->with('Success', 'Data Berhasil di input');
    }

    public function simpan()
    {


        $data = $this->request->getPost();
        $this->PengajuanModel->insert($data);
        session()->setFlashdata('pesan', 'Data Pengajuan KTP Berhasil ditambahkan.');
        return redirect()->to(site_url('User/pengajuan'))->with('Success', 'Data Berhasil di input');
    }

    public function save()
    {

        $data = $this->request->getPost();
        $this->AduanModel->insert($data);
        session()->setFlashdata('pesan', 'Data Aduan Berhasil ditambahkan.');
        return redirect()->to(site_url('User/create_aduan'))->with('Success', 'Data Berhasil di input');
    }
}
