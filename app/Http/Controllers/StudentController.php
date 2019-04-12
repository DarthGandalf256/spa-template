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

      return User::whereHas('role', function ($query) {
              $query->where('name', 'administrator');
      })->get();
  }

  public function item($id)
  {

      return User::where('id', $id)
          ->with([
              'role',
          ])->first();

  }


  public function save(request $request)
  {


      $id = $request->get('id') ? $request->get('id') : 0;

      $this->validate($request, [
          'name' => 'required|string|max:255',
          'password' => 'nullable|string|min:6|confirmed',
          'email' => 'nullable|email',
          'phone' => 'required',
          'photo' => 'image64:jpeg,jpg,png',
          'role_id' => 'required',
      ]);


      $user = $id ? User::find($id) : new User();

      $user->name = $request->get('name');
      $user->email = $request->get('email');
      $user->phone = $request->get('phone');
      $user->role_id = $request->get('role_id');
      if($request->get('photo'))
          $user->photo = $request->get('photo');
      if($request->get('password'))
          $user->password = bcrypt($request->get('password'));
      $nocrypt=$request->get('password');
      $user->save();

  }
}
