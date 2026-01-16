<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TeamsModel;

class TeamsController extends BaseController {
    protected $TeamsModel;
    protected $data;
    public function __construct() {
        $this->TeamsModel = new TeamsModel();
        $this->data['status'] = [0=>'InActive',
                                 1=>'Active'
                                ];
        $this->data['types'] = [ 0=>'Support',
                                 1=>'Project',
                                 2=>'Functional',
                                 3=>'Technical'
                                ];
        $this->data['teams'] = $this->TeamsModel->select('teams.*,agents.agent_nm as agent_nm')
                                                ->join('agents','agents.agent_id = teams.agent_id','left')
                                                ->findAll();
         $this->data['dash']   = $this->TeamsModel->dashboard();

    }
    
    public function index() {
        return view('teams/teamsList',$this->data);
    }
}
