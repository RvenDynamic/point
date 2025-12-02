<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Jenis_Pelanggaran;
use App\Models\Kategori;
use App\Models\Pengendara;
use App\Models\Point;
use App\Models\Detail;
use App\Models\Users;
use App\Models\Notif;
use DateTime;
use DateTimeZone;
use Dompdf\Dompdf;

class SuperAdmin extends BaseController
{

    protected $TJenis;
    protected $TKategori;
    protected $TPengendara;
    protected $TUser;
    protected $TPoint;
    protected $TDetail;
    protected $TNotif;
    protected $emailService;

    public function __construct()
    {
        $this->TJenis = new Jenis_Pelanggaran();
        $this->TKategori = new Kategori();
        $this->TPengendara = new Pengendara();
        $this->TNotif = new Notif();
        $this->TUser = new Users();
        $this->TPoint = new Point();
        $this->TDetail = new Detail();
        $this->emailService = \Config\Services::email();
    }

    public function index()
    {
        // Ambil data statistik
        $data['pengendara'] = $this->TPengendara->countAll();
        $data['akun'] = $this->TUser->countAll();
        $data['point'] = $this->TPoint->countAll();

        // Ambil tilang terbaru
        $data['tilang_terbaru'] = $this->TPoint->select('point.*, pengendara.nama_pengendara, jenis_pelanggaran.nama_pelanggaran')
            ->join('pengendara', 'pengendara.id_pengendara = point.id_pengendara')
            ->join('detail', 'point.id_point = detail.id_point')
            ->join('jenis_pelanggaran', 'detail.id_jenis = jenis_pelanggaran.id_jenis')
            ->orderBy('point.created_at', 'DESC')
            ->limit(5) // Ambil 5 tilang terbaru
            ->findAll();
        $data['title'] = 'Dashboard';

        return view('superadmin/dashboard', $data);
    }

    public function dataJenis()
    {

        $kategori = [];
        $search = [];

        $jenis = $this->TJenis->select('jenis_pelanggaran.*, kategori_pelanggaran.kategori as kategori')
            ->join('kategori_pelanggaran', 'kategori_pelanggaran.id_kategori = jenis_pelanggaran.id_kategori')
            ->where($kategori)->like($search)->findAll();

        $data = [
            'title' => 'Data Jenis Pelanggaran',
            'jenis' => $jenis,
            'kategori' => $this->TKategori->findAll(),
        ];

        return view('superadmin/data_jenis', $data);
    }

    public function tambahJenis($id_kategori)
    {
        $kategori = $this->TKategori->where("id_kategori", $id_kategori)->first();
        $jenis = $this->TJenis->select('jenis_pelanggaran.*, kategori_pelanggaran.kategori as kategori')
            ->join('kategori_pelanggaran', 'jenis_pelanggaran.id_kategori = jenis_pelanggaran.id_kategori')->findAll();
        $data = [
            'title' => 'Tambah Jenis',
            'kategori' => $kategori,
            'jenis' => $jenis,
        ];

        return view('superadmin/tambah_jenis', $data);
    }

    public function addJenis()
    {
        helper('form');
        if (!$this->validate([
            'id_kategori' => [
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Kategori harus diisi',
                    'is_natural_no_zero' => 'Kategori tidak boleh kosong',
                ]
            ],
            'nama_pelanggaran' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama Pelanggaran harus diisi',
                    'max_length' => 'Nama Pelanggaran maksimal 100 karakter',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_tambah_jenis', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama_pelanggaran' => $this->request->getVar('nama_pelanggaran'),
        ];

        if (!$this->TJenis->save($data)) {
            session()->setFlashdata('error_tambah_jenis', 'Gagal menambahkan Jenis Pelanggaran');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_tambah_jenis', 'Sukses Menambahkan Jenis Pelanggaran' . $data['nama_pelanggaran']);
        return redirect()->back()->withInput();
    }

    public function editViewjenis($id_jenis)
    {
        $jenis = $this->TJenis->where("id_jenis", $id_jenis)->first();

        $data = [
            'title' => 'Edit Jenis Pelanggaran',
            'jenis' => $jenis,
            'kategori' => $this->TKategori->first()
        ];

        return view('superadmin/edit_jenis', $data);
    }

    public function updateJenis($id_jenis)
    {
        helper('form');
        if (!$this->validate([
            'id_kategori' => [
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Kategori harus diisi',
                    'is_natural_no_zero' => 'Kategori tidak boleh kosong',
                ]
            ],
            'nama_pelanggaran' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Nama Pelanggaran harus diisi',
                    'max_length' => 'Nama Pelanggaran maksimal 100 karakter',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_edit_jenis', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama_pelanggaran' => $this->request->getVar('nama_pelanggaran'),
        ];

        if (!$this->TJenis->update($id_jenis, $data)) {
            session()->setFlashdata('error_edit_jenis', 'Gagal Mengedit Jenis Pelanggaran');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_edit_jenis', 'Sukses Mengedit Jenis Pelanggaran' . $data['nama_pelanggaran']);
        return redirect()->back();
    }

    public function deleteJenis($id_jenis)
    {
        $jenis = $this->TJenis->where('id_jenis', $id_jenis)->first();

        if (!$jenis) {
            session()->setFlashdata('error_delete_jenis', 'Gagal Menghapus Jenis Pelanggaran, Jenis Pelanggaran tidak ada atau tidak terdaftar');
            return redirect()->back();
        }

        if (!$this->TJenis->delete($id_jenis)) {
            session()->setFlashdata('error_delete_jenis', 'Gagal Menghapus Jenis Pelanggaran');
            return redirect()->back();
        }

        session()->setFlashdata('success_delete_jenis', 'Sukses Menghapus Jenis Pelanggaran');
        return redirect()->back();
    }

    // public function tambahJenis($id_kategori)
    // {
    //     $kategori = $this->TKategori->where("id_kategori", $id_kategori)->first();
    //     $data = [
    //         'title' => 'Data Point',
    //         'kategori' => $kategori,
    //         'jenis' => $this->TJenis->findAll(),
    //     ];

    //     return view('superadmin/tambah_jenis', $data);
    // }

    // public function addJenis()
    // {
    //     helper('form');
    //     // Validasi data input
    //     if (!$this->validate([
    //         'id_kategori' => [
    //             'rules' => 'required|max_length[5]',
    //             'errors' => [
    //                 'required' => 'Id Kategori harus diisi',
    //                 'max_length' => 'Id Kategori maksimal 5 karakter',
    //             ]
    //         ],
    //         'nama_pelanggaran' => [
    //             'rules' => 'required|max_length[100]',
    //             'errors' => [
    //                 'required' => 'Nama Pelanggaran harus diisi',
    //                 'max_length' => 'Nama Pelanggaran maksimal 100 karakter',
    //             ]
    //         ],
    //     ])) {
    //         // Jika validasi gagal
    //         $msg_error = $this->validator->listErrors();
    //         session()->setFlashdata('error_tambah_jenis', $msg_error);
    //         return redirect()->back()->withInput();
    //     }

    //     // Ambil data dari form
    //     $id_kategori = $this->request->getVar('id_kategori');
    //     $jenis_array = $this->request->getVar('nama_pelanggaran'); // jenis yang dikirim sebagai array

    //     // Proses setiap jenis yang dikirim
    //     foreach ($jenis_array as $jenis) {
    //         // Siapkan data untuk disimpan
    //         $data = [
    //             'id_kategori' => $id_kategori,
    //             'jenis' => $jenis,
    //         ];

    //         // Simpan data
    //         if (!$this->TJenis->save($data)) {
    //             session()->setFlashdata('error_tambah_jenis', 'Gagal menambahkan Data Jenis');
    //             return redirect()->back()->withInput();
    //         }
    //     }

    //     // Jika semua data berhasil disimpan
    //     session()->setFlashdata('success_tambah_jenis', 'Sukses Menambahkan Data Jenis Pelanggaran');
    //     return redirect()->back()->withInput();
    // }

    // Kategori Pelanggaran
    public function dataKategori()
    {
        $data = [
            'title' => 'Data Kategori Pelanggaran',
            'kategori' => $this->TKategori->findAll(),
        ];

        return view('superadmin/data_kategori', $data);
    }

    public function addKategori()
    {
        helper('form');
        if (!$this->validate([
            'kategori' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Kategori harus diisi',
                    'max_length' => 'Kategori Pelanggaran maksimal 20 karakter',
                ]
            ],
            'bobot_point' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Bobot point harus diisi',
                    'min_length' => 'Bobot Point minimal 1 karakter',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_tambah_kategori', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'kategori' => $this->request->getVar('kategori'),
            'bobot_point' => $this->request->getVar('bobot_point'),
        ];

        if (!$this->TKategori->save($data)) {
            session()->setFlashdata('error_tambah_kategori', 'Gagal menambahkan Kategori Pelanggaran');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_tambah_kategori', 'Sukses Menambahkan Email');
        return redirect()->back()->withInput();
    }

    public function editViewKategori($id_kategori)
    {
        $kategori = $this->TKategori->where("id_kategori", $id_kategori)->first();

        $data = [
            'title' => 'Edit Kategori Pelanggaran',
            'kategori' => $kategori,
        ];

        return view('superadmin/edit_kategori', $data);
    }

    public function updateKategori($id_kategori)
    {
        helper('form');
        if (!$this->validate([
            'kategori' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Kategori harus diisi',
                    'max_length' => 'Kategori Pelanggaran maksimal 20 karakter',
                ]
            ],
            'bobot_point' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Bobot point harus diisi',
                    'min_length' => 'Bobot Point minimal 1 karakter',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_edit_kategori', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'kategori' => $this->request->getVar('kategori'),
            'bobot_point' => $this->request->getVar('bobot_point'),
        ];

        if (!$this->TKategori->update($id_kategori, $data)) {
            session()->setFlashdata('error_edit_kategori', 'Gagal Mengedit Kategori Pelanggaran');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_edit_kategori', 'Sukses Mengedit Kategori Pelanggaran : ' . $data['kategori']);
        return redirect()->back();
    }

    public function deleteKategori($id_kategori)
    {
        $kategori = $this->TKategori->where('id_kategori', $id_kategori)->first();

        if (!$kategori) {
            session()->setFlashdata('error_delete_kategori', 'Gagal Menghapus Kategori Pelanggaran, Kategori Pelanggaran tidak ada atau tidak terdaftar');
            return redirect()->back();
        }

        if (!$this->TKategori->delete($id_kategori)) {
            session()->setFlashdata('error_delete_kategori', 'Gagal Menghapus Kategori Pelanggaran');
            return redirect()->back();
        }

        session()->setFlashdata('success_delete_kategori', 'Sukses Menghapus Kategori Pelanggaran');
        return redirect()->back();
    }

    // Pengendara
    public function dataPengendara()
    {
        // Ambil parameter pencarian dari request
        $searchParams = $this->request->getGet('search');

        // Inisialisasi query builder
        $pengendaraQuery = $this->TPengendara;

        // Jika ada parameter pencarian, terapkan filter
        if ($searchParams) {
            $pengendaraQuery->like('nama_pengendara', $searchParams);
        }

        // Ambil data pengendara
        $data = [
            'title' => 'Data Pengendara',
            'pengendara' => $pengendaraQuery->findAll(),
        ];

        return view('superadmin/data_pengendara', $data);
    }

    public function addPengendara()
    {
        helper('form');
        if (!$this->validate([
            'no_sim' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'No SIM harus diisi',
                    'max_length' => 'No SIM maksimal 20 karakter',
                ]
            ],
            'tipe_sim' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Tipe SIM harus diisi',
                    'min_length' => 'Tipe SIM minimal 1 karakter',
                ]
            ],
            'nama_pengendara' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Pengendara harus diisi',
                    'max_length' => 'Nama Pengendara maksimal 50 karakter',
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Bobot point harus diisi',
                    'min_length' => 'Bobot Point minimal 1 karakter',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Jenis Kelamin harus diisi',
                    'min_length' => 'Jenis Kelamin minimal 1 karakter',
                ]
            ],
            'alamat' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'max_length' => 'Alamat maksimal 100 karakter',
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'Pekerjaan harus diisi',
                    'max_length' => 'Pekerjaan maksimal 10 karakter',
                ]
            ],
            'provinsi' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Provinsi harus diisi',
                    'max_length' => 'Provinsi maksimal 20 karakter',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_tambah_pengendara', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'no_sim' => $this->request->getVar('no_sim'),
            'tipe_sim' => $this->request->getVar('tipe_sim'),
            'nama_pengendara' => $this->request->getVar('nama_pengendara'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'provinsi' => $this->request->getVar('provinsi'),
        ];

        if (!$this->TPengendara->save($data)) {
            session()->setFlashdata('error_tambah_pengendara', 'Gagal menambahkan Data Pengendara');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_tambah_pengendara', 'Sukses Menambahkan Data Pengendara : ' . $data['nama_pengendara']);
        return redirect()->back()->withInput();
    }

    public function editViewPengendara($id_pengendara)
    {
        $pengendara = $this->TPengendara->where("id_pengendara", $id_pengendara)->first();

        $data = [
            'title' => 'Edit Data Pengendara',
            'pengendara' => $pengendara,
        ];

        return view('superadmin/edit_pengendara', $data);
    }

    public function updatePengendara($id_pengendara)
    {
        helper('form');
        if (!$this->validate([
            'no_sim' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'No SIM harus diisi',
                    'max_length' => 'No SIM maksimal 20 karakter',
                ]
            ],
            'tipe_sim' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Tipe SIM harus diisi',
                    'min_length' => 'Tipe SIM minimal 1 karakter',
                ]
            ],
            'nama_pengendara' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Pengendara harus diisi',
                    'max_length' => 'Nama Pengendara maksimal 50 karakter',
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Bobot point harus diisi',
                    'min_length' => 'Bobot Point minimal 1 karakter',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required|min_length[1]',
                'errors' => [
                    'required' => 'Jenis Kelamin harus diisi',
                    'min_length' => 'Jenis Kelamin minimal 1 karakter',
                ]
            ],
            'alamat' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'max_length' => 'Alamat maksimal 100 karakter',
                ]
            ],
            'pekerjaan' => [
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'Pekerjaan harus diisi',
                    'max_length' => 'Pekerjaan maksimal 10 karakter',
                ]
            ],
            'provinsi' => [
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Provinsi harus diisi',
                    'max_length' => 'Provinsi maksimal 20 karakter',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_edit_pengendara', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'no_sim' => $this->request->getVar('no_sim'),
            'tipe_sim' => $this->request->getVar('tipe_sim'),
            'nama_pengendara' => $this->request->getVar('nama_pengendara'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'provinsi' => $this->request->getVar('provinsi'),
        ];

        if (!$this->TPengendara->update($id_pengendara, $data)) {
            session()->setFlashdata('error_edit_pengendara', 'Gagal Mengedit Data Pengendara');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_edit_pengendara', 'Sukses Mengedit Data Pengendara : ' . $data['nama_pengendara']);
        return redirect()->back();
    }

    public function deletePengendara($id_pengendara)
    {
        $pengendara = $this->TPengendara->where('id_pengendara', $id_pengendara)->first();

        if (!$pengendara) {
            session()->setFlashdata('error_delete_pengendara', 'Gagal Menghapus Data Pengendara, Data Pengendara tidak ada atau tidak terdaftar');
            return redirect()->back();
        }

        if (!$this->TPengendara->delete($id_pengendara)) {
            session()->setFlashdata('error_delete_pengendara', 'Gagal Menghapus Data Pengendara');
            return redirect()->back();
        }

        session()->setFlashdata('success_delete_pengendara', 'Sukses Menghapus Data Pengendara');
        return redirect()->back();
    }

    // point
    public function dataPoint($id_pengendara)
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

        return view('superadmin/data_point', $data);
    }

    public function addPoint()
    {
        helper('form');
        if (!$this->validate([
            'id_pengendara' => [
                'rules' => 'required|max_length[5]',
                'errors' => [
                    'required' => 'Id Pengendara harus diisi',
                    'max_length' => 'Id Pengendara maksimal 5 karakter',
                ]
            ],
            'tanggal_sidang' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Tanggal sidang harus diisi',
                    'max_length' => 'Tanggal Point maksimal 50 karakter',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_tambah_point', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'id_pengendara' => $this->request->getVar('id_pengendara'),
            'tanggal_sidang' => $this->request->getVar('tanggal_sidang'),
        ];

        if (!$this->TPoint->save($data)) {
            session()->setFlashdata('error_tambah_point', 'Gagal menambahkan Data Point');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_tambah_point', 'Sukses Menambahkan Data Point');
        return redirect()->back()->withInput();
    }

    public function deletePoint($id_point)
    {
        $point = $this->TPoint->where('id_point', $id_point)->first();

        if (!$point) {
            session()->setFlashdata('error_delete_point', 'Gagal Menghapus Data Point, Data Point tidak ada atau tidak terdaftar');
            return redirect()->back();
        }

        if (!$this->TPoint->delete($id_point)) {
            session()->setFlashdata('error_delete_point', 'Gagal Menghapus Data Point');
            return redirect()->back();
        }

        session()->setFlashdata('success_delete_point', 'Sukses Menghapus Data Point');
        return redirect()->back();
    }

    public function detailPoint($id_point)
    {
        $point = $this->TPoint->where("id_point", $id_point)->first();
        $detail = $this->TDetail->select('detail.*, jenis_pelanggaran.nama_pelanggaran as nama_pelanggaran')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id_jenis = detail.id_jenis')->findAll();
        $data = [
            'title' => 'Data Point',
            'point' => $point,
            'jenis' => $this->TJenis->findAll(),
            'detail' => $detail,
        ];

        return view('superadmin/detail_point', $data);
    }

    public function addDetail()
    {
        helper('form');
        // Validasi data input
        if (!$this->validate([
            'id_point' => [
                'rules' => 'required|max_length[5]',
                'errors' => [
                    'required' => 'Id Point harus diisi',
                    'max_length' => 'Id Point maksimal 5 karakter',
                ]
            ],
            'id_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id Jenis harus diisi',
                ]
            ],
        ])) {
            // Jika validasi gagal
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_tambah_detail', $msg_error);
            return redirect()->back()->withInput();
        }

        // Ambil data dari form
        $id_point = $this->request->getVar('id_point');
        $id_jenis_array = $this->request->getVar('id_jenis'); // id_jenis yang dikirim sebagai array

        // Proses setiap id_jenis yang dikirim
        foreach ($id_jenis_array as $id_jenis) {
            // Siapkan data untuk disimpan
            $data = [
                'id_point' => $id_point,
                'id_jenis' => $id_jenis,
            ];

            // Simpan data
            if (!$this->TDetail->save($data)) {
                session()->setFlashdata('error_tambah_detail', 'Gagal menambahkan Data Point');
                return redirect()->back()->withInput();
            }
        }

        // Ambil data pengendara berdasarkan id_point untuk mendapatkan email
        $point = $this->TPoint->find($id_point);
        $pengendara = $this->TPengendara->find($point['id_pengendara']);

        // Cek apakah email pengendara tersedia
        if (!empty($pengendara['email'])) {
            // Ambil nama pelanggaran berdasarkan ID
            $nama_pelanggaran_array = [];
            if (!empty($id_jenis_array)) {
                $nama_pelanggaran_array = $this->TJenis->whereIn('id_jenis', $id_jenis_array)->findColumn('nama_pelanggaran');
            }
            // Generate pesan untuk email
            $email_subject = "Pemberian Point Pelanggaran";
            $email_message = view('utils/email/notif_pelanggaran', [
                'nama_pengendara' => $pengendara['nama_pengendara'],
                'point' => $id_point, // ID Point yang diberikan
                'jenis_pelanggaran' => implode(", ", $nama_pelanggaran_array), // Jenis pelanggaran yang diberikan
                'tanggal_sidang' => $point['tanggal_sidang'],
            ]);

            // Mengirim email ke pengendara
            $this->emailService->setFrom('firmanferdiansyah74@gmail.com', 'Firman Ferdiansyah');
            $this->emailService->setTo($pengendara['email']);
            $this->emailService->setSubject($email_subject);
            $this->emailService->setMessage($email_message);

            if (!$this->emailService->send()) {
                session()->setFlashdata('error_tambah_detail', 'Gagal mengirim email pemberitahuan.');
                return redirect()->back()->withInput();
            }
        }

        // Jika semua data berhasil disimpan
        session()->setFlashdata('success_tambah_detail', 'Sukses Menambahkan Data Point dan Mengirim Pemberitahuan Email');
        return redirect()->back()->withInput();
    }

    public function editDetail($id_point)
    {
        $detail_point = $this->TDetail->where('id_point', $id_point)->findAll();
        $point = $this->TPoint->where("id_point", $id_point)->first();
        $detail = $this->TDetail->select('detail.*, jenis_pelanggaran.nama_pelanggaran as nama_pelanggaran')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id_jenis = detail.id_jenis')->findAll();
        $data = [
            'title' => 'Data Point',
            'point' => $point,
            'jenis' => $this->TJenis->findAll(),
            'detail' => $detail,
            'detail_point' => $detail_point,
        ];

        return view('superadmin/edit_detail', $data);
    }

    public function updateDetail()
    {
        helper('form');
        // Validasi data input
        if (!$this->validate([
            'id_point' => [
                'rules' => 'required|max_length[5]',
                'errors' => [
                    'required' => 'Id Point harus diisi',
                    'max_length' => 'Id Point maksimal 5 karakter',
                ]
            ],
            'id_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id Jenis harus diisi',
                ]
            ],
        ])) {
            // Jika validasi gagal
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_update_detail', $msg_error);
            return redirect()->back()->withInput();
        }

        // Ambil data dari form
        $id_point = $this->request->getVar('id_point');
        $id_jenis_array = $this->request->getVar('id_jenis'); // id_jenis yang dikirim sebagai array

        // Hapus detail lama sebelum menambahkan yang baru
        $this->TDetail->where('id_point', $id_point)->delete();

        // Proses setiap id_jenis yang dikirim
        foreach ($id_jenis_array as $id_jenis) {
            // Siapkan data untuk disimpan
            $data = [
                'id_point' => $id_point,
                'id_jenis' => $id_jenis,
            ];

            // Simpan data
            if (!$this->TDetail->save($data)) {
                session()->setFlashdata('error_update_detail', 'Gagal memperbarui Data Point');
                return redirect()->back()->withInput();
            }
        }

        // Ambil data pengendara berdasarkan id_point untuk mendapatkan email
        $point = $this->TPoint->find($id_point);
        $pengendara = $this->TPengendara->find($point['id_pengendara']);

        // Cek apakah email pengendara tersedia
        if (!empty($pengendara['email'])) {
            $nama_pelanggaran_array = [];
            if (!empty($id_jenis_array)) {
                $nama_pelanggaran_array = $this->TJenis->whereIn('id_jenis', $id_jenis_array)->findColumn('nama_pelanggaran');
            }
            // Generate pesan untuk email
            $email_subject = "Pemberian Point Pelanggaran";
            $email_message = view('utils/email/notif_pelanggaran', [
                'nama_pengendara' => $pengendara['nama_pengendara'],
                'point' => $id_point, // ID Point yang diberikan
                'jenis_pelanggaran' => implode(", ", $nama_pelanggaran_array), // Jenis pelanggaran yang diberikan
                'tanggal_sidang' => $point['tanggal_sidang'],
            ]);

            // Mengirim email ke pengendara
            $this->emailService->setFrom('firmanferdiansyah74@gmail.com', 'Firman Ferdiansyah');
            $this->emailService->setTo($pengendara['email']);
            $this->emailService->setSubject($email_subject);
            $this->emailService->setMessage($email_message);

            if (!$this->emailService->send()) {
                session()->setFlashdata('error_update_detail', 'Gagal mengirim email pemberitahuan.');
                return redirect()->back()->withInput();
            }
        }

        // Jika semua data berhasil disimpan
        session()->setFlashdata('success_update_detail', 'Sukses Memperbarui Data Point dan Mengirim Pemberitahuan Email');
        return redirect()->back(); // Redirect ke halaman detail point
    }

    public function viewNotif()
    {
        $data = [
            'title' => 'pengelolaan notifikasi',
            'notif' => $this->TNotif->findAll(),
        ];

        return view('superadmin/notif', $data);
    }

    public function addNotif()
    {
        helper('form');
        if (!$this->validate([
            'notif' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Judul Notif harus diisi',
                    'max_length' => 'Judul Notif maksimal 100 karakter',
                ]
            ],
            'pesan' => [
                'rules' => 'required|max_length[250]',
                'errors' => [
                    'required' => 'Pesan harus diisi',
                    'max_length' => 'Pesan maksimal 250 karakter',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_tambah_notif', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'notif' => $this->request->getVar('notif'),
            'pesan' => $this->request->getVar('pesan'),
        ];

        if (!$this->TNotif->save($data)) {
            session()->setFlashdata('error_tambah_notif', 'Gagal menambahkan Notif');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_tambah_notif', 'Sukses Menambahkan Notif : ');
        return redirect()->back()->withInput();
    }

    public function aktifNotif($id_notif)
    {
        $notif = $this->TNotif->where('id_notif', $id_notif)->first();

        if (!$notif) {
            session()->setFlashdata('error_active', 'data notif tidak ditemukan');
            return redirect()->back();
        }

        if (!$this->TNotif->update($notif['id_notif'], ['is_active' => true])) {
            session()->setFlashdata('error_active', 'gagal mengaktifkan notif ' . $notif['notif']);
            return redirect()->back();
        }

        // send email to satlantas
        $users = $this->TUser->where('role', 'satlantas')->findAll();

        if (empty($users)) {
            session()->setFlashdata('error_active', 'tidak ada user satlantas');
            return redirect()->back();
        }

        $this->emailService->setFrom('firmanferdiansyah74@gmail.com', 'Firman Ferdiansyah');
        $this->emailService->setSubject('Notifikasi Pemberitahuan');
        $this->emailService->setHeader('Reply-To', 'firmanferdiansyah74@gmail.com');
        $this->emailService->setHeader('List-Unsubscribe', '<mailto:unsubscribe@yourdomain.com>');
        $this->emailService->setMailType('html');

        $data = [
            'username' => '',
            'pesan' => $notif['pesan']
        ];

        foreach ($users as $user) {
            $this->emailService->setTo($user['email']);

            $data['username'] = $user['username'];

            $msgView = view('utils/email/notif', $data);

            $this->emailService->setMessage($msgView);

            if (!$this->emailService->send()) {
                session()->setFlashdata('error_active', 'Gagal mengirim email ke ' . $user['email']);
                return redirect()->back();
            }
        }

        session()->setFlashdata('success_active', 'sukses mengaktifkan notif ' . $notif['notif']);
        return redirect()->back();
    }

    public function nonaktifNotif($id_notif)
    {
        $notif = $this->TNotif->where('id_notif', $id_notif)->first();

        if (!$notif) {
            session()->setFlashdata('error_active', 'data notif tidak ditemukan');
            return redirect()->back();
        }

        if (!$this->TNotif->update($notif['id_notif'], ['is_active' => false])) {
            session()->setFlashdata('error_active', 'gagal non-aktifkan notif ' . $notif['notif']);
            return redirect()->back();
        }

        session()->setFlashdata('success_active', 'sukses non-aktifkan notif ' . $notif['notif']);
        return redirect()->back();
    }

    public function kelolaAkun()
    {
        $data = [
            'title' => 'data user akun',
            'users' => $this->TUser->findAll(),
        ];

        return view('superadmin/kelola_akun', $data);
    }

    // public function viewLaporan()
    // {
    //     $start_date = $this->request->getVar('start_date');
    //     $end_date = $this->request->getVar('end_date');

    //     // Ambil data pengendara berdasarkan rentang tanggal
    //     $data['pengendara'] = $this->TPengendara->select('pengendara.*, point.created_at, jenis_pelanggaran.nama_pelanggaran')
    //         ->join('point', 'pengendara.id_pengendara = point.id_pengendara')
    //         ->join('detail', 'point.id_point = detail.id_point')
    //         ->join('jenis_pelanggaran', 'detail.id_jenis = jenis_pelanggaran.id_jenis')
    //         ->where('DATE(point.tanggal_sidang) >=', $start_date)
    //         ->where('DATE(point.tanggal_sidang) <=', $end_date)
    //         ->get()
    //         ->getResultArray();

    //     $data['title'] = 'Laporan Pengendara';
    //     $data['start_date'] = $start_date;
    //     $data['end_date'] = $end_date;
    //     return view('superadmin/laporan', $data);
    // }

    public function laporan()
    {
        $start_date = $this->request->getVar('start_date');
        $end_date = $this->request->getVar('end_date');

        // Validasi tanggal
        if (!$start_date || !$end_date) {
            session()->setFlashdata('error', 'Tanggal awal dan akhir harus diisi.');
            return redirect()->back();
        }

        // Ambil data pengendara berdasarkan rentang tanggal
        $data['pengendara'] = $this->TPoint->select('pengendara.*, point.tanggal_sidang, point.created_at, jenis_pelanggaran.nama_pelanggaran')
            ->join('pengendara', 'pengendara.id_pengendara = point.id_pengendara')
            ->join('detail', 'point.id_point = detail.id_point')
            ->join('jenis_pelanggaran', 'detail.id_jenis = jenis_pelanggaran.id_jenis')
            ->where('point.created_at >=', $start_date)
            ->where('point.created_at <=', $end_date)
            ->get()
            ->getResultArray();

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['username'] = session()->get('username');

        // Load view untuk laporan
        $html = view('superadmin/hasil_laporan', $data);

        // Buat PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF
        $dompdf->stream('laporan_pengendara_' . date('Ymd') . '.pdf', ['Attachment' => 0]);
    }

    public function viewLaporan()
    {
        $start_date = $this->request->getVar('start_date');
        $end_date = $this->request->getVar('end_date');
        $data['pengendara'] = $this->TPengendara->select('pengendara.*, point.created_at, jenis_pelanggaran.nama_pelanggaran')
            ->join('point', 'pengendara.id_pengendara = point.id_pengendara')
            ->join('detail', 'point.id_point = detail.id_point')
            ->join('jenis_pelanggaran', 'detail.id_jenis = jenis_pelanggaran.id_jenis')
            ->where('DATE(point.created_at)', $start_date)
            ->where('DATE(point.created_at)', $end_date)
            ->get()
            ->getResultArray();

        $data['title'] = 'Laporan Pengendara';
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        return view('superadmin/laporan', $data);
    }

    // public function laporan()
    // {
    //     $year = $this->request->getVar('year');
    //     // $data['pengendara'] = $this->TPengendara->getLaporan($year);
    //     $data['pengendara'] = $this->TPoint->select('pengendara.*, point.created_at, jenis_pelanggaran.nama_pelanggaran')
    //         ->join('pengendara', 'pengendara.id_pengendara = point.id_pengendara')
    //         ->join('detail', 'point.id_point = detail.id_point')
    //         ->join('jenis_pelanggaran', 'detail.id_jenis = jenis_pelanggaran.id_jenis')
    //         ->where('YEAR(point.created_at)', $year)
    //         ->get()
    //         ->getResultArray();

    //     $data['title'] = 'Laporan Pengendara Tahun ' . $year;

    //     // Load view untuk laporan
    //     $html = view('superadmin/hasil_laporan', $data);

    //     // Buat PDF
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();

    //     // Output PDF
    //     $dompdf->stream('laporan_pengendara_' . $year . '.pdf', ['Attachment' => 0]);
    // }

    public function gantiPassword()
    {
        $data = [
            'title' => 'ganti password super admin',
        ];

        return view('superadmin/ganti_password', $data);
    }
}
