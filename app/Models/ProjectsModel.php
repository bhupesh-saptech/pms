<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model
{
    protected $table            = 'projects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ "project_cd",
                                    "project_nm",
                                    "client_id",
                                    "proj_type",
                                    "proj_catg",
                                    "pr_manager",
                                    "proj_desc"
                                  ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function read_data() {
        return $this->select('projects.*, clients.client_nm as client_nm,agents.agent_nm as agent_nm')
                    ->join('clients', 'clients.client_id = projects.client_Id','left')
                    ->join('agents', 'agents.agent_id = projects.agent_id','left')
                    ->findAll();
    }
    public function dashboard() {
        $db  = \Config\Database::connect(); 
       $sql = "SELECT
                (SELECT count(*) FROM clients)    AS cnt_clients,
                (SELECT count(*) FROM projects)   AS cnt_projects,
                (SELECT COUNT(*) FROM agents)     AS cnt_agents,
                (SELECT COUNT(*) FROM issues)     AS cnt_issues";
                
        $qry = $db->query($sql);
        
        return $qry->getResultObject();

    }
}
