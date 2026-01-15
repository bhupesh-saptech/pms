<?php

namespace App\Models;

use CodeIgniter\Model;

class TasksModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'task_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ "task_title",
                                    "project_id",
                                    "agent_id"
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
        return $this->select('tasks.*, projects.project_nm as ps_name,agents.agent_nm as agent_nm')
                    ->join('projects', 'projects.project_id = tasks.project_id','left')
                    ->join('agents', 'agents.agent_id = tasks.agent_id','left')
                    ->findAll();
    }
     public function dashboard() {
        $db  = \Config\Database::connect(); 
       $sql = "SELECT
                (SELECT COUNT(*) FROM clients)  AS cnt_clients,
                (SELECT COUNT(*) FROM projects) AS cnt_projects,
                (SELECT COUNT(*) FROM agents)   AS cnt_agents,
                (SELECT COUNT(*) FROM issues)   AS cnt_issues";

        $qry = $db->query($sql);
        
        return $qry->getRowObject();

    }
}
