<?php

namespace App\Http\Controllers;
use App\Models\Crud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// use Session;

class CrudController extends Controller {
    public function showData() {
        // $show_data = Crud::all();
        // $show_data = Crud::simplePaginate(5);
        $show_data = Crud::paginate(5);

        return view('show_data', compact('show_data'));
    }
    public function addData() {
        return view('add_data');
    }
    public function storeData(Request $request) {
        $rules = [
            'name' => 'required|max:10',
            'email' => 'required|email',
            'phone' => 'required|min:11|numeric',
        ];
        $cm = [
            'name.required' => 'Enter Your name!',
            'name.max' => 'Your name can not contain more than 10 character!',

            'email.required' => 'Enter Your email!',
            'email.email' => 'Email must be a valid email!',

            'phone.required' => 'Enter Your phone',
            'phone.max:11|numeric' => 'Your phone can not contain more than 11 character and must be a numeric',
        ];
        $this->validate($request, $rules, $cm);
        $crud = new Crud();
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->phone = $request->phone;
        $crud->save();
        Session::flash('msg', 'Data Added successfully ');

        return redirect('/');
    }
    public function editData($id = null) {
        $editData = Crud::find($id);
        return view('edit_data', compact('editData'));

    }
    public function updateData(Request $request, $id) {
        $rules = [
            'name' => 'required|max:10',
            'email' => 'required|email',
            'phone' => 'required|min:11|numeric',
        ];
        $cm = [
            'name.required' => 'Enter Your name!',
            'name.max' => 'Your name can not contain more than 10 character!',

            'email.required' => 'Enter Your email!',
            'email.email' => 'Email must be a valid email!',

            'phone.required' => 'Enter Your phone',
            'phone.max:11|numeric' => 'Your phone can not contain more than 11 character and must be a numeric',
        ];
        $this->validate($request, $rules, $cm);
        $crud = Crud::find($id);
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->phone = $request->phone;
        $crud->save();
        Session::flash('msg', 'Data Updated  successfully');

        return redirect('/');
    }
    public function deleteData($id = null) {
        $delete_id = Crud::find($id);
        $delete_id->delete();
        Session::flash('msg', 'Data Deleted  successfully');
        return redirect('/');
    }
}
