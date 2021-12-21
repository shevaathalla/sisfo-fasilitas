<?php

namespace App\Http\Controllers;

use App\Laboratorium;
use App\LoanLaboratorium;
use App\LoanTool;
use App\Tool;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();        
        $laboratoria = Laboratorium::where('status', 'available')->get();
        $tools = Tool::where('stock', '>', 0)->get();

        $widget = [
            'users' => $users,
            'laboratoria' => $laboratoria,
            'tools' => $tools
        ];
    
        return view('home', compact('widget'));
    }

    public function loanLaboratorium(Request $request){
        $request->validate([
            "proposal" => ['url']
        ]);

        DB::transaction(function () use($request) {            
            LoanLaboratorium::create([            
                "user_id" => auth()->user()->id,
                "reason" => $request->reason,
                "laboratorium_id" => $request->laboratorium,
                "proposal" => $request->proposal
            ]);

            Laboratorium::where('id', $request->laboratorium)->update([
                "status" => "unavailable"
            ]);
        });

        return redirect()->route('home')->with('success','Peminjaman laboratorium berhasil ditambahkan');
    }

    public function loanTool(Request $request){
        $request->validate([
            "proposal" => ['url']
        ]);

        $tool = Tool::where('id', $request->tool);

        if ($tool->first()->stock <= $request->quantity) {
            return redirect()->back()->withErrors("stock barang {$tool->first()->name} tidak mencukupi");
        }

        DB::transaction(function () use($request, $tool) {
            LoanTool::create([
                "user_id" => auth()->user()->id,
                "tool_id" => $request->tool,
                "quantity" => $request->quantity,
                "reason" => $request->reason,
                "proposal" => $request->proposal
            ]);

            $tool->decrement('stock', $request->tool);
        });

        return redirect()->route('home')->with('success','Peminjaman barang berhasil ditambahkan');
    }
}
