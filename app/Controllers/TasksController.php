<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AgentsModel;
use App\Models\ProjectsModel;
use App\Models\TicketsModel;
use App\Models\TasksModel;
use App\Models\TeamsModel;

class TasksController extends BaseController {
    protected $AgentsModel,$ProjectsModel,$TicketsModel,$TasksModel,$TeamsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->TeamsModel    = new TeamsModel();
        $this->AgentsModel   = new AgentsModel();
        $this->ProjectsModel = new ProjectsModel();
        $this->TicketsModel   = new TicketsModel();
        $this->TasksModel    = new TasksModel;
        $this->data['status'] = [   0=>'New/Created',
                                    1=>'Assigned',
                                    2=>'In Progress',
                                    3=>'On Hold/Blocked',
                                    4=>'Completed',
                                    5=>'Closed',
                                ];
        $this->data['tasks']    = $this->TasksModel->read_data();
        $this->data['dash']     = $this->ProjectsModel->dashboard();
        $this->data['agents']   = $this->AgentsModel->select("agent_id,agent_nm")->orderBy("agent_id")->findAll();
        $this->data['teams']    = $this->TeamsModel->select("team_id,team_nm")->orderBy("team_id")->findAll();
        $this->data['projects'] = $this->ProjectsModel->select("project_id,project_nm")->orderBy("project_id")->findAll();
        $this->data['tickets'] = $this->TicketsModel->select("ticket_id,ticket_nm")->orderBy("ticket_id")->findAll();
    }
    public function index() {
        $builder = $this->TasksModel;
        $project_id = $this->request->getGet('project_id') ?? null;
        $ticket_id  = $this->request->getGet('ticket_id') ?? null;
        $agent_id   = $this->request->getGet('agent_id')   ?? null;
        $status     = $this->request->getGet('status')   ?? null;
        
        $builder->select('tasks.*, projects.project_nm as project_nm,agents.agent_nm as agent_nm')
                ->join('projects', 'projects.project_id = tasks.project_Id','left')
                ->join('agents', 'agents.agent_id = tasks.agent_id','left');

        if (!empty($project_id)) {
            $builder->where('tasks.project_id',$project_id);
        }
        if (!empty($agent_id)) {
            $builder->where('tasks.agent_id',$agent_id);
        }
        if (!empty($ticket_id)) {
            $builder->where('tasks.ticket_id',$ticket_id);
        }
        if (!empty($status)) {
            $builder->where('tasks.status',$status);
        }
        $this->data['tasks']  =   $builder->findAll();
        $this->data['dash']   = $this->ProjectsModel->dashboard();
        return view('tasks/tasksList',$this->data);
    }
    public function create() {
        $this->data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'task_cd'    => $this->request->getPost('task_cd'),
                'task_nm'    => $this->request->getPost('task_nm'),
                'project_id' => $this->request->getPost('project_id'),
                'ticket_id'  => $this->request->getPost('ticket_id'),
                'team_id'    => $this->request->getPost('team_id'),
                'agent_id'   => $this->request->getPost('agent_id'),
                'status'     => $this->request->getPost('status'),
            ];
            if($this->TasksModel->insert($form,false)) {
                return redirect()->to('tasks')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->TasksModel->errors();     
                return view('tasks/tasksForm', $this->data);  
            }
        } else {
            $ticket_id  = request()->getGet('ticket_id') ?? null;
            $project_id = request()->getGet('project_id') ?? null;
            if(!empty($project_id)) {
                $task['project_id'] = $project_id;
            }
            if(!empty($ticket_id)) {
               $ticket = $this->TicketsModel->find($ticket_id);
               $task['ticket_id']  = $ticket_id;
               $task['project_id'] = $ticket->project_id;
            }
            $this->data['task'] = (object) $task;
            return view('tasks/tasksForm',$this->data);
        }
    }

    public function update($task_id) {
        $this->data['mode'] = 'view';
        $this->data['task'] = $this->TasksModel->find($task_id);
        if ($this->request->is('post')) {
            $form = [
                'task_cd'    => $this->request->getPost('task_cd'),
                'task_nm'    => $this->request->getPost('task_nm'),
                'project_id' => $this->request->getPost('project_id'),
                'ticket_id'  => $this->request->getPost('ticket_id'),
                'team_id'    => $this->request->getPost('team_id'),
                'agent_id'   => $this->request->getPost('agent_id'),
                'status'     => $this->request->getPost('status')
            ];
            if($this->TasksModel->update($task_id,$form)) {
                return redirect()->to('tasks')->with('message',"Data Inserted Succefully");
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
