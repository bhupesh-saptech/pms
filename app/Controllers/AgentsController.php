<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AgentsModel;

class AgentsController extends BaseController {
    public $AgentsModel;
    public function __construct() {
        helper('form');
        $this->AgentsModel = new AgentsModel;
    }
    public function index() {
        $data['agents'] = $this->AgentsModel->findAll();
        $data['dash']   = $this->AgentsModel->dashboard();
        return view('agents/agentsList',$data);
    }
    public function create() {
        $data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'agent_nm'  => $this->request->getPost('agent_nm'),
                'first_name' => $this->request->getPost('first_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'email_id'   => $this->request->getPost('email_id'),
                'mobile_no'  => $this->request->getPost('mobile_no'),
            ];
            if($this->AgentsModel->insert($form,false)) {
                return redirect()->to('/agents')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->AgentsModel->errors();     
                return view('agents/agentsForm', $data);  
            }
        } else {
            return view('agents/agentsForm',$data);
        }
    }
}
