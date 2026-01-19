<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TeamsModel;
use App\Models\AgentsModel;
use App\Models\ProjectsModel;

class TeamsController extends BaseController {
    protected $TeamsModel,$AgentsModel,$ProjectsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->TeamsModel     = new TeamsModel();
        $this->AgentsModel    = new AgentsModel();
        $this->ProjectsModel  = new ProjectsModel();
        $this->data['status'] = [0=>'InActive',
                                 1=>'Active'
                                ];
        $this->data['types'] = [ 0=>'Support',
                                 1=>'Project',
                                 2=>'Functional',
                                 3=>'Technical'
                                ];
        $this->data['teams'] = $this->TeamsModel->select('teams.*,agents.agent_nm as agent_nm')
                                                ->join('agents','agents.agent_id = teams.agent_id','left')
                                                ->findAll();
        $this->data['agents'] = $this->AgentsModel->select('agent_id,agent_nm')->findAll();
        $this->data['dash']   = $this->ProjectsModel->dashboard();

    }
    
    public function index() {
        return view('teams/teamsList',$this->data);
    }
 public function create() {
        $this->data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'team_cd'  => $this->request->getPost('team_cd'),
                'team_nm'  => $this->request->getPost('team_nm'),
                'team_ty'  => $this->request->getPost('team_ty'),
                'agent_id' => $this->request->getPost('agent_id'),
                'status'   => $this->request->getPost('status'),
            ];
            if($this->TeamsModel->insert($form,false)) {
                return redirect()->to('/teams')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->TeamsModel->errors();     
                return view('teams/teamsForm', $this->data);  
            }
        } else {
            return view('teams/teamsForm',$this->data);
        }
    }
    public function update($team_id) {
        $this->data['mode']  = 'view';
        $this->data['team'] = $this->TeamsModel->find($team_id);
        if ($this->request->is('post')) {
            $form = [
                'team_cd'  => $this->request->getPost('team_cd'),
                'team_nm'  => $this->request->getPost('team_nm'),
                'team_ty'  => $this->request->getPost('team_ty'),
                'agent_id' => $this->request->getPost('agent_id'),
                'status'   => $this->request->getPost('status'),
            ];
            if($this->TeamsModel->update($team_id,$form)) {
                return redirect()->back()->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->TeamsModel->errors();     
                return view('teams/teamsForm', $this->data);  
            }
        } else {
            return view('teams/teamsForm',$this->data);
        }
    }
    public function delete($team_id) {
       if($this->TeamsModel->delete($team_id)) {
           return redirect()->back()->with('message',"record Deleted Successfully");
       } else {

       }
    }
}
