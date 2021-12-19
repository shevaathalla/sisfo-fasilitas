<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::where('type', 'student')->get();        
        return view('pages.student.index',compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            "name" => $request->name,
            "nim" => $request->nim,
            "email" => $request->email,
            "major" => $request->major,
            "faculty" => $request->faculty,
            "password" => "password",
            "type" => "student",
        ]);

        return redirect()->route("student.index")->with('success', 'Data user berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id', $id)->update([
            "name" => $request->name,
            "last_name" => "",
            "nim" => $request->nim,
            "email" => $request->email,
            "major" => $request->major,
            "faculty" => $request->faculty,
            "password" => "password",
            "type" => "student",
        ]);
        return redirect()->route("student.index")->with('success', 'Data user berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route("student.index")->with('success', 'Data user berhasil dihapus');
    }
}
