<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AgentsModel;
use App\Models\ProjectsModel;
use App\Models\IssuesModel;
use App\Models\TasksModel;

class TasksController extends BaseController {
    protected $AgentsModel,$ProjectsModel,$IssuesModel,$TasksModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->AgentsModel   = new AgentsModel();
        $this->ProjectsModel = new ProjectsModel();
        $this->IssuesModel   = new IssuesModel();
        $this->TasksModel    = new TasksModel;
        $this->data['tasks'] = $this->TasksModel->read_data();
        $this->data['dash']  = $this->TasksModel->dashboard();
        $this->data['agents']   = $this->AgentsModel->select("agent_id,agent_nm")->orderBy("agent_id")->findAll();
        $this->data['projects'] = $this->ProjectsModel->select("project_id,project_nm")->orderBy("project_id")->findAll();
        $this->data['issues']   = $this->IssuesModel->select("issue_id,issue_title")->orderBy("issue_id")->findAll();
    }
    public function index() {
        return view('tasks/tasksList',$this->data);
    }
    public function create() {
        $data['mode'] = 'create';
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
                return view('tasks/tasksForm', $this->data);  
            }
        } else {
            return view('tasks/tasksForm',$this->data);
        }
    }
    public function view($task_id) {
        $this->data['mode'] = 'read';
        $this->data['task'] = $this->TasksModel->find($task_id);
        return view('tasks/tasksForm',$this->data);
    }
    public function update() {
        $data['mode'] = 'update';
        if ($this->request->is('post')) {
            $form = [
                'ts_desc' => $this->request->getPost('ts_desc'),
                'proj_id' => $this->request->getPost('proj_id'),
                'agent_id' => $this->request->getPost('agent_id'),
                
            ];
            if($this->TasksModel->update($form,false)) {
                return redirect()->to('/tasks')->with('message',"Data updated Succefully");
            } else {
                $data['errors'] = $this->TasksModel->errors();     
                return view('tasks/tasksForm', $this->data);  
            }
        } else {
            return view('tasks/tasksForm',$this->data);
        }
    }
    public function delete($task_id) {
       if($this->TasksModel->delete($task_id)) {
           return redirect()->to('/tasks')->with('message',"record Deleted Successfully");
       } else {

       }
    }
}
