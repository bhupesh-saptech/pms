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
        $this->data['status'] = [   0=>'New/Created',
                                    1=>'Assigned',
                                    2=>'In Progress',
                                    3=>'On Hold/Blocked',
                                    4=>'Completed',
                                    5=>'Closed',
                                ];
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
        $this->data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'task_title' => $this->request->getPost('task_title'),
                'project_id' => $this->request->getPost('project_id'),
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

    public function update($task_id) {
        $this->data['mode'] = 'view';
        $this->data['task'] = $this->TasksModel->find($task_id);
        if ($this->request->is('post')) {
            $id = $this->request->getPost('task_id');
            $form = [
                'task_title' => $this->request->getPost('task_title'),
                'project_id' => $this->request->getPost('project_id'),
                'agent_id' => $this->request->getPost('agent_id'),
                
            ];
            if($this->TasksModel->update($id,$form)) {
                return redirect()->to('/tasks')->with('message',"Data Inserted Succefully");
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
