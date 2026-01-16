<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TeamsModel;

class TeamsController extends BaseController {
    protected $TeamsModel;
    protected $data;
    public function __construct() {
        $TeamsModel = new TeamsModel();
        $this->data['Teams'] = $this->TeamsModel->findAll();

    }
    
    public function index() {
        return view('teams/teamsList',$this->data);
    }
}
