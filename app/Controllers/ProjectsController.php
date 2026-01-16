<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ProjectsModel;
use App\Models\ClientsModel;
use App\Models\AgentsModel;

class ProjectsController extends BaseController {
    protected $AgentsModel,$ClientsModel,$ProjectsModel;
    protected $data;

    public function __construct() {
        helper('form');
        $this->ClientsModel  = new ClientsModel();
        $this->AgentsModel   = new AgentsModel();
        $this->ProjectsModel = new ProjectsModel();
        $this->data['status']  =  [ 0 => 'Draft',                            
                                    1 => 'Active',
                                    2 => 'On Hold',
                                    3 => 'Cancelled',
                                    4 => 'Completed' 
                                  ];
        $this->data['types'] = [    1=> 'Implementation',
                                    2=> 'Innovation / Transformation',
                                    3=> 'Upgrade / Conversion',
                                    4=> 'Enhancement / Change',
                                    5=> 'Support / Maintenance',
                                    6=> 'Integration',
                                    7=> 'Migration',
                                    8=> 'Compliance / Regulatory',
                                    9=> 'Infrastructure / Technical'
                                ];
        $this->data['category'] = [ 1=> 'Strategic',
                                    2=> 'Compliance',
                                    3=> 'Business-Driven',
                                    4=> 'IT-Driven',
                                    5=> 'Run-the-Business (RTB)',
                                    6=> 'Change-the-Business (CTB)',
                                    7=> 'CapEx vs OpEx',
                                  ];
        $this->data['clients'] = $this->ClientsModel->select('client_id,client_nm')->orderBy('client_id')->findAll();
        $this->data['agents']  = $this->AgentsModel->select('agent_id,agent_nm')->orderBy('agent_id')->findAll();
        
    }
    public function index() {
        $client_id = $this->request->getGet('client_id') ?? null;
        echo $client_id;
        $builder = $this->ProjectsModel;

        $builder->select('projects.*, clients.client_nm as client_nm,agents.agent_nm as agent_nm')
                ->join('clients', 'clients.client_id = projects.client_Id','left')
                ->join('agents', 'agents.agent_id = projects.agent_id','left');
        if (!empty($clientId)) {
            $builder->where('projects.client_id',$client_id);
        }
        $this->data['projects'] =   $builder->findAll();
        $this->data['dash']   = $this->ProjectsModel->dashboard();
        // return view('projects/projectsList',$this->data);
    }
    public function create() {
        $this->data['mode'] = 'create';
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
                return redirect()->back()->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->ProjectsModel->errors();     
                return view('projects/projectsForm', $this->data);  
            }
        } else {
            return view('projects/projectsForm',$this->data);
        }
    }
    public function update($project_id) {
        $this->data['mode'] = 'view';
        $this->data['project'] = $this->ProjectsModel->find($project_id);
         if ($this->request->is('post')) {
            $form = [
                'project_cd' => $this->request->getPost('project_cd'),
                'project_nm' => $this->request->getPost('project_nm'),
                'proj_desc'  => $this->request->getPost('proj_desc'),
                'proj_type'  => $this->request->getPost('proj_type'),
                'proj_catg'  => $this->request->getPost('proj_catg'),
                'agent_id'   => $this->request->getPost('agent_id'),
                'client_id'  => $this->request->getPost('client_id'),
                'start_dt'   => $this->request->getPost('start_dt'),
                'finish_dt'  => $this->request->getPost('finish_dt'),
                'status' => $this->request->getPost('status'),
            ];
            if($this->ProjectsModel->update($project_id,$form)) {
                return redirect()->back()->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->ProjectsModel->errors();     
                return view('projects/projectsForm', $this->data);  
            }
        } else {
            return view('projects/projectsForm',$this->data);
        }
    }
   
    public function delete($project_id) {
       if($this->ProjectsModel->delete($project_id)) {
           return redirect()->back()->with('message',"record Deleted Successfully");
       } else {

       }
    }
}
