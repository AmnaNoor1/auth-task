<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $allcards = Card::all(); 
        $allcategories = Category::all(); 
        return view('user.layouts.dashboard', ['cards'=>$allcards, 'categories'=>$allcategories]);
    }

}
