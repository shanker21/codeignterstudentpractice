<?php namespace App\Models;
use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    protected $allowedFields = [
        'id',
        'telugu',
        'hindi',
        'english',
        'maths',
        'science',
        'social'
    ];
}
