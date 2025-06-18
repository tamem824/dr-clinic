<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::query()
            ->when($search, function($query, $search) {
                return $query->where('fullname', 'like', "%{$search}%");
            })->orderBy('id','desc')
            ->paginate(50);
        return view('home',compact('patients'));
    }
}
