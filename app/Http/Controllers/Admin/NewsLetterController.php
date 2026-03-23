<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function newslater_list()
    {
        $newsletters = Newsletter::orderBy('id', 'DESC')->paginate(15);
        return view('admin.newsletter.index', compact('newsletters'));
    }

    public function delete_newsletters($id){
        Newsletter::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Newsletter Delete successfully.');
    }
}
