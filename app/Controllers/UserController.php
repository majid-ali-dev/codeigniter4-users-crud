<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Read
    public function index()
    {
        $data = [
            'users' => $this->userModel->paginate(10),
            'pager' => $this->userModel->pager
        ];

        return view('users/index', $data);
    }

    // Create form
    public function create()
    {
        return view('users/create');
    }

    // Store
    public function store()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');

        if (empty($name) || empty($email)) {
            return redirect()->back()
                ->with('error', 'Name and Email are required!');
        }

        $this->userModel->save([
            'name'  => $name,
            'email' => $email,
        ]);

        return redirect()->to('/users')
            ->with('success', 'User created successfully!');
    }

    // Edit form
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);

        if (!$data['user']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('users/edit', $data);
    }

    // Update
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->userModel->update($id, [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to('/users')
            ->with('success', 'User updated successfully!');
    }

    // Delete
    public function delete($id)
    {
        $this->userModel->delete($id);

        return redirect()->to('/users')
            ->with('success', 'User deleted successfully!');
    }
}
