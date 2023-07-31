<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\User_loginModel;
use App\Controllers\BaseController;
use App\Models\RoleModel;


class Auth extends BaseController
{
    public function index()
    {
        if (session('id')) {
            return redirect()->to(site_url('Admin/dashboard'));
        }
        return view('auth/login');
    }

    public function regis()
    {
        return view('auth/register');
    }
    public function forget_pass()
    {
        return view('auth/forget_password');
    }
    public function reset_pass()
    {
        return view('auth/reset_password');
    }

    public function change_pass()
    {

        echo view('pages/template/header');
        echo view('auth/change_password');
        echo view('pages/template/footer');
    }

    public function change_passuser()
    {

        echo view('pages/template/header');
        echo view('auth/change_passwordUser');
        echo view('pages/template/footer');
    }


    // public function login()
    // {
    //     $session = session();

    //     $username = $this->request->getVar('username');
    //     $password = $this->request->getVar('password');

    //     $userModel = new User_loginModel();
    //     $user = $userModel->where('username', $username)->first();

    //     if ($user) {
    //         if (password_verify($password, $user['password'])) {
    //             $roleModel = new RoleModel();
    //             $role = $roleModel->find($user['role']);

    //             // Set user session
    //             $userData = [
    //                 'id' => $user['id'],
    //                 'username' => $user['username'],
    //                 'role' => $role['name'],
    //                 'isLoggedIn' => true,
    //             ];

    //             $session = session();
    //             $session->set($userData);
    //         } else {
    //             return redirect()->back()->with('error', 'Password tidak ditemukan');
    //         }
    //     } else {

    //         return redirect()->back()->with('error', 'Username tidak ditemukan');
    //     }
    // }

    public function register()
    {


        $userModel = new User_loginModel();
        // $roleModel = new RoleModel();

        $data = [
            'username' => $this->request->getVar('username'),
            'email'    => $this->request->getVar('email'),
            'role'    => $this->request->getVar('role'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];

        $userModel->insert($data);

        // Redirect to login page or any other page after successful registration
        return redirect()->to('Auth/index');
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('Auth/index');
    }

    // public function sendEmail()
    // {
    //     $email = $this->request->getVar('email');

    //     // Check if the email exists in the database
    //     $userModel = new User_loginModel();
    //     $user = $userModel->where('email', $email)->first();

    //     if (!$user) {
    //         // Handle email not found
    //         echo "Email not found";
    //         return;
    //     }

    //     // Generate a unique token
    //     $token = bin2hex(random_bytes(32));

    //     // Save the token to the database for the given email
    //     $db = db_connect();
    //     $db->table('userss')->insert([
    //         'email' => $email,
    //         'token' => $token,
    //     ]);

    //     // Send the reset password link to the user's email (you can use your preferred email library for this)
    //     $resetLink = base_url("Auth/reset/$token");
    //     // Use your email library to send the resetLink to the user's email

    //     // Display a message to the user that the reset link has been sent
    //     echo "Reset link has been sent to your email address";
    // }

    // public function reset($token)
    // {
    //     $db = db_connect();
    //     $resetRow = $db->table('userss')->where('token', $token)->get()->getRow();

    //     if (!$resetRow) {
    //         // Handle invalid or expired token
    //         echo "Invalid or expired token";
    //         return;
    //     }

    //     $data = [
    //         'email' => $resetRow->email,
    //     ];

    //     echo view('Auth/reset_password', $data);
    // }

    // public function process_reset()
    // {
    //     $email = $this->request->getVar('email');
    //     $password = $this->request->getVar('password');

    //     // Update the user's password in the database
    //     $userModel = new User_loginModel();
    //     $userModel->where('email', $email)->set(['password' => password_hash($password, PASSWORD_DEFAULT)])->update();

    //     // Delete the password reset token from the database
    //     $db = db_connect();
    //     $db->table('userss')->where('email', $email)->delete();

    //     // Display a message to the user that the password has been reset
    //     echo "Password has been reset successfully";
    // }

    public function login()
    {
        $session = session();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userModel = new User_loginModel();
        $user = $userModel->where('username', $username)->first();



        if ($user) {
            if (password_verify($password, $user['password'])) {

                $userData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => true
                ];

                session()->set($userData);

                if ($user['role'] === '1') {
                    return redirect()->to('Admin/dashboard');
                } elseif ($user['role'] === '2') {
                    return redirect()->to('User/dashboard');
                }


                // Redirect to dashboard or any other page upon successful login

            } else {
                return redirect()->back()->with('error', 'Password tidak ditemukan');
            }
        } else {

            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
    }

    public function changePassword()
    {
        $userModel = new User_loginModel();

        $user = $userModel->where('id', session()->get('id'))->first();

        if (!$user) {
            return redirect()->to('/change_password')->with('error', 'User not found');
        }

        // Validate the input
        $validationRules = [
            'password' => 'required',
            'new_password'     => 'required|min_length[8]',
            'confirm_password' => 'required|matches[new_password]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Check if the current password matches the one in the database
        if (!password_verify($this->request->getVar('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Kata sandi saat ini salah');
        }

        // Hash the new password and update it in the database
        $hashedPassword = password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT);
        $userModel->update($user['id'], ['password' => $hashedPassword]);

        return redirect()->to('/change_password')->with('success', 'Kata sandi berhasil diubah. Silakan masuk lagi.');
    }

    // public function forgotPassword()
    // {
    //     // Cek apakah form telah disubmit
    //     if ($this->request->getMethod() === 'post') {
    //         $email = $this->request->getPost('email');

    //         // Lakukan validasi email di sini jika diperlukan

    //         // Cari pengguna berdasarkan email
    //         $userModel = new User_loginModel();
    //         $user = $userModel->where('email', $email)->first();

    //         if ($user) {
    //             // Generate reset token
    //             $resetToken = bin2hex(random_bytes(16));

    //             // Set token dan waktu kadaluwarsa token pada user
    //             $userModel->update($user['id'], [
    //                 'reset_token' => $resetToken,
    //                 'reset_token_expiration' => time() + 3600 // Token kadaluwarsa dalam 1 jam (3600 detik)
    //             ]);

    //             // Kirim email reset password
    //             $email = \Config\Services::email();
    //             $email->setTo($email);
    //             $email->setSubject('Reset Password');
    //             $email->setMessage("Click the link below to reset your password: " . site_url("reset-password/$resetToken"));
    //             $email->send();

    //             return redirect()->to(site_url('Auth/reset_pass'))->with('success', 'Reset password link has been sent to your email.');
    //         } else {
    //             return redirect()->to(site_url('Auth/forget_pass'))->with('error', 'Email not found.');
    //         }
    //     }

    //     // Jika method bukan POST, tampilkan halaman forgot password
    //     return view('Auth/forget_pass');
    // }

    // public function resetPassword($token = null)
    // {
    //     if (empty($token)) {
    //         // Jika token kosong, arahkan kembali ke halaman forgot password
    //         return redirect()->to(site_url('Auth/forget_pass'))->with('error', 'Invalid reset token.');
    //     }

    //     // Cari user berdasarkan token
    //     $userModel = new UserModel();
    //     $user = $userModel->where('reset_token', $token)->first();

    //     if (!$user || time() > $user['reset_token_expiration']) {
    //         // Jika token tidak ditemukan atau telah kadaluwarsa, arahkan kembali ke halaman forgot password
    //         return redirect()->to(site_url('Auth/forget_pass'))->with('error', 'Invalid or expired reset token.');
    //     }

    //     // Cek apakah form telah disubmit
    //     if ($this->request->getMethod() === 'post') {
    //         $newPassword = $this->request->getPost('new_password');
    //         // Lakukan validasi password di sini jika diperlukan

    //         // Hash password baru dan simpan ke database
    //         $hashedPassword = password_hash('$newPassword', PASSWORD_DEFAULT);
    //         $userModel->update($user['id'], [
    //             'password' => $hashedPassword,
    //             'reset_token' => null,
    //             'reset_token_expiration' => null
    //         ]);

    //         return redirect()->to(site_url('/Auth/index'))->with('success', 'Password has been reset. You can now login with your new password.');
    //     }

    //     // Jika method bukan POST, tampilkan halaman reset password
    //     return view('Auth/forget_pass');
    // }
}