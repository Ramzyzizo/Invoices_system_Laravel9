<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.section',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validation_data= $request->validate([
            'section_name'=>'required|unique:sections',
            'description'=>'required',
        ], [
            'section_name.required' => 'يرجى ادخال اسم للقسم',
            'section_name.unique' => 'اسم القسم مسجل بالفعل',
            'description.required' => 'يرجى ادخال وصف القسم',
        ]);

        $input['Created_by']=Auth::user()->name;
        sections::create($input);
        session()->flash('added','تم اضافة القسم بنجاح');
        return redirect('/sections');
    }

    /**
     * Display the specified resource.
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sections $sections)
    {
        $id = $request->id;

        $this->validate($request,[
            'section_name'=>'required|unique:sections,section_name,'.$id,
            'description' => 'required',
        ], [
            'section_name.required' => 'يرجى ادخال اسم للقسم',
            'section_name.unique' => 'اسم القسم مسجل بالفعل',
            'description.required' => 'يرجى ادخال وصف القسم',
        ]);
        $section = sections::findOrFail($id);
        $section->update($request->all());
        session()->flash('edit','تم تعديل القسم بنجاخ');
        return redirect('/sections');


    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request)
    {
        sections::findOrFail($request->id)->delete();
        session()->flash('delete','تم الحذف بنجاح');
        return redirect('/sections');


    }
}
