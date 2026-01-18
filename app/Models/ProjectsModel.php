<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model
{
    protected $table            = 'projects';
    protected $primaryKey       = 'project_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ "project_cd",
                                    "project_nm",
                                    "proj_desc",
                                    "proj_type",
                                    "proj_catg",
                                    "client_id",
                                    "agent_id",
                                    "start_dt",
                                    "finish_dt",
                                    "status"
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

    public function dashboard() {
        $db  = \Config\Database::connect(); 
        $sql = "SELECT
                (SELECT COUNT(*) FROM agents)   AS cnt_agents,
                (SELECT COUNT(*) FROM clients)  AS cnt_clients,
                (SELECT COUNT(*) FROM projects) AS cnt_projects,
                (SELECT COUNT(*) FROM tasks)    AS cnt_tasks,
                (SELECT COUNT(*) FROM teams)    AS cnt_teams,
                (SELECT COUNT(*) FROM tickets)  AS cnt_tickets";
                

        $qry = $db->query($sql);
        
        return $qry->getRowObject();

    }
}
