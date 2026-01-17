<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TicketsModel;

class TicketsController extends BaseController{
    protected $TicketsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->TicketsModel = new TicketsModel();
        $this->data['tickets'] = $this->TicketsModel->select('tickets.*,projects.project_nm as project_nm,agents.agent_nm as agent_nm')
                                                    ->join('projects','projects.project_id = tickets.project_id','left')
                                                    ->join('agents','agents.agent_id = tickets.agent_id','left')
                                                    ->findAll();
         $this->data['dash']   = $this->TicketsModel->dashboard();
    }
    public function index() {
            return view('tickets/ticketsList',$this->data);
    }
    public function create() {
        $this->data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'ticket_cd'  => $this->request->getPost('ticket_cd'),
                'ticket_nm'  => $this->request->getPost('ticket_nm'),
                'ticket_ty'  => $this->request->getPost('ticket_ty'),
                'project_id' => $this->request->getPost('project_id'),
                'team_id'    => $this->request->getPost('team_id'),
                'agent_id'   => $this->request->getPost('agent_id'),
                'start_dt'   => $this->request->getPost('start_dt'),
                'due_dt'     => $this->request->getPost('due_dt'),
                'module'     => $this->request->getPost('module'),
                'status'     => $this->request->getPost('status')
            ];
            if($this->TicketsModel->insert($form,false)) {
                return redirect()->back()->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->TicketsModel->errors();     
                return view('tasks/tasksForm', $this->data);  
            }
        } else {
            return view('tasks/tasksForm',$this->data);
        }
    }

    public function update($ticket_id) {
        $this->data['mode'] = 'view';
        $this->data['task'] = $this->TicketsModel->find($ticket_id);
        if ($this->request->is('post')) {
            $form = [
                'ticket_cd'  => $this->request->getPost('ticket_cd'),
                'ticket_nm'  => $this->request->getPost('ticket_nm'),
                'ticket_ty'  => $this->request->getPost('ticket_ty'),
                'project_id' => $this->request->getPost('project_id'),
                'team_id'    => $this->request->getPost('team_id'),
                'agent_id'   => $this->request->getPost('agent_id'),
                'start_dt'   => $this->request->getPost('start_dt'),
                'due_dt'     => $this->request->getPost('due_dt'),
                'module'     => $this->request->getPost('module'),
                'status'     => $this->request->getPost('status')
            ];
            if($this->TicketsModel->update($ticket_id,$form)) {
                return redirect()->back()->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->TicketsModel->errors();     
                return view('tasks/tasksForm', $this->data);  
            }
        } else {
            return view('tasks/tasksForm',$this->data);
        }  
    }
    public function delete($ticket_id) {
       if($this->TicketsModel->delete($ticket_id)) {
           return redirect()->to('/tasks')->with('message',"record Deleted Successfully");
       } else {

       }
    }
}
