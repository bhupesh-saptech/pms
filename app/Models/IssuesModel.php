<?php

namespace App\Models;

use CodeIgniter\Model;

class IssuesModel extends Model
{
    protected $table            = 'issues';
    protected $primaryKey       = 'issue_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    "issue_title",
                                    "iss_type",
                                    "project_id",
                                    "agent_id",
                                    "status",
                                    "sap_module"
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
        return $this->select('issues.*, projects.project_nm as project_nm,agents.agent_nm as agent_nm')
                    ->join('projects', 'projects.project_id = issues.project_id','left')
                    ->join('agents', 'agents.agent_id = issues.agent_id','left')
                    ->findAll();
    }
}
