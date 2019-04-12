<?php

namespace App\Http\Controllers;

use App\Student;
use App\php;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Manager;

class StudentController extends Controller
{
  public function items(Request $request)
  {
    return Student->filter(Input::all())->orderBy('id', 'desc')->paginate(20);
  }

  public function all(Request $request)
  {

      return Student
      ->get();
  }

  public function item($id)
  {

      return Student::where('id', $id)
          ->first();
  }


  public function save(request $request)
  {

      $id = $request->get('id') ? $request->get('id') : 0;

      $student = $id ? Student::find($id) : new Student();

      $student->name = $request->get('name');
      $student->email = $request->get('email');
      $student->phone = $request->get('phone');
      $user->save();

  }

  public function delete($id)
  {

      $student = Student::find($id);
      Student::destroy($id);

  }
}
