<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TicketsModel;

class TicketsController extends BaseController{
    protected $TicketsModel;
    protected $data;
    public function __construct() {
        $this->TicketsModel = new TicketsModel();
        $this->data['tickets'] = $this->TicketsModel->select('tickets.*,projects.project_nm as project_nm,agents.agent_nm as agent_nm')
                                                    ->join('projects','projects.project_id = tickets.project_id','left')
                                                    ->join('agents','agents.agent_id = tickets.agent_id','left')
                                                    ->findAll();
         $this->data['dash']   = $this->TicketsModel->dashboard();
    }
    public function index() {
            return view('tickets/ticketsList',$this->data);
    }
}
