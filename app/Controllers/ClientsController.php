<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ClientsModel;
use App\Models\ProjectsModel;

class ClientsController extends BaseController {
    protected $ClientsModel,$ProjectsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->ClientsModel  = new ClientsModel;
        $this->ProjectsModel = new ProjectsModel();
        $this->data['types']    = [ 0=>'Individual',
                                    1=>'Company',
                                    2=>'Government',
                                    3=>'Internal'
                                  ];
        $this->data['industry'] = [ 0=>'IT',
                                    1=>'Manufacturing',
                                    2=>'Pharma',
                                    3=>'Agro'
                                  ];
        $this->data['status']   = [ 0=>'Active',
                                    1=>'Inactive',
                                    2=>'Blacklisted'   
                                  ];
        $this->data['clients'] = $this->ClientsModel->findAll();
        $this->data['dash']    = $this->ClientsModel->dashboard();
    }
    public function index() {
        return view('clients/clientsList',$this->data);
    }
    public function create() {
        $this->data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'client_cd'  => $this->request->getPost('client_cd'),
                'client_nm'  => $this->request->getPost('client_nm'),
                'contact_nm' => $this->request->getPost('contact_nm'),
                'mobile_no'  => $this->request->getPost('mobile_no'),
                'email_id'   => $this->request->getPost('email_id'),
                'cl_type'    => $this->request->getPost('cl_type'),
                'industry'   => $this->request->getPost('industry'),
                'status'     => $this->request->getPost('status')
            ];
            if($this->ClientsModel->insert($form,false)) {
                return redirect()->to('/clients')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->ClientsModel->errors();     
                return view('clients/clientsForm', $this->data);  
            }
        } else {
            return view('clients/clientsForm',$this->data);
        }
    }
    public function update($client_id) {
        $this->data['mode'] = 'view';
        $this->data['client'] = $this->ClientsModel->find($client_id);
        if ($this->request->is('post')) {
            $id = $this->request->getPost('client_id');
           $form = [
                'client_cd'  => $this->request->getPost('client_cd'),
                'client_nm'  => $this->request->getPost('client_nm'),
                'contact_nm' => $this->request->getPost('contact_nm'),
                'mobile_no'  => $this->request->getPost('mobile_no'),
                'email_id'   => $this->request->getPost('email_id'),
                'cl_type'    => $this->request->getPost('cl_type'),
                'industry'   => $this->request->getPost('industry'),
                'status'     => $this->request->getPost('status')
            ];
            if($this->ClientsModel->update($id,$form)) {
                return redirect()->to('/clients')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->ClientsModel->errors();     
                return view('clients/clientsForm', $this->data);  
            }
        } else {
            return view('clients/clientsForm',$this->data);
        }
    }
    public function delete($client_id) {
       if($this->ClientsModel->delete($client_id)) {
           return redirect()->to('/clients')->with('message',"record Deleted Successfully");
       } else {

       }
    }
    public function projects($client_id) {
        $this->data['projects'] = $this->ProjectsModel->select('projects.*,clients.client_nm,agents.agent_nm')
                                                      ->join('clients','clients.client_id = projects.client_id','left')
                                                      ->join('agents','agents.agent_id = projects.agent_id','left')
                                                      ->where('client_id',$client_id)->findAll();
        return view('projects/projectsList',$this->data);
    }
}
