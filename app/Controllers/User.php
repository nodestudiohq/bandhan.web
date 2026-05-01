<?php
namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    protected UserModel $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index(): string
    {
        return view('user/index', [
            'title' => 'User Management',
            'users' => $this->model->orderBy('name')->findAll(),
        ]);
    }

    public function create(): string
    {
        return view('user/form', [
            'title' => 'Add User',
            'user' => [],
            'editing' => false,
        ]);
    }

    public function store()
    {
        if (
            !$this->validate([
                'name' => 'required|min_length[2]',
                'username' => 'required|min_length[3]|is_unique[users.username]',
                'password' => 'required|min_length[6]',
                'password_confirm' => 'required|matches[password]',
            ])
        ) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'name' => trim($this->request->getPost('name')),
            'username' => trim($this->request->getPost('username')),
            'password' => $this->request->getPost('password'),
            'is_active' => (int) (bool) $this->request->getPost('is_active'),
        ]);

        return redirect()->to(base_url('users'))
            ->with('success', 'User created successfully.');
    }

    public function edit(int $id): string
    {
        return view('user/form', [
            'title' => 'Edit User',
            'user' => $this->model->find($id),
            'editing' => true,
        ]);
    }

    public function update(int $id)
    {
        $user = $this->model->find($id);

        $rules = [
            'name' => 'required|min_length[2]',
            'username' => "required|min_length[3]|is_unique[users.username,id,{$id}]",
        ];
        $pw = $this->request->getPost('password');
        if ($pw) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => trim($this->request->getPost('name')),
            'username' => trim($this->request->getPost('username')),
            'is_active' => (int) (bool) $this->request->getPost('is_active'),
        ];
        if ($pw)
            $data['password'] = $pw;

        $this->model->update($id, $data);
        return redirect()->to(base_url('users'))
            ->with('success', '"' . $data['name'] . '" updated.');
    }

    public function toggleStatus(int $id)
    {
        // Prevent deactivating yourself
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'You cannot deactivate your own account.');
        }
        $user = $this->model->find($id);
        $this->model->update($id, ['is_active' => $user['is_active'] ? 0 : 1]);
        return redirect()->back()
            ->with('success', '"' . $user['name'] . '" ' . ($user['is_active'] ? 'deactivated.' : 'activated.'));
    }

    public function delete(int $id)
    {
        if ($id == session()->get('user_id')) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }
        $user = $this->model->find($id);
        $this->model->delete($id);
        return redirect()->to(base_url('users'))
            ->with('success', '"' . $user['name'] . '" deleted.');
    }
}