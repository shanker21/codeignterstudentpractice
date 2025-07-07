<?php

namespace App\Libraries;
use App\Models\StudentModel;
use App\Models\TeacherModel;

class Myfunction {

    public function getstudentdata()
	{
		$model = new StudentModel();
		$model->select('student.*');
		$student = $model->orderBy('marks', 'DESC')->findAll();
		return $student;
	}

	public function getcount($id)
	{
		$model = new TeacherModel();
		$model->where('id', $id);
		$count = $model->countAllResults();
		return $count;
	}

}