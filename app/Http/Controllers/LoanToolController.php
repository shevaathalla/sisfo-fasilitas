<?php

namespace App\Http\Controllers;

use App\LoanTool;
use App\Tool;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = LoanTool::with('tool', 'user')->get();
        $tools = Tool::where('stock', '>', 0)->get();
        return view('pages.loans.tool.index', compact('loans', 'tools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "proposal" => ['url']
        ]);

        $student = User::where('nim', $request->nim)->first();

        if ($student == null) {
            return redirect()->back()->withErrors("data dengan nim {$request->nim} tidak ditemukan");
        }

        $tool = Tool::where('id', $request->tool);

        if ($tool->first()->stock <= $request->quantity) {
            return redirect()->back()->withErrors("stock barang {$tool->first()->name} tidak mencukupi");
        }

        DB::transaction(function () use ($request, $tool, $student) {
            LoanTool::create([
                "user_id" => $student->id,
                "tool_id" => $request->tool,
                "reason" => $request->reason,
                "quantity" => $request->quantity,
                "proposal" => $request->proposal,
                "department_verification" => $request->department_verification,
                "faculty_verification" => $request->faculty_verification,
            ]);                                

            $tool->decrement('stock', $request->quantity);
        });

        return redirect()->route("loan.tool.index")->with('success', "Data peminjaman barang berhasil ditambahkan");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanTool  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanTool $loan)
    {
        $request->validate([
            "proposal" => ['url']
        ]);

        $student = User::where('nim', $request->nim)->first();

        if ($student == null) {
            return redirect()->back()->withErrors("data dengan nim {$request->nim} tidak ditemukan");
        }

        $tool = Tool::where('id', $request->tool);
        
        if ($tool->first()->stock <= $request->quantity) {
            return redirect()->back()->withErrors("stock barang {$tool->first()->name} tidak mencukupi");
        }
        
        DB::transaction(function () use ($request,$loan, $tool, $student) {
            $tool->increment("stock", $loan->quantity);

            LoanTool::where('id', $loan->id)->update([
                "user_id" => $student->id,
                "tool_id" => $request->tool,
                "reason" => $request->reason,
                "quantity" => $request->quantity,
                "proposal" => $request->proposal,
                "department_verification" => $request->department_verification,
                "faculty_verification" => $request->faculty_verification,
            ]);                                

            $tool->decrement('stock', $request->quantity);
        });

        return redirect()->route("loan.tool.index")->with('success', "Data peminjaman dengan id {$loan->id} berhasil diupdate");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoanTool  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanTool $loan)
    {
        if ($loan->status == false) {
            return redirect()->back()->withErrors("data peminjaman dengan id:{$loan->id} belum dikembalikan");
        }
        $temp = $loan;
        LoanTool::destroy($loan->id);
        return redirect()->route("loan.tool.index")->with('success', "Data peminjaman barang {$temp->name} berhasil dihapus");
    }

    public function confirm(LoanTool $loan){
        DB::transaction(function () use($loan) {
            LoanTool::where('id', $loan->id)->update(["status" => 1]);
            Tool::where('id', $loan->tool->id)->increment('stock', $loan->quantity);
        });
        return redirect()->route("loan.tool.index")->with('success', "Peminjaman barang {$loan->tool->name} berhasil diselesaikan");
    }
}
