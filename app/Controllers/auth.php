<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            if (session()->get('role') === 'admin') {
                return redirect()->to('/admin');
            }

            return redirect()->to('/');
        }

        return view('auth/login', [
            'title' => 'Login - Mielle Accessories'
        ]);
    }

    public function checkLogin()
    {
        $email    = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        $user = $this->userModel
            ->where('email', $email)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password salah.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password salah.');
        }

        session()->regenerate();

        session()->set([
            'isLoggedIn' => true,
            'id_user'    => $user['id_user'],
            'nama'       => $user['nama'],
            'email'      => $user['email'],
            'role'       => $user['role']
        ]);

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin');
        }

        return redirect()->to('/');
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        return view('auth/register', [
            'title' => 'Register - Mielle Accessories'
        ]);
    }

    public function create()
    {
        $nama            = trim($this->request->getPost('nama'));
        $email           = trim($this->request->getPost('email'));
        $password        = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($nama === '' || $email === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Semua data wajib diisi.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Format email tidak valid.');
        }

        if (strlen($password) < 6) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password minimal 6 karakter.');
        }

        if ($password !== $passwordConfirm) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Konfirmasi password tidak cocok.');
        }

        $existingUser = $this->userModel
            ->where('email', $email)
            ->first();

        if ($existingUser) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email sudah terdaftar.');
        }

        $this->userModel->insert([
            'nama'     => $nama,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'user'
        ]);

        return redirect()->to('/login')
            ->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'Kamu telah logout.');
    }
}