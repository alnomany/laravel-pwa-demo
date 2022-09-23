<?php

namespace App\Http\Controllers;


use App\Languages;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //
    public function index()
    {


        $data = Languages::orderBy('id','asc')->paginate(15);
        return view('admin.languages.index',compact('data'));

    }
    public function store(Request $request){
        $create = Languages::create(array(
            'language_name' => $request->input('language_name'),
            'language_iso' => $request->input('language_iso')
          ));
          $data = Languages::orderBy('id','asc')->paginate(15);
          return redirect()->route('admin.language.index',compact('data'))->with('success','تم اضافة بنجاح');

    }
    public function edit($language){
        $data=Languages::find($language);
        return view('admin.languages.edit',compact('data'));


    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $language = Languages::find($id);
        $language->update($input);


        return redirect()->route('admin.language.index')
                        ->with('success','Language updated successfully');
    }

    public function destroy($id = null)
    {
        $sample = Languages::destroy($id);

        // Redirect to the group management page
        return redirect(route('admin.language.index'))->with('success', 'تم الحذف النجاح');
    }

}
