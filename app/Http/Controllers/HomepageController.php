<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class HomepageController extends Controller 
{ 
    //fungsi untuk menampilkan halaman homepage 
    public function index()
        {
            $categories = Categories::all();

            return view('web.homepage',[
                'categories' => $categories,
            ]);
        }

}