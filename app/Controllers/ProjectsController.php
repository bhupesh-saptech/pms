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
        return view('projects/projectsList',$data);
    }
    public function create() {
        $data['mode'] = 'create';
        $data['clients'] = $this->ClientsModel->select('client_id,client_nm')->orderBy('client_id')->findAll();
        $data['status']  =  [   0 => 'Draft',                            
                                1 => 'Active',
                                2 => 'On Hold',
                                3 => 'Cancelled',
                                4 => 'Completed' 
                            ];

        if ($this->request->is('post')) {
            $form = [
                'project_cd' => $this->request->getPost('project_cd'),
                'project_nm' => $this->request->getPost('project_nm'),
                'proj_desc' => $this->request->getPost('proj_desc'),
                'proj_type' => $this->request->getPost('proj_type'),
                'proj_catg' => $this->request->getPost('proj_catg'),
                'agent_id' => $this->request->getPost('agent_id'),
                'client_id' => $this->request->getPost('client_id'),
                'start_dt' => $this->request->getPost('start_dt'),
                'finish_dt' => $this->request->getPost('finish_dt'),
                'status' => $this->request->getPost('status'),
            ];
            if($this->ProjectsModel->insert($form,false)) {
                return redirect()->to('/projects')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->ProjectsModel->errors();     
                return view('projects/projectsForm', $data);  
            }
        } else {
            return view('projects/projectsForm',$data);
        }
    }
    public function read($project_id) {
        $data['mode'] = 'read';
        $data['project'] = $this->ProjectsModel->find($project_id);
        $data['clients'] = $this->ClientsModel->select('client_id,client_nm')->orderBy('client_id')->findAll();
        return view('projects/projectsForm',$data);
    }
    public function update($project_id) {
        $data['mode'] = 'update';
        $data['project'] = $this->ProjectsModel->find($project_id);
        $data['clients'] = $this->ClientsModel->select('client_id,client_nm')->orderBy('client_id')->findAll();
        if ($this->request->is('post')) {
            
            $form = [
                'project_cd' => $this->request->getPost('project_cd'),
                'project_nm' => $this->request->getPost('project_nm'),
                'proj_desc' => $this->request->getPost('proj_desc'),
                'proj_type' => $this->request->getPost('proj_type'),
                'proj_catg' => $this->request->getPost('proj_catg'),
                'agent_id' => $this->request->getPost('agent_id'),
                'client_id' => $this->request->getPost('client_id'),
                'start_dt' => $this->request->getPost('start_dt'),
                'finish_dt' => $this->request->getPost('finish_dt'),
                'status' => $this->request->getPost('status'),
            ];
            if($this->ProjectsModel->update($form,false)) {
                return redirect()->to('/projects')->with('message',"Data updated Succefully");
            } else {
                $data['errors'] = $this->ProjectsModel->errors();     
                return view('projects/projectsForm', $data);  
            }
        } else {
            return view('projects/projectsForm',$data);
        }
    }
    public function delete($project_id) {
        $data['mode'] = 'delete';
        $data['project'] = $this->ProjectsModel->find($project_id);
        $data['clients'] = $this->ClientsModel->select('client_id,client_nm')->orderBy('client_id')->findAll();
        return view('projects/projectsForm',$data);
    }
}
