<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    @var array

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function scopeFilter($query, $filters)
    {

        if(isset($filters['search_text'])){
            $search_text = $filters['search_text'];

            $query->where(function($query) use($search_text) {
                $query->where('name', 'like', '%'.$search_text.'%');
                $query->orWhere('email', 'like', '%'.$search_text.'%');
                $query->orWhere('phone', 'like', '%'.$search_text.'%');
            });
        }
        return $query;
    }

    public function all(Request $request)
    {

        return Student
        ->get();
    }

    public function item($id)
    {

        return User::where('id', $id)
            ->first();

    }



}
