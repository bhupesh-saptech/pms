<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AgentsModel;
use App\Models\ProjectsModel;
use App\Models\IssuesModel;

class IssuesController extends BaseController {
    public $AgentsModel;
    public $IssuesModel;
    public $ProjectsModel;
    public function __construct() {
        helper('form');
        $this->AgentsModel   = new AgentsModel();
        $this->ProjectsModel = new ProjectsModel();
        $this->IssuesModel   = new IssuesModel();
    }
    public function index() {
        $data['issues'] = $this->IssuesModel->read_data();
        $data['dash']   = $this->IssuesModel->dashboard();
        return view('issues/list',$data);
    }
    public function create() {
        $data['mode'] = 'create';
        $data['projects'] = $this->ProjectsModel->select('proj_id,ps_name')->orderBy('proj_id')->findAll();
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
                return view('issues/form', $data);  
            }
        } else {
            return view('issues/form',$data);
        }
    }
}
