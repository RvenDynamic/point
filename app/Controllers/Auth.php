<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;
use App\Models\LupaPassword;
use App\Models\UserLog;

class Auth extends BaseController
{
    protected $TUser;
    protected $TUserLog;
    protected $TLupaPassword;
    protected $emailService;

    public function __construct()
    {
        $this->TUser = new Users();
        $this->TUserLog = new UserLog();
        $this->TLupaPassword = new LupaPassword();
        $this->emailService = \Config\Services::email();
    }

    public function login()
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
        ];

        $userAgent = $this->request->getUserAgent();
        $dataIsLogin = [
            'ip_address' => $this->request->getIPAddress(),
            'device' => $userAgent->getAgentString(),
        ];

        if ($data['username'] == null || $data['password'] == null) {
            session()->setFlashdata('error_login', 'Username dan Password harus diisi');
            return redirect()->back();
        }

        $user = $this->TUser->select("users.*")->where('username', $data['username'])->first();

        if ($user) {
            // email verifikasi
            if ($user['is_verified'] == false) {
                session()->setFlashdata('error_login', 'Akun belum diverifikasi, silahkan cek email anda');
                return redirect()->back();
            }

            // cek user login atau tidak
            $isLogin = $this->TUserLog->where("id_user", $user['id_user'])->first();

            if ($isLogin) {
                if ($isLogin['device'] !== $dataIsLogin['device']) {
                    // mengirim email ke user
                    $sendDataEmailIsLogin = [
                        "username" => $user['username'],
                        "email" => $user['email'],
                        "device" => $dataIsLogin['device'],
                    ];

                    // kirim email
                    $this->emailService->setFrom('firmanferdiansyah74@gmail.com', 'Firman Ferdiansyah');
                    $this->emailService->setTo($user['email']);
                    $this->emailService->setSubject('Terdeteksi Percobaan Login Pada Perangkat Lain');

                    $this->emailService->setHeader('Reply-To', 'firmanferdiansyah74@gmail.com');
                    $this->emailService->setHeader('List-Unsubcribe', '<mailto:unsubscribe@yourdomain.com>');

                    $this->emailService->setMailType('html');

                    $msgViewIsLogin = view('utils/email/login_another_device', $sendDataEmailIsLogin);
                    $this->emailService->setMessage($msgViewIsLogin);

                    if (!$this->emailService->send()) {
                        session()->setFlashdata('error_login', 'Gagal Mengirim Email');
                        return redirect()->back();
                    }

                    session()->setFlashdata('error_login', 'Anda sudah login di perangkat lain');
                    return redirect()->back();
                } else {
                    // proses login biasa
                    $pass = $data['password'];
                    $authenticatedPassword = password_verify($pass, $user['password']);

                    if ($authenticatedPassword) {
                        $sessionUser = [
                            'uid' => $user['id_user'],
                            'password' => $user['password'],
                            'role' => $user['role'],
                            'email' => $user['email'],
                            'isLogin' => true,
                        ];
                        session()->set($sessionUser);

                        $role = $user['role'];
                        if ($role == 'superadmin') {
                            return redirect()->to('/superadmin');
                        } else {
                            return redirect()->to('/admin');
                        }
                    } else {
                        session()->setFlashdata('error_login', 'Password salah');
                        return redirect()->back();
                    }
                }
            } else {
                $pass = $data['password'];
                $authenticatedPassword = password_verify($pass, $user['password']);
                if ($authenticatedPassword) {
                    $sessionUser = [
                        'uid' => $user['id_user'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'isLogin' => true,
                    ];
                    session()->set($sessionUser);

                    // simpan log user
                    $dataUserLogSave = [
                        "id_user" => $user['id_user'],
                        "device" => $dataIsLogin['device'],
                        "ip_address" => $dataIsLogin['ip_address'],
                    ];

                    if (!$this->TUserLog->save($dataUserLogSave)) {
                        session()->setFlashdata('error_login', 'Gagal menyimpan log user');
                        return redirect()->back();
                    }

                    $role = $user['role'];
                    if ($role == 'superadmin') {
                        return redirect()->to('/superadmin');
                    } else {
                        return redirect()->to('/admin');
                    }
                } else {
                    session()->setFlashdata('error_login', 'Password salah');
                    return redirect()->back();
                }
            }
        } else {
            session()->setFlashdata('error_login', 'Username tidak ditemukan');
            return redirect()->back();
        }
    }

    public function register()
    {
        helper(['form']);
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[5]|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 5 karakter',
                    'max_length' => '{field} maksimal 50 karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'email tidak valid',
                    'is_unique' => 'email sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 8 Karakter',
                ]
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role Harus diisi'
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_register', $msg_error);
            return redirect()->back()->withInput();
        }

        // generate kode verifikasi
        $verification_code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 10)), 0, 10);

        // mengirim email
        $this->emailService->setFrom('firmanferdiansyah74@gmail.com', 'Firman Ferdiansyah');
        $this->emailService->setTo($this->request->getVar('email'));
        $this->emailService->setSubject('Verification Code');

        $this->emailService->setHeader('Reply-To', 'firmanferdiansyah74@gmail.com');
        $this->emailService->setHeader('List-Unsubscribe', '<mailto:unsubscribe@yourdomain.com>');

        $msgViewData = [
            'username' => $this->request->getVar('username'),
            'verification_code' => $verification_code,
        ];

        $msgView = view('utils/email/verification_email_account', $msgViewData);
        $this->emailService->setMailType('html');
        $this->emailService->setMessage($msgView);

        if (!$this->emailService->send()) {
            session()->setFlashdata('error_register', 'Gagal mengirim email');
            return redirect()->back();
        }

        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role' => $this->request->getVar('role'),
            'verification_code' => $verification_code,
        ];

        if (!$this->TUser->save($data)) {
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('success_register', 'Berhasil Membuat Akun');
        return redirect()->to('/superadmin/kelola-akun');
    }

    public function verifikasiAkun($verification_code)
    {
        $user = $this->TUser->where('verification_code', $verification_code)->first();

        if (!$user) {
            session()->setFlashdata('error_verifikasi_akun', 'Code tidak valid');
            return redirect()->to('/error-verifikasi-akun');
        }

        if ($user['is_verified'] == true) {
            session()->setFlashdata('error_verifikasi_akun', 'Akun sudah diverifikasi');
            return redirect()->to('/error-verifikasi-akun');
        }

        if (!$this->TUser->set('is_verified', true)->set('verification_code', null)->where('id_user', $user['id_user'])->update()) {
            session()->setFlashdata('error_verifikasi_akun', 'Gagal verifikasi akun');
            return redirect()->to('/error-verifikasi-akun');
        }

        session()->setFlashdata('success_verifikasi_akun', 'Berhasil verifikasi akun');
        return redirect()->to('/');
    }

    public function kirimEmailLupaPassword()
    {
        helper(['form']);
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'valid_email' => '{field} tidak valid',
                ]
            ],
        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_lupa_password', $msg_error);
            return redirect()->back()->withInput();
        }

        $email = $this->request->getVar('email');

        // user is exist
        $user = $this->TUser->where('email', $email)->first();
        if (!$user) {
            session()->setFlashdata('error_lupa_password', 'Email tidak ditemukan');
            return redirect()->back();
        }

        // create kode
        $kode = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
        $data = [
            'id_user' => $user['id_user'],
            'kode' => $kode,
        ];

        // save to db 
        if (!$this->TLupaPassword->save($data)) {
            session()->setFlashdata('error_lupa_password', 'Gagal generate kode');
            return redirect()->back();
        }

        // kirim email
        $this->emailService->setFrom('firmanferdiansyah74@gmail.com', 'Firman Ferdiansyah');
        $this->emailService->setTo($email);
        $this->emailService->setSubject('Lupa Password');

        $this->emailService->setHeader('Reply-To', 'firmanferdiansyah74@gmail.com');
        $this->emailService->setHeader('List-Unsubscribe', '<mailto:unsubscribe@yourdomain.com>');

        $templateView = view('utils/email/lupa_password', ['username' => $user['username'], 'kode' => $kode, 'email' => $email]);
        $this->emailService->setMailType('html');
        $this->emailService->setMessage($templateView);

        if (!$this->emailService->send()) {
            session()->setFlashdata('error_lupa_password', 'Gagal mengirim email');
            return redirect()->back();
        }

        session()->setFlashdata('success_lupa_password', 'Berhasil mengirim kode untuk mengubah password, silahkan cek email anda');
        return redirect()->to('/reset-password');
    }

    public function resetPassword()
    {
        helper(['form']);
        if (!$this->validate([
            'kode' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 3 Karakter',
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 8 Karakter',
                ]
            ],
            'confirm_password' => [
                'rules' => 'matches[new_password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password baru',

                ]
            ],
        ])) {
            $msg = $this->validator->listErrors();
            session()->setFlashdata('error_lupa_password', $msg);
        }

        $data = [
            'kode' => $this->request->getVar('kode'),
            'new_password' => $this->request->getVar('new_password'),
        ];

        $ifCodeExist = $this->TLupaPassword->where('kode', $data['kode'])->first();
        if (!$ifCodeExist) {
            session()->setFlashdata('error_lupa_password', 'Kode tidak valid');
            return redirect()->back();
        }

        $id_user = $ifCodeExist['id_user'];

        // update user password
        $new_password = password_hash($data['new_password'], PASSWORD_BCRYPT);
        if (!$this->TUser->set('password', $new_password)->where('id_user', $id_user)->update()) {
            session()->setFlashdata('error_lupa_password', 'Gagal mengganti password');
            return redirect()->back();
        }

        // delete code
        if (!$this->TLupaPassword->where('id_user', $id_user)->delete()) {
            session()->setFlashdata('error_lupa_password', 'internal server error: delete code');
            return redirect()->to('/');
        }

        session()->setFlashdata('success_lupa_password', 'Berhasil mengganti password');
        return redirect()->to('/login');
    }

    public function gantiPassword()
    {
        helper(['form']);
        if (!$this->validate([
            'old_password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 8 Karakter',
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 8 Karakter',
                ]
            ],
            'confirm_password' => [
                'rules' => 'matches[new_password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password baru',
                ]
            ],

        ])) {
            $msg_error = $this->validator->listErrors();
            session()->setFlashdata('error_ganti_password', $msg_error);
            return redirect()->back()->withInput();
        }

        $data = [
            'uid' => user('uid'),
            'old_password' => $this->request->getVar('old_password'),
            'new_password' => $this->request->getVar('new_password'),
        ];

        // is user exist
        $user = $this->TUser->where('id_user', $data['uid'])->first();
        if (!$user) {
            session()->setFlashdata('error_ganti_password', 'User tidak ditemukan');
            return redirect()->back();
        }

        // is old password correct
        $authenticatedPassword = password_verify($data['old_password'], $user['password']);
        if (!$authenticatedPassword) {
            session()->setFlashdata('error_ganti_password', 'Password lama salah');
            return redirect()->back();
        }

        // change password
        $new_password = password_hash($data['new_password'], PASSWORD_BCRYPT);
        if (!$this->TUser->set('password', $new_password)->where('id_user', $data['uid'])->update()) {
            session()->setFlashdata('error_ganti_password', 'Gagal mengganti password');
            return redirect()->back();
        }

        session()->setFlashdata('success_ganti_password', 'Berhasil mengganti password');
        return redirect()->back();
    }

    public function deleteAkun($id_user)
    {
        if (!$this->TUser->where('id_user', $id_user)->delete()) {
            session()->setFlashdata('error_delete_akun', 'Gagal menghapus akun');
            return redirect()->back();
        }

        session()->setFlashdata('success_delete_akun', 'Berhasil menghapus akun');
        return redirect()->back();
    }

    public function logout()
    {
        // delete user log
        $id_user = user('uid');

        if (!$this->TUserLog->where('id_user', $id_user)->delete()) {
            session()->setFlashdata('error_logout', 'Gagal menghapus log user');
            return redirect()->back();
        }

        session()->destroy();
        return redirect()->to('/');
    }

    public function unauthorized()
    {
        return view('errors/unauthorized');
    }

    public function errorVerifikasiAkun()
    {
        return view('errors/verifikasi-akun');
    }
}
