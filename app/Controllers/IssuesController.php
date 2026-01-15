<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AgentsModel;
use App\Models\ProjectsModel;
use App\Models\IssuesModel;

class IssuesController extends BaseController {
    protected $AgentsModel ,$IssuesModel,$ProjectsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->AgentsModel   = new AgentsModel();
        $this->ProjectsModel = new ProjectsModel();
        $this->IssuesModel   = new IssuesModel();
        $this->data['status'] = [   0=>'New/Created',
                                    1=>'Assigned',
                                    2=>'In Progress',
                                    3=>'On Hold/Blocked',
                                    4=>'Resolved',
                                    5=>'Closed',
                                ];
        $this->data['issues'] = $this->IssuesModel->read_data();
        $this->data['dash']   = $this->IssuesModel->dashboard();
    }
    public function index() {
        return view('issues/issuesList',$this->data);
    }
    public function view($issue_id) {
        $this->data['issue'] = $this->IssuesModel->find($issue_id);
        return view('issues/issuesForm',$this->data);
    }
    
    public function create() {
        $data['mode'] = 'create';
        $data['projects'] = $this->ProjectsModel->select('project_id,project_nm')->orderBy('project_id')->findAll();
        $data['agents']   = $this->AgentsModel->select('agent_id,agent_nm')->orderBy('agent_id')->findAll();
        if ($this->request->is('post')) {
            $form = [
                'is_title' => $this->request->getPost('is_title'),
                'proj_id' => $this->request->getPost('proj_id'),
                'iss_type' => $this->request->getPost('iss_type'),
            ];
            if($this->IssuesModel->insert($form,false)) {
                return redirect()->to('/issues')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->IssuesModel->errors();     
                return view('issues/issuesForm', $data);  
            }
        } else {
            return view('issues/issuesForm',$data);
        }
    }
}
