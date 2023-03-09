<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request) 
    {
        //インスタンスの生成
        $folder = new Folder();
        $folder->title = $request->title;
        Auth::user()->folders()->save($folder);
//dump($folder);
        return redirect()->route('tasks.index', ['folder' => $folder->id,]);
    }
}
