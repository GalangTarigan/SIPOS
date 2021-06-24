<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

class FileController extends Controller
{
    function index()
    {
     return view('pages.fileUpload');
    }

    function upload(Request $request)
    {
     $rules = array(
      'image'  => 'required|image|max:3072'
     );

     $error = Validator::make($request->all(), $rules);

     if($error->fails())
     {
      return response()->json(['errors' => $error->errors()->all()]);
     }

     $image = $request->file('image');

     $new_name = rand() . '.' . $image->getClientOriginalExtension();
     $image->move(public_path('images'), $new_name);

     $output = array(
         'success' => 'Image uploaded successfully',
         'image'  => '<img src="/images/'.$new_name.'" class="img-thumbnail" />'
        );

        return response()->json($output);
    }
}

