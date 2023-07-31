<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AduanModel;
use App\Models\PengajuanModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $AduanModel;
    protected $PengajuanModel;

    public function __construct()
    {
        $this->AduanModel = new AduanModel();
        $this->PengajuanModel = new PengajuanModel();
    }

    public function dashboard_user()
    {

        $data = [
            'title' => 'Dashboard',
        ];

        echo view('pages/template/header', $data);
        echo view('pages/dashboard/dashboard_user');
        echo view('pages/template/footer');
    }


    public function create_aduan()
    {

        $data = [
            'title' => 'Create Aduan',
        ];

        echo view('pages/template/header', $data);
        echo view('pages/user/aduan/create_aduan');
        echo view('pages/template/footer');
    }

    public function pengajuan()
    {
        echo view('pages/template/header');
        echo view('pages/user/pengajuan/sktp');
        echo view('pages/template/footer');
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



    public function show_layananuser()
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
    public function aduanuser()
    {

        $aduan = $this->AduanModel->findAll();

        $data = [
            'title' => 'Daftar Aduan',
            'aduan' => $aduan
        ];

        echo view('pages/template/header');
        echo view('pages/user/aduan/show_aduanUser', $data);
        echo view('pages/template/footer');
    }


    public function status_aduan()
    {

        $aduan = $this->AduanModel->findAll();

        $data = [
            'title' => 'Status Aduan',
            'aduan' => $aduan
        ];

        echo view('pages/template/header');
        echo view('pages/user/status/status_aduan', $data);
        echo view('pages/template/footer');
    }

    public function status_layanan()
    {

        $layanan = $this->PengajuanModel->findAll();

        $data = [
            'title' => 'Status Layanan',
            'layanan' => $layanan
        ];

        echo view('pages/template/header');
        echo view('pages/user/status/status_layanan', $data);
        echo view('pages/template/footer');
    }

    // Edit Aduan, mengambil parametr id
    public function edit_aduanuser($id)
    {

        $data = [
            'title' => 'Edit Aduan',
            'validation' => \Config\Services::validation(),
            'aduan' => $this->AduanModel->getAduan($id)
        ];

        echo view('pages/template/header');
        echo view('pages/user/aduan/edit_aduanUser', $data);
        echo view('pages/template/footer');
    }

    public function edit_layananuser($id)
    {


        $data = [
            'title' => 'Edit Layanan',
            'validation' => \Config\Services::validation(),
            'layanan' => $this->PengajuanModel->getLayanan($id)
        ];


        echo view('pages/template/header');
        echo view('pages/user/pengajuan/edit_layananUser', $data);
        echo view('pages/template/footer');
    }

    public function update_aduanuser($id)
    {


        $data = $this->request->getPost();
        $this->AduanModel->update($id, $data);


        session()->setFlashdata('pesan', 'Data Aduan Berhasil diubah.');
        return redirect()->to(site_url('User/aduan'))->with('Success', 'Data Berhasil di input');
    }
    public function update_layananuser($id)
    {


        $data = $this->request->getPost();
        $this->PengajuanModel->update($id, $data);


        session()->setFlashdata('pesan', 'Data Layanan SKTP Berhasil diubah.');
        return redirect()->to(site_url('Admin/response_layanan'))->with('Success', 'Data Berhasil di input');
    }

    public function grafik()
    {
    }
}
