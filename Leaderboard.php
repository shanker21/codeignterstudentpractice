<?php namespace App\Controllers;

class Leaderboard extends BaseController{

    public function index()
    {
        $studentModel = new \App\Models\StudentModel();
        $data = [
            'title' => 'Leaderboard',
            'page'  => 'leaderboard'
        ];
        // Get students ordered by total marks descending
        $data['students'] = $studentModel->orderBy('marks', 'DESC')->findAll();

        return view('leaderboard', $data);
    }
    public function getstudentdata(){
        $myFun = new Myfunction();
        $data = $myFun->getstudentdata();
        return $this->response->setJSON($data ?? []);

    }
}