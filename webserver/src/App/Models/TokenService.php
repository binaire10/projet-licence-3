<?php


namespace App\Models;


class TokenService extends \CodeIgniter\Model
{
    const LOGIN = 1;
    protected $table      = 'Token';
    protected $primaryKey = ['token', 'service'];

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['service', 'token', 'id_user'];

    protected $useTimestamps = false;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}