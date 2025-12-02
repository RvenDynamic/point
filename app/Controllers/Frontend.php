<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Pengendara;
use App\Models\Point;
use App\Models\Detail;

class Frontend extends BaseController
{
    protected $TPengendara;
    protected $TPoint;
    protected $TDetail;

    public function __construct()
    {
        $this->TPengendara = new Pengendara();
        $this->TPoint = new Point();
        $this->TDetail = new Detail();
    }

    public function index()
    {
        // Ambil parameter pencarian dari request
        $searchParams = $this->request->getGet('name');
        $searchParams2 = $this->request->getGet('idNumber');

        // Inisialisasi query builder
        $pengendaraQuery = $this->TPengendara;

        // Jika ada parameter pencarian, terapkan filter
        if ($searchParams) {
            $pengendaraQuery->where('nama_pengendara', $searchParams);
        }

        if ($searchParams2) {
            $pengendaraQuery->where('no_sim', $searchParams2);
        }

        // Ambil data pengendara
        $data = [
            'title' => 'Pengendara',
            'pengendara' => $pengendaraQuery->findAll(),
        ];

        return view('pengendara/index', $data);
    }

    public function dataPengendara($id_pengendara)
    {
        $detail = $this->TDetail->select('detail.*, jenis_pelanggaran.nama_pelanggaran, jenis_pelanggaran.id_jenis, kategori_pelanggaran.bobot_point, point.id_pengendara')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id_jenis = detail.id_jenis')
            ->join('point', 'point.id_point = detail.id_point')
            ->join('pengendara', 'point.id_pengendara = pengendara.id_pengendara')
            ->join('kategori_pelanggaran', 'kategori_pelanggaran.id_kategori = jenis_pelanggaran.id_kategori')
            ->where('point.id_pengendara', $id_pengendara)
            ->findAll();

        // Hitung total bobot_point
        $total_point = 0;
        foreach ($detail as $row) {
            $total_point += $row['bobot_point'];
        }

        $point_total = $total_point % 12; // Menggunakan modulus untuk mendapatkan nilai 1-12
        if ($point_total == 0) {
            $point_total = 0; // Jika total_point adalah kelipatan 12, tampilkan 12
        }

        // Ambil jumlah point untuk setiap id_point
        $jumlah_point = [];
        foreach ($detail as $row) {
            $id_point = $row['id_point'];
            if (!isset($jumlah_point[$id_point])) {
                $jumlah_point[$id_point] = 0; // Inisialisasi jika belum ada
            }
            $jumlah_point[$id_point] += $row['bobot_point']; // Tambahkan bobot_point untuk id_point ini
        }

        $pengendara = $this->TPengendara->where("id_pengendara", $id_pengendara)->first();

        $data = [
            'title' => 'Data Point',
            'point' => $this->TPoint->where('id_pengendara', $id_pengendara)->findAll(),
            'pengendara' => $pengendara,
            'total_point' => $point_total,
            'jumlah_point' => $jumlah_point, // Simpan jumlah_points sebagai array
        ];

        return view('pengendara/data_pengendara', $data);
    }

    // public function search($id_pengendara)
    // {
    //     // Ambil input dari form
    //     $name = $this->request->getPost('name');
    //     $idNumber = $this->request->getPost('idNumber');

    //     // Lakukan pencarian di database
    //     $pengendara = $this->TPengendara->like('nama_pengendara', $name)
    //         ->orLike('no_sim', $idNumber)
    //         ->findAll();
    //     $detail = $this->TDetail->select('detail.*, jenis_pelanggaran.nama_pelanggaran, jenis_pelanggaran.id_jenis, kategori_pelanggaran.bobot_point')
    //         ->join('jenis_pelanggaran', 'jenis_pelanggaran.id_jenis = detail.id_jenis')
    //         ->join('kategori_pelanggaran', 'kategori_pelanggaran.id_kategori = jenis_pelanggaran.id_kategori') // Bergabung dengan kategori untuk mendapatkan bobot_point
    //         ->findAll();
    //     $point = $this->TPoint->select('point.*')
    //         ->join('pengendara', 'pengendara.id_pengendara = point.id_pengendara')
    //         ->where('id_pengendara', $id_pengendara);

    //     // Hitung total bobot_point
    //     $total_point = 0;
    //     foreach ($detail as $row) {
    //         $total_point += $row['bobot_point'];
    //     }
    //     $data = [
    //         'title' => 'Data Point',
    //         'point' => $point,
    //         'pengendara' => $pengendara,
    //         'total_point' => $total_point,
    //     ];

    //     // Kembalikan hasil pencarian ke view
    //     return view('pengendara/data_pengendara', ['pengendara' => $pengendara]);
    // }

    public function tambahEmail($id_pengendara)
    {
        $pengendara = $this->TPengendara->where("id_pengendara", $id_pengendara)->first();

        $data = [
            'title' => 'Tambah Email Pengendara',
            'pengendara' => $pengendara
        ];

        return view('pengendara/tambah_email', $data);
    }

    public function addEmail($id_pengendara)
    {
        helper('form');
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'email tidak valid',
                    'is_unique' => 'email sudah digunakan sebelumnya'
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_tambah_email', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'email' => $this->request->getPost('email'),
        ];

        if (!$this->TPengendara->update($id_pengendara, $data)) {
            session()->setFlashdata('error_tambah_email', 'Gagal Menambah Email');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_tambah_jenis', 'Sukses Menambah Email' . $data['email']);
        return redirect()->back();
    }
}
