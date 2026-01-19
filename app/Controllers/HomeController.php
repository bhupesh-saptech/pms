<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ProjectsModel;

class HomeController extends BaseController {
    protected $ProjectModel;
    protected $data;
    public function __construct(){
        $this->ProjectModel = new ProjectsModel();
    }
       
    public function index() {
        $dbs  = \Config\Database::connect(); 
        $sql = "select agents.agent_id,
                    max(agents.agent_nm) as agent_nm,
                    sum(case when tickets.status = 0 then 1 else 0 end ) as status_00,
                    sum(case when tickets.status = 1 then 1 else 0 end ) as status_01,
                    sum(case when tickets.status = 2 then 1 else 0 end ) as status_02,
                    sum(case when tickets.status = 3 then 1 else 0 end ) as status_03,
                    sum(case when tickets.status = 4 then 1 else 0 end ) as status_04,
                    sum(case when tickets.status = 5 then 1 else 0 end ) as status_05,
                    sum(case when tickets.status = 6 then 1 else 0 end ) as status_06
                from agents 
                left outer join tickets
                on tickets.agent_id = agents.agent_id
                group by agents.agent_id";
        $qry = $dbs->query($sql);
        $this->data['dash'] = $this->ProjectModel->dashboard();
        $this->data['list'] =  $qry->getResultObject();
        return view('home/matrix',$this->data);
    }
}
