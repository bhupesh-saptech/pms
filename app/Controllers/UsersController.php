<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UsersModel;

class UsersController extends BaseController {
    public $UsersModel;
    public function __construct() {
        helper('form');
        $this->UsersModel = new UsersModel;
    }
    public function index() {
        $data['users'] = $this->UsersModel->findAll();
        return view('users/list',$data);
    }
    public function login(){
        $session = session();
        if ($this->request->is('post')) {
            $mail_id = $this->request->getPost('mail_id');
            $pass_wd = $this->request->getPost('pass_wd');
            $user = $this->UsersModel->where('mail_id', $mail_id)
                                     ->where('is_active', 1)
                                     ->first();
            if( !$user) {
                echo "error in user !!";
            }
            if (!$user || !password_verify($pass_wd, $user['pass_wd'])) {
                return redirect()->back()
                    ->with('error', 'Invalid Email or Password');
            }

            $session->set([
                'user_id'   => $user['id'],
                'user_name' => $user['name'],
                'user_email'=> $user['email'],
                'isLoggedIn'=> true
            ]);
            return redirect()->to('/dashboard');
        } else {
            return view('users/login');
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('users/login'));
    }
    public function create() {
        $data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'user_id' => $this->request->getPost('user_id'),
                'mail_id' => $this->request->getPost('mail_id'),
                'user_nm' => $this->request->getPost('user_nm'),
                'cell_no' => $this->request->getPost('cell_no'),
                'pass_wd' => password_hash($this->request->getPost('pass_wd'), PASSWORD_DEFAULT)
            ];
            if($this->UsersModel->insert($form,false)) {
                return redirect()->to('/users')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->UsersModel->errors();
                return view('users/form', $data);
            }
        } else {
            return view('users/form',$data);
        }   
    }
     public function edit($id) {
        $data['mode'] = 'edit';
        $data['user'] = $this->UsersModel->find($id);
        if ($this->request->is('post')) {
            $form = [
                'user_id' => $this->request->getPost('user_id'),
                'mail_id' => $this->request->getPost('mail_id'),
                'user_nm' => $this->request->getPost('user_nm'),
                'cell_no' => $this->request->getPost('cell_no'),
            ];
            if($this->UsersModel->update($form,false)) {
                $data['errors'] = $this->UsersModel->errors();
                return view('users/form', $data);
            } else {
                return redirect()->to('/users')->with('message',"Data Inserted Succefully046A613ACB1191");
            }
        }
        return view('users/form',$data);
    }
    public function view($id) {
        $data['mode'] = 'view';
        $data['user'] = $this->UsersModel->find($id);
        return view('users/form',$data);
    }
    public function delete($id) {
        $data['mode'] = 'delete';
        $data['user'] = $this->UsersModel->find($id);
        $data['validation'] = $this->validator;
        return view('users/form',$data);
    }
   
}
