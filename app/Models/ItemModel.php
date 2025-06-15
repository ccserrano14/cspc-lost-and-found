<?php namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'status', 'condition', 'image', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
