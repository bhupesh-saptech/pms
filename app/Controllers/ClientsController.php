<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ClientsModel;

class ClientsController extends BaseController {
    protected $ClientsModel;
    protected $data;
    public function __construct() {
        helper('form');
        $this->ClientsModel = new ClientsModel;
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
        $this->data['dash']   = $this->ClientsModel->dashboard();
    }
    public function index() {
        return view('clients/clientsList',$this->data);
    }
    public function view($client_id) {
        $this->data['client'] = $this->ClientsModel->find($client_id);
        return view('clients/clientsForm',$this->data);
    }
    public function create() {
        $data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'client_nm' => $this->request->getPost('client_nm'),
                'email_id' => $this->request->getPost('email_id'),
                'mobile_no' => $this->request->getPost('mobile_no'),
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
    public function delete($agent_id) {
       if($this->ClientsModel->delete($agent_id)) {
           return redirect()->to('/clients')->with('message',"record Deleted Successfully");
       } else {

       }
    }
}
