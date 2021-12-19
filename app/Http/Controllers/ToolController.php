<?php

namespace App\Http\Controllers;

use App\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = Tool::all();
        return view('pages.tool.index',compact('tools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tool::create([
            "name" => $request->name,
            "stock" => $request->stock,
        ]);

        return redirect()->route('tool.index')->with('success', 'new tool has been created');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        Tool::where('id', $tool->id)->update([
            "name" => $request->name,
            "stock" => $request->stock,
        ]);

        return redirect()->route('tool.index')->with('success', "tool {$tool->name} has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tool $tool)
    {
        $temp = $tool;
        Tool::destroy($tool->id);
        return redirect()->route('tool.index')->with('success', "tool {$temp->name} has been deleted");
    }
}
