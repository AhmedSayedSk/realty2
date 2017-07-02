<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File ;
use Storage ;
use App\Realty;
use Auth;
use App\Comment;
use App\Session;
use App\User;


class realty_controller extends Controller
{
    public function index()
    {
        $realties = Realty::orderBy('id', 'desc')->paginate(10);
        return view('front.index', compact('realties', $realties));
    }

    public function create()
    {
        if (Auth::check()) {
            return view('front.realty.add_new');
        } else {
            return redirect('/auth');
        }
        
    }

    public function store(Request $request)
    {
        //country , city , region , street , apartment_no , house_no , price , area , telephone , description , type
        //$this->validate($request ,['country'=>'required' , 'city'=>'required' , 'street'=>'required' , 'house_no'=>'required' , 'price'=>'required' , 'area'=>'required' , 'price'=>'required' ,'type'=>'required' , 'telephone'=>'required|max:11' ,'images'=>'max:7']);
        
        $country = $request->input('country');
        $city = $request->input('city');
        $region = $request->input('region');
        $street = $request->input('street');
        $house_no = $request->input('house_no');
        $apartment_no = $request->input('apartment_no');
        $price = $request->input('price');
        $area = $request->input('area');
        $type = $request->input('type');
        $description = $request->input('description');
        $telephone = $request->input('telephone');
        $user_id = Auth::user()->id;

        $realty = new Realty;
        $realty->country = $country;
        $realty->city = $city;
        $realty->region = $region;
        $realty->street = $street;
        $realty->house_no = $house_no;
        $realty->apartment_no = $apartment_no;
        $realty->price = $price;
        $realty->area = $area;
        $realty->type = $type;
        $realty->description = $description;
        $realty->telephone = $telephone;
        $realty->user_id = $user_id;
        $realty->save();


        //saving the images :D
        $picture = '';
        $i = 1 ;
        $path = base_path() . '\public\front/images/'.$realty->id;
        File::makeDirectory($path);
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                if($extension =='jpg'){
                    $filename = $i.'.'.$extension ;
                    $i++ ;
                    $picture = $filename;
                    $file->move($path, $picture);
                }
            }
        }

        if (!empty($realty['images'])) {
            $realty['images'] = $picture;
        } else {
            unset($realty['images']);
        }

        //to this realty page
        return redirect("/realty/$realty->id");
    }

    public function show($id)
    {
        $realty = Realty::find($id);
        $user_id = $realty->user_id;
        $user= User::find($user_id);
        $realty->user_name = $user->name ;
        $directory = base_path() . '\public\front/images/'.$realty->id ;
        $files = File::allFiles($directory);

        //dd($realty);

        //echo $realty->user_name;

        return view('front.realty.show_realty', compact('realty', $realty , 'files' , $files));
        //return view('front.realty.show_realty', compact('realty', $realty));
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $realty = Realty::find($id);
            if ($realty->user_id == Auth::user()->id) {
                return view('front.realty.edit_realty', compact('realty', $realty));
            } else {
                return redirect('/realty');
            }
        } else {
            return redirect('/auth');
        }
/*
        $realties = Realty::where('id',$id)->get();
        return view('front.realty.edit_realty', compact('realties', $realties));*/
    }

    public function update(Request $request, $id)
    {
        $this->validate($request ,['country'=>'required' , 'city'=>'required' , 'street'=>'required' , 'house_no'=>'required' , 'price'=>'required' , 'area'=>'required' , 'price'=>'required' ,'type'=>'required' , 'telephone'=>'required|max:11']);
        
        $country = $request->input('country');
        $city = $request->input('city');
        $region = $request->input('region');
        $street = $request->input('street');
        $house_no = $request->input('house_no');
        $apartment_no = $request->input('apartment_no');
        $price = $request->input('price');
        $area = $request->input('area');
        $type = $request->input('type');
        $description = $request->input('description');
        $telephone = $request->input('telephone');
        $user_id = Auth::user()->id;

        $realty = Realty::find($id);
        $realty->country = $country;
        $realty->city = $city;
        $realty->region = $region;
        $realty->street = $street;
        $realty->house_no = $house_no;
        $realty->apartment_no = $apartment_no;
        $realty->price = $price;
        $realty->area = $area;
        $realty->type = $type;
        $realty->description = $description;
        $realty->telephone = $telephone;
        $realty->user_id = $user_id; 
        $realty->save();

        return redirect("/realty/$realty->id");
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            $realty = Realty::find($id);
            if ($realty->user_id == Auth::user()->id) {
                Realty::where('id', $id)->delete();
            }
            return redirect('/realty');
        } else {
            return redirect('/auth');
        }

    }

    public function add($id,$comment2){
        $comment = new Comment();
        $comment->post_id = $id;
        $comment->comment = $comment2;
        $comment->user_id = Auth::user()->id;//Session::get('user_name');
        $comment->save();
       return '<a><b>'.$comment->user->name."</b></a> ".$comment2;
    }
}
