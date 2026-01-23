<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AgentsModel;
use App\Models\ProjectsModel;
use App\Models\TeamsModel;
use App\Models\UsersModel;

class AgentsController extends BaseController {
    protected $AgentsModel,$ProjectsModel,$TeamsModel,$UsersModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->AgentsModel = new AgentsModel;
        $this->ProjectsModel = new ProjectsModel;
        $this->TeamsModel = new TeamsModel();
        $this->UsersModel = new UsersModel();
        $this->data['agents'] = $this->AgentsModel->findAll();
        $this->data['users'] = $this->UsersModel->findAll();
        $this->data['teams'] = $this->TeamsModel->findAll();
        $this->data['dash']   = $this->ProjectsModel->dashboard();
    }
    public function index() {
        $builder = $this->AgentsModel;
        $team_id = $this->request->getGet('team_id') ?? null;
        
        $builder->select('agents.*,teams.team_nm as team_nm')
                ->join('teams','teams.team_id = agents.team_id')
                ->orderBy('agent_id');

        if (!empty($team_id)) {
            $builder->where('agents.team_id',$team_id);
        }
       
        $this->data['agents']  =  $builder->findAll();
        return view('agents/agentsList',$this->data);
    }
    public function create() {
        $this->data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'agent_nm'  => $this->request->getPost('agent_nm'),
                'first_name' => $this->request->getPost('first_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'email_id'   => $this->request->getPost('email_id'),
                'mobile_no'  => $this->request->getPost('mobile_no'),
                'team_id'    => $this->request->getPost('team_id')
            ];
            if($this->AgentsModel->insert($form,false)) {
                return redirect()->to('/agents')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->AgentsModel->errors();     
                return view('agents/agentsForm', $this->data);  
            }
        } else { 
            $team_id = $this->request->getGet('team_id') ?? null;
            if(!empty($team_id)) {
                $agent['team_id'] = $team_id;
                $this->data['agent'] = (object) $agent;
            }
            
            return view('agents/agentsForm',$this->data);
        }
    }
    public function update($agent_id) {
        $this->data['mode']  = 'view';
        $this->data['agent'] = $this->AgentsModel->find($agent_id);
        if ($this->request->is('post')) {
            $id = $this->request->getPost('agent_id');
            $form = [
                'agent_nm'  => $this->request->getPost('agent_nm'),
                'first_name' => $this->request->getPost('first_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'email_id'   => $this->request->getPost('email_id'),
                'mobile_no'  => $this->request->getPost('mobile_no'),
                'team_id'    => $this->request->getPost('team_id')
            ];
            if($this->AgentsModel->update($id,$form)) {
                return redirect()->to('/agents')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->AgentsModel->errors();     
                return view('agents/agentsForm', $this->data);  
            }
        } else {
            return view('agents/agentsForm',$this->data);
        }
    }
    public function delete($agent_id) {
       if($this->AgentsModel->delete($agent_id)) {
           return redirect()->to('/agents')->with('message',"record Deleted Successfully");
       } else {

       }
    }
    public function getAgents() {
        $team_id = $this->request->getGet('team_id');
        $agents = $this->AgentsModel->select('agent_id,agent_nm')
                                    ->where('team_id',$team_id)
                                    ->orderBy('agent_id')
                                    ->findAll();

        return $this->response->setJSON($agents);
    }
}
