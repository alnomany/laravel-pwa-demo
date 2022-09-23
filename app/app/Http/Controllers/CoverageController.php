<?php

namespace App\Http\Controllers;

use App\Coverage;
use Illuminate\Http\Request;

class CoverageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $data = Coverage::orderBy('id','asc')->paginate(15);
        return view('admin.coverages.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $create = Coverage::create(array(
            'title' => $request->input('coverage')
          ));


                        $data = Coverage::orderBy('id','asc')->paginate(15);
                        return redirect()->route('admin.coverage.index',compact('data'))->with('success','تم اضافة بنجاح');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function show(Coverage $coverage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function edit(Coverage $coverage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coverage $coverage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coverage  $coverage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $sample = Coverage::destroy($id);

        // Redirect to the group management page
        return redirect(route('admin.coverage.index'))->with('success', 'تم الحذف النجاح');
    }
}
