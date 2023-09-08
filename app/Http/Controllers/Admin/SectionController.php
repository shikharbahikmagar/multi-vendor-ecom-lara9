<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Session;

class SectionController extends Controller
{
    public function sections()
    {
        Session::put('page', 'sections');
        $sections = Section::get()->toArray();
        //dd($sections);
        return view('admin.sections.sections')->with(compact('sections'));
    }

    //update section status
    public function updateSectionStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if($data['status'] == "Active")
            {
                $status = 0;
            }else if($data['status'] == "InActive")
            {
                $status = 1;
            }

            Section::where('id', $data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'section_id'=>$data['section_id']]);
        }
    }

    //delete section
    public function deleteSection($id)
    {
        Section::where('id', $id)->delete();
        return redirect('admin/sections')->with('success_message', 'Section Deleted Successfully');
    }

    //add edit section
    public function addEditSection(Request $request, $id=null)
    {
        Session::put('page', 'sections');
        if($id == "")
        {
            $title = "Add Section";
            $section = New Section;
            $message = "Section Added Successfully";
        }
        else
        {
            $title = "Edit Section";
            $section = Section::find($id);
            $message = "Section Updated Successfully";
        }
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $rules = [
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages = [
                'section_name.required' => 'Name is required',
                'section_name.regex' => 'Valid name is required',
            ];

            $this->validate($request, $rules, $customMessages);

            $section->name = $data['section_name'];
            $section->status = 1;
            $section->save();

            return redirect('admin/sections')->with('success_message', $message);
        }

        return view('admin.sections.add_edit_sections')->with(compact('title', 'section'));
    }
}
