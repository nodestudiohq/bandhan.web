<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to(base_url('/'));
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        $user = (new UserModel())->authenticate($username, $password);

        if (!$user) {
            return redirect()->back()->withInput()
                ->with('error', 'Invalid username or password.');
        }

        session()->set([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_role' => 'admin',
            'logged_in' => true,
        ]);

        $redirectUrl = session()->getFlashdata('redirect_url') ?? base_url('/');
        session()->setFlashdata('success', 'Welcome back, ' . $user['name'] . '!');
        return redirect()->to($redirectUrl);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth/login'))
            ->with('success', 'You have been logged out.');
    }
}