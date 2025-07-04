<?php
// app/Models/UserModel.php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password', 'role', 'access_expires'];
    protected $useTimestamps = false;
    protected $returnType = 'array';

    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
