<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ClientsModel;

class ClientsController extends BaseController {
    public $ClientsModel;
    public function __construct() {
        helper('form');
        $this->ClientsModel = new ClientsModel;
    }
    public function index() {
        $data['clients'] = $this->ClientsModel->findAll();
        $data['dash']   = $this->ClientsModel->dashboard();
        return view('clients/clientsList',$data);
    }
    public function create() {
        $data['mode'] = 'create';
        if ($this->request->is('post')) {
            $form = [
                'clnts_name' => $this->request->getPost('clnts_name'),
                'csemail_id' => $this->request->getPost('csemail_id'),
                'cmobile_no' => $this->request->getPost('cmobile_no'),
            ];
            if($this->ClientsModel->insert($form,false)) {
                return redirect()->to('/clients')->with('message',"Data Inserted Succefully");
            } else {
                $data['errors'] = $this->ClientsModel->errors();     
                return view('clients/clientForm', $data);  
            }
        } else {
            return view('clients/clientForm',$data);
        }
    }
}
