<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\AgentsModel;

class AgentsController extends BaseController {
    protected $AgentsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->AgentsModel = new AgentsModel;
        $this->data['agents'] = $this->AgentsModel->findAll();
        $this->data['dash']   = $this->AgentsModel->dashboard();
    }
    public function index() {
        return view('agents/agentsList',$this->data);
    }
    public function view($agent_id) {
        $this->data['mode']  = 'view';
        $this->data['agent'] = $this->AgentsModel->find($agent_id);
        return view('agents/agentsForm',$this->data);
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
            ];
            if($this->AgentsModel->insert($form,false)) {
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
}
