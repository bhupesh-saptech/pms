<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController {
    public function index() {
        $dbs  = \Config\Database::connect(); 
        $sql = "select agent_id,
                    sum(case when status = 0 then 1 else 0 end ) as status_0,
                    sum(case when status = 1 then 1 else 0 end ) as status_1,
                    sum(case when status = 2 then 1 else 0 end ) as status_2,
                    sum(case when status = 3 then 1 else 0 end ) as status_3,
                    sum(case when status = 4 then 1 else 0 end ) as status_4,
                    sum(case when status = 5 then 1 else 0 end ) as status_5,
                    sum(case when status = 6 then 1 else 0 end ) as status_6
                from tickets 
                group by agent_id";
        $qry = $dbs->query($sql);
        $data =  $qry->getRowObject();
        print_r($data);

    }
}
