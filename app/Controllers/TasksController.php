<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AgentsModel;
use App\Models\ProjectsModel;
use App\Models\IssuesModel;
use App\Models\TasksModel;

class TasksController extends BaseController {
    public $AgentsModel;
    public $ProjectsModel;
    public $IssuesModel; 
    public $TasksModel;
    public function __construct() {
        helper('form');
        $this->AgentsModel   = new AgentsModel();
        $this->ProjectsModel = new ProjectsModel();
        $this->IssuesModel   = new IssuesModel();
        $this->TasksModel    = new TasksModel;
    }
    public function index() {
        $data['tasks'] = $this->TasksModel->read_data();
        $data['dash']   = $this->TasksModel->dashboard();
        return view('tasks/list',$data);
    }
    public function create() {
        $data['mode'] = 'create';
        $data['agents']   = $this->AgentsModel->select("agent_id,agent_nm")->orderBy("agent_id")->findAll();
        $data['projects'] = $this->ProjectsModel->select("proj_id,ps_name")->orderBy("proj_id")->findAll();
        $data['issues']   = $this->IssuesModel->select("issue_id,is_title")->orderBy("issue_id")->findAll();
         if ($this->request->is('post')) {
            $form = [
                'ts_desc' => $this->request->getPost('ts_desc'),
                'proj_id' => $this->request->getPost('proj_id'),
                'agent_id' => $this->request->getPost('agent_id'),
                
            ];
            if($this->TasksModel->insert($form,false)) {
                return redirect()->to('/tasks')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->TasksModel->errors();     
                return view('tasks/form', $data);  
            }
        } else {
            return view('tasks/form',$data);
        }
    }
}
