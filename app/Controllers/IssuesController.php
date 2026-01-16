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
        $this->data['issues'] = $this->IssuesModel->read_data();
        $this->data['dash']   = $this->IssuesModel->dashboard();
        $this->data['projects'] = $this->ProjectsModel->select('project_id,project_nm')->orderBy('project_id')->findAll();
        $this->data['agents']   = $this->AgentsModel->select('agent_id,agent_nm')->orderBy('agent_id')->findAll();
    }
    public function index() {
        return view('issues/issuesList',$this->data);
    }    
    public function create() {
        $this->data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'issue_title' => $this->request->getPost('issue_title'),
                'project_id'  => $this->request->getPost('project_id'),
                'iss_type'    => $this->request->getPost('iss_type'),
                'agent_id'    => $this->request->getPost('agent_id'),
                'status'      => $this->request->getPost('status')
            ];
            if($this->IssuesModel->insert($form,false)) {
                return redirect()->to('/issues')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->IssuesModel->errors();     
                return view('issues/issuesForm', $this->data);  
            }
        } else {
            return view('issues/issuesForm',$this->data);
        }
    }
    public function update($issue_id) {
        $this->data['mode'] = 'view';
        $this->data['issue'] = $this->IssuesModel->find($issue_id);
        if ($this->request->is('post')) {
            $id = $this->request->getPost('issue_id');
            $form = [
                'issue_title' => $this->request->getPost('issue_title'),
                'project_id'  => $this->request->getPost('project_id'),
                'iss_type'    => $this->request->getPost('iss_type'),
                'agent_id'    => $this->request->getPost('agent_id'),
                'status'      => $this->request->getPost('status')
            ];
            if($this->IssuesModel->update($id,$form,false)) {
                return redirect()->to('/issues')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->IssuesModel->errors();     
                return view('issues/issuesForm', $this->data);  
            }
        } else {
            return view('issues/issuesForm',$this->data);
        }
    }
    public function delete($issue_id) {
       if($this->IssuesModel->delete($issue_id)) {
           return redirect()->to('/issues')->with('message',"record Deleted Successfully");
       } else {

       }
    }
}
