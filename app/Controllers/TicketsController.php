<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AgentsModel;
use App\Models\ProjectsModel;
use App\Models\TicketsModel;
use App\Models\TeamsModel;



class TicketsController extends BaseController{
    protected $TicketsModel,$AgentsModel,$ProjectsModel,$TeamsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->TicketsModel  = new TicketsModel();
        $this->ProjectsModel = new ProjectsModel();
        $this->AgentsModel   = new AgentsModel();
        $this->TeamsModel   = new TeamsModel();

        $this->data['status'] = [   0=>'New/Created',
                                    1=>'Assigned',
                                    2=>'In Progress',
                                    3=>'On Hold/Blocked',
                                    4=>'Resolved',
                                    5=>'Closed',
                                ];
        $this->data['types'] =  [   0=>'Development',
                                    1=>'Application',
                                    2=>'Technical',
                                    3=>'Authorization',
                                    4=>'Interface',
                                    5=>'Data Related'
                                ];
        $this->data['module'] = [ 0=>'SAP FI',
                                  1=>'SAP MM',
                                  2=>'SAP SD',
                                  3=>'SAP PP',
                                  4=>'SAP QM',
                                  5=>'SAP WM',
                                  6=>'SAP PM',
                                  7=>'SAP PS',
                                  9=>'ABAP'
                                ];
        $this->data['tickets'] = $this->TicketsModel->select('tickets.*,projects.project_nm as project_nm,agents.agent_nm as agent_nm')
                                                    ->join('projects','projects.project_id = tickets.project_id','left')
                                                    ->join('agents','agents.agent_id = tickets.agent_id','left')
                                                    ->findAll();
        $this->data['dash']    = $this->ProjectsModel->dashboard();
        $this->data['teams']   = $this->TeamsModel->select("team_id,team_nm")->orderBy("team_id")->findAll();
        $this->data['agents']   = $this->AgentsModel->select("agent_id,agent_nm")->orderBy("agent_id")->findAll();
        $this->data['projects'] = $this->ProjectsModel->select("project_id,project_nm")->orderBy("project_id")->findAll();
    }
    public function index() {
        $builder = $this->TicketsModel;
        $project_id = $this->request->getGet('project_id') ?? null;
        $team_id    = $this->request->getGet('team_id')    ?? null;
        $agent_id   = $this->request->getGet('agent_id')   ?? null;
        $status     = $this->request->getGet('status')     ?? null;
        
        $builder->select('tickets.*, projects.project_nm as project_nm,agents.agent_nm as agent_nm')
                ->join('projects', 'projects.project_id = tickets.project_Id','left')
                ->join('agents', 'agents.agent_id = tickets.agent_id','left')
                ->join('teams', 'teams.team_id = tickets.team_id','left');

        if (!empty($project_id)) {
            $builder->where('tickets.project_id',$project_id);
        }
        if (!empty($agent_id)) {
            $builder->where('tickets.agent_id',$agent_id);
        }
        if (!empty($team_id)) {
            $builder->where('tickets.team_id',$team_id);
        }
        if (!empty($status)) {
            $builder->where('tickets.status',$status);
        }
        $this->data['tickets']  =   $builder->findAll();
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
                return redirect()->to('tickets')->with('status',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->TicketsModel->errors();     
                return view('tickets/ticketForm', $this->data);  
            }
        } else {
            $project_id = request()->getGet('project_id') ?? null;
            $agent_id   = request()->getGet('agent_id') ?? null;
            $team_id    = request()->getGet('team_id') ?? null;
            if(!empty($project_id)) {
                $ticket['project_id'] = $project_id;
            }
            if(!empty($team_id)) {
               $ticket['team_id']  = $team_id;
            }
            if(!empty($agent_id)) {
               $ticket['agent_id']  = $agent_id;
            }
            $this->data['ticket'] = (object) $ticket;
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
                return redirect()->to('tickets')->with('status',"Data Inserted Succefully");
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
    public function getTickets() {
        $project_id = $this->request->getGet('project_id');
        $tickets = $this->TicketsModel->select('ticket_id,ticket_nm')
                                      ->where('project_id',$project_id)
                                      ->orderBy('ticket_id')
                                      ->findAll();
        return $this->response->setJSON($tickets);
    }
}
