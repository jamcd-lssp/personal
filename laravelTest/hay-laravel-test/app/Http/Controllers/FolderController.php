<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    public function showCreateForm()
    {
    	return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
    	$folder = new Todo();
    	$folder->title = $request->title;
    	Auth::user()->todos()->save($folder);

    	return redirect()->route('todo.index', [
    		'id' => $folder->id,
    	]);
    }

    public function delete(Request $request)
    {
        Auth::user()->todos()->get()->where('id', $request->folder_id)->first()->delete();
        $folder = Auth::user()->todos()->get();

        return redirect('/');
    }
}
