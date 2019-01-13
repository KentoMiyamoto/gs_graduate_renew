<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Book;
use App\entry;
use App\match;
use Validator;
use Auth;


class BooksController extends Controller
{
    
    public function index()
    {
$entries	=	entry::where('user_id',Auth::user()->id)	
->orderBy('created_at',	'desc')
->paginate(3);
         return view('portal', [
            'entries' => $entries
         ]);
    }
    
    
    
        public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function update (Request $request)
    {
          $validator = Validator::make($request->all(), [
        'id'=>'required',
        'item_name' => 'required|min:3|max:255',
        'item_number' => 'required|min:1|max:3',
        'item_amount' => 'required|max:6',
        'published' => 'required',
        
    ]);


    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）
    // Eloquent モデル
$books = Book::where('user_id',Auth::user()->id)->find($request->id);
$books->item_name = $request->item_name;
$books->item_number =  $request->item_number;
$books->item_amount =  $request->item_amount;
$books->published =  $request->published;
$books->save(); 
return redirect('/');

    
    }
 
    
  public function store (Request $request)
      
    {
      $validator = Validator::make($request->all(), [
        'item_name' => 'required|min:3|max:255',
        'item_number' => 'required|min:1|max:3',
        'item_amount' => 'required|max:6',
        'published' => 'required',
        
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）
    // Eloquent モデル
$books = new Book;
$books->user_id = Auth::user()->id;
$books->item_name = $request->item_name;
$books->item_number = '1';
$books->item_amount = '1000';
$books->published = '2017-03-07 00:00:00';
$books->save(); 
return redirect('/');
    }

    

  public function edit ($book_id)
      
    {
    $books = Book::where('user_id',Auth::user()->id)->find($book_id);    
    return view('booksedit', [
        'book' => $books
        ]);
        
    }
    
    
    
  public function destroy (entry $entry)
      
    {
    $entry->delete();
    return redirect('/');
        
    }
    


  public function entry(Request $request)
    {


$entries = new entry;
$entries->user_id = Auth::user()->id;
$entries->friend_id = $request->friend_id;
$entries->location = $request->location;
// $entries->item_number = '1';
// $entries->item_amount = '1000';
// $entries->published = '2017-03-07 00:00:00';
$entries->save(); 
return redirect('/');

    }


  public function matching ()
      
    {
        
$myself =  Auth::user()->id;
        
$matches = new match;
$matches->men_entry_id = entry::select()
                    ->join('users','users.id','=','entries.user_id')
                    ->value('user_id');

$matches->women_entry_id = entry::select()
                    -> where('user_id','<>',$myself) 
                    -> value('id');
$matches->save(); 

$opponent = entry::orderBy('created_at', 'asc')
 ->select()
 -> where('entries.user_id','<>',$myself) 
 -> first();
    
return view('matching',['opponent'=>$opponent]);


    }
    
    
    
    
      public function ok (){
          
          
          
          return redirect('/');
          
          
          
      }
      
    
    
    
    
}




