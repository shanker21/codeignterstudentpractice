<?php 
namespace App\Models;
use CodeIgniter\Model;

class StudentModel extends Model{
	protected $table ='student';
	protected $primarykey = 'id';
	protected $allowedFields =[
		'name',
		'age',
		'email',
		'marks'
	];
}