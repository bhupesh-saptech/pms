<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UsersModel;
use App\Models\ProjectsModel;

class UsersController extends BaseController {
    public $UsersModel,$ProjectsModel;
    public function __construct() {
        helper('form');
        $this->UsersModel    = new UsersModel();
        $this->ProjectsModel = new ProjectsModel();
    }
    public function index() {
        $data['users'] = $this->UsersModel->findAll();
        $data['dash']   = $this->ProjectsModel->dashboard();
        return view('users/usersList',$data);
    }
    public function login(){
        $session = session();
        if ($this->request->is('post')) {
            $mail_id = $this->request->getPost('mail_id');
            $pass_wd = $this->request->getPost('pass_wd');
            $user = $this->UsersModel->where('mail_id', $mail_id)
                                     ->where('is_active', 1)
                                     ->first();
            if (!$user || !password_verify($pass_wd, $user->pass_wd)) {
                return redirect()->back()
                    ->with('error', 'Invalid Email or Password');
            }

            $session->set([
                'user_id'   => $user->user_id,
                'user_nm' => $user->user_nm,
                'user_email'=> $user->mail_id,
                'isLoggedIn'=> true
            ]);
            return redirect()->to('/');
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
                'user_nm' => $this->request->getPost('user_nm'),
                'mail_id' => $this->request->getPost('mail_id'),
                'real_nm' => $this->request->getPost('real_nm'),
                'cell_no' => $this->request->getPost('cell_no'),
                'pass_wd' => password_hash($this->request->getPost('pass_wd'), PASSWORD_DEFAULT),
                'is_active' => true,
                'is_verified'=> true
            ];
            if($this->UsersModel->insert($form,false)) {
                return redirect()->to('/users')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->UsersModel->errors();
                return view('users/usersForm', $data);
            }
        } else {
            return view('users/usersForm',$data);
        }   
    }
     public function update($user_id) {
        $data['mode'] = 'view';
        $data['user'] = $this->UsersModel->find($user_id);
        if ($this->request->is('post')) {
            $form = [
                'user_nm' => $this->request->getPost('user_nm'),
                'mail_id' => $this->request->getPost('mail_id'),
                'real_nm' => $this->request->getPost('real_nm'),
                'cell_no' => $this->request->getPost('cell_no'),
            ];
            if($this->UsersModel->update($user_id,$form,false)) {
                return redirect()->to('/users')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->UsersModel->errors();
                return view('users/usersForm', $data);
            }
        }
        return view('users/usersForm',$data);
    }

    public function delete($user_id) {
       if($this->UsersModel->delete($user_id)) {
           return redirect()->to('/users')->with('message',"record Deleted Successfully");
       } else {

       }
    }
   
}
