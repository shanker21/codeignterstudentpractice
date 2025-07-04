<?php

namespace App\Controllers;
use App\Models\StudentModel;
class Add extends BaseController
{
    public function add(): string
    {
        $data = [
            'title' => 'Add Data',
            'page'  => 'add'
        ];
        return view('add', $data);
    }

     function submitDetails()
    {
        helper(['form','filesystem']);
        $session = session();
        $model = new StudentModel();
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];

        $exists = $model->where('name', $name)->first();
        $insert = [
            'name'=>$name,
            'age'=>$age,
            'email'=>$email,
        ];
        if($exists){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Name already exists.'
            ]);
        }
        $model->save($insert);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data Added Successfully'
        ]);
    }

    public function edit($id){
        $model = new StudentModel();
        $data['student'] = $model->find($id);
        return view('edit', $data);
    }

    public function update($id){
        helper(['form','filesystem']);
        $session = session();
        $model = new StudentModel();
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $update = [
            'name'=>$name,
            'age'=>$age,
            'email'=>$email,
        ];

        //check the name is exist or not
        $exists = $model->where('name', $name)->where('id !=', $id)->first();
        if($exists){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Name already exists.'
            ]);
        }
        $model->update($id, $update);
        //redirect to the student page and show the message in frontend
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data Updated Successfully'
        ]);
    }

    public function delete($id){
        $model = new StudentModel();
        $model->delete($id);
        return redirect()->to(base_url('/studentlist'));
    }
}