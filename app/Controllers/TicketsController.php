<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AgentsModel;
use App\Models\ProjectsModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TicketsModel;

class TicketsController extends BaseController{
    protected $TicketsModel,$AgentsModel,$ProjectsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->TicketsModel  = new TicketsModel();
        $this->ProjectsModel = new ProjectsModel();
        $this->AgentsModel   = new AgentsModel();
        $this->data['status'] = [   0=>'New/Created',
                                    1=>'Assigned',
                                    2=>'In Progress',
                                    3=>'On Hold/Blocked',
                                    4=>'Resolved',
                                    5=>'Closed',
                                ];
        $this->data['types'] =  [   0=>'Application',
                                    1=>'Technical',
                                    2=>'Authorization',
                                    3=>'Interface',
                                    4=>'Data Related'
                                ];
        $this->data['module'] = [ 00=>'SAP FI / CO',
                                  01=>'SAP MM',
                                  02=>'SAP SD',
                                  03=>'SAP PP',
                                  04=>'SAP QM',
                                  05=>'SAP WM',
                                  06=>'SAP PM',
                                  07=>'SAP PS'
                                ];
        $this->data['tickets'] = $this->TicketsModel->select('tickets.*,projects.project_nm as project_nm,agents.agent_nm as agent_nm')
                                                    ->join('projects','projects.project_id = tickets.project_id','left')
                                                    ->join('agents','agents.agent_id = tickets.agent_id','left')
                                                    ->findAll();
         $this->data['dash']    = $this->TicketsModel->dashboard();
        $this->data['agents']   = $this->AgentsModel->select("agent_id,agent_nm")->orderBy("agent_id")->findAll();
        $this->data['projects'] = $this->ProjectsModel->select("project_id,project_nm")->orderBy("project_id")->findAll();
    }
    public function index() {
        // echo "<pre>";
        // print_r($this->data['tickets']);
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
                return redirect()->to('tickets')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->TicketsModel->errors();     
                return view('tickets/ticketForm', $this->data);  
            }
        } else {
            return view('tickets/ticketsForm',$this->data);
        }
    }

    public function update($ticket_id) {
        $this->data['mode'] = 'view';
        $this->data['ticket'] = $this->TicketsModel->find($ticket_id);
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
                return view('tickets/ticketsForm', $this->data);  
            }
        } else {
            return view('tickets/ticketsForm',$this->data);
        }  
    }
    public function delete($ticket_id) {
       if($this->TicketsModel->delete($ticket_id)) {
           return redirect()->to('/tasks')->with('message',"record Deleted Successfully");
       } else {

       }
    }
}
