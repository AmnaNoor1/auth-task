<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{

    public function addcard(){
        $allcategories =  Category::select('name')->get(); 
        $allcards= Card::all();
        return view('admin.addcard', ['categories'=>$allcategories,'cards'=>$allcards]);
    }

    public function store(Request $request)
    {

     
         if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cards', 'public');
        }
        
        // $imagePath = $request->file('image')->store('cards', 'public');
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->passes()) {
            $card = new Card();
            $card->title = $request->title;
            $card->category = $request->category;
            $card->image = $imagePath;
            $card->save();
            return redirect()->route('admin.addcard')->with('success','added new card successfully');

        } else {
            return redirect()->route('admin.addcard')
            ->withInput()
            ->withErrors($validator);
        }
    }


    public function viewallcards(){
        $allcards = Card::all(); 
        $cardcount = Card::count();
        $catcount=Category::count();
        $usercount=User::count();
        return view('admin.viewallcard', ['cards'=>$allcards,'cardCount'=>$cardcount,'catCount'=>$catcount,'userCount'=>$usercount]); 
    }

    // public function editcard(){
    //     $allcategories =  Category::select('name')->get(); 
    //     // return view('admin.addcard', compact('categories'));
    //     $allcards = Card::all(); 
    //     return view('admin.editcard', ['categories'=>$allcategories,'cards'=>$allcards]); 
    // }

    public function updatecard(Request $request){
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if ($validator->passes()) {
        $card = Card::find($request->id);
        $card->title = $request->title;
        $card->category = $request->category;
    
        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cards', 'public');
            $card->image = $imagePath;
        }
    
        $card->save();
    
        return redirect()->route('admin.addcard')->with('success', 'Card updated successfully!');
    } else {
        return redirect()->back()->withErrors($validator)->withInput();
    }
   
}

public function deletecard(string $id){
    $card = Card::find($id);
    $card->delete();
    return redirect()->route('admin.addcard')->with('success', 'Card deleted successfully!');

}


}
