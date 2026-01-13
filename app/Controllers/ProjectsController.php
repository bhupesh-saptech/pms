<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ProjectsModel;
use App\Models\ClientsModel;

class ProjectsController extends BaseController {
    public $ClientsModel;
    public $ProjectsModel;
    public function __construct() {
        helper('form');
        $this->ClientsModel = new ClientsModel();
        $this->ProjectsModel = new ProjectsModel();
        
    }
    public function index() {
        $data['projects'] = $this->ProjectsModel->read_data();
        $data['dash']   = $this->ProjectsModel->dashboard();
        return view('projects/list',$data);
    }
    public function create() {
        $data['mode'] = 'create';
        $data['clients'] = $this->ProjectsModel->select('client_id,clnts_name')->orderBy('client_id')->findAll();
        if ($this->request->is('post')) {
            $form = [
                'is_title' => $this->request->getPost('is_title'),
                'proj_id' => $this->request->getPost('proj_id'),
                'iss_type' => $this->request->getPost('iss_type'),
            ];
            if($this->ProjectsModel->insert($form,false)) {
                return redirect()->to('/projects')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->ProjectsModel->errors();     
                return view('projects/form', $data);  
            }
        } else {
            return view('projects/form',$data);
        }
    }
}
