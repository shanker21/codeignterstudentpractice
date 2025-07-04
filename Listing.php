<?php
namespace App\Controllers;
use App\Libraries\Myfunction;

class Listing extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Student List',
            'page'  => 'listing'
        ];
        $myFun = new Myfunction();
        $data['student'] = $myFun->getstudentdata();
        return view('listing', $data);
    }

    public function getstudentdata(){
        $myFun = new Myfunction();
        $data = $myFun->getstudentdata();
        return $this->response->setJSON($data ?? []);

    }

    public function get_student_marks($id)
    {
        $model = new \App\Models\TeacherModel();
        $marks = $model->where('id', $id)->first();
       return $this->response->setJSON($marks ?? []);
    }

    public function contact()
    {
        $myFun = new Myfunction();
        $model = new \App\Models\TeacherModel();

        // Get POST data
        $id      = $this->request->getPost('id');
        $telugu  = (int) $this->request->getPost('telugu');
        $hindi   = (int) $this->request->getPost('hindi');
        $english = (int) $this->request->getPost('english');
        $maths   = (int) $this->request->getPost('maths');
        $science = (int) $this->request->getPost('science');
        $social  = (int) $this->request->getPost('social');
        $count = $myFun->getcount($id);
        // 1. Save subject marks
        $marksData = [
            'id'      => $id,
            'telugu'  => $telugu,
            'hindi'   => $hindi,
            'english' => $english,
            'maths'   => $maths,
            'science' => $science,
            'social'  => $social,
        ];

        // 2. Calculate total
        $total = $telugu + $hindi + $english + $maths + $science + $social;
         $totalData = [
            'id'      => $id,
            'marks'  => $total,
        ];
        $studentmodel = new \App\Models\StudentModel();

        if ($count > 0) {
            // Record does not exist, so update or insert based on your logic
            $model->update($id, $marksData);
            $studentmodel->update($id, $totalData);
        } else {
            // Insert or update if exists
            $model->save($marksData);
            $studentmodel->save($totalData);
        }
        return $this->response->setJSON(['status' => 'success', 'message' => 'Data saved successfully','count' => $count,]);
    }

}