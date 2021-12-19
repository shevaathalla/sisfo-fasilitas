<?php

namespace App\Http\Controllers;

use App\Laboratorium;
use App\LoanLaboratorium;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanLaboratoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = LoanLaboratorium::with('laboratorium', 'user')->get();
        $laboratoria = Laboratorium::where('status', 'available')->get();
        return view('pages.loans.laboratorium.index', compact('loans', 'laboratoria'));
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
        
        DB::transaction(function () use ($student, $request) {
            //menambahkan data peminjaman laboratorium
            LoanLaboratorium::create([
                "user_id" => $student->id,
                "laboratorium_id" => $request->laboratorium,
                "reason" => $request->reason,
                "proposal" => $request->proposal,
                "department_verification" => $request->department_verification,
                "faculty_verification" => $request->faculty_verification,
            ]);

            //mengubah status laboratorium yang dipinjam
            Laboratorium::where('id', $request->laboratorium)->update([
                "status" => "unavailable"
            ]);
        });

        return redirect()->route("loan.laboratorium.index")->with('success', "Data peminjaman laboratorium berhasil ditambahkan");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanLaboratorium  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoanLaboratorium $loan)
    {
        $request->validate([
            "proposal" => ['url']
        ]);
        $student = User::where('nim', $request->nim)->first();

        if ($student == null) {
            return redirect()->back()->withErrors("data dengan nim {$request->nim} tidak ditemukan");
        }
        DB::transaction(function () use ($student, $request, $loan) {

            //mengubah status laboratorium yang akan diganti
            Laboratorium::where('id', $loan->laboratorium_id)->update([
                "status" => "available"
            ]);

            LoanLaboratorium::where('id', $loan->id)->update([
                "user_id" => $student->id,
                "laboratorium_id" => $request->laboratorium,
                "reason" => $request->reason,
                "proposal" => $request->proposal,
                "department_verification" => $request->department_verification,
                "faculty_verification" => $request->faculty_verification,
            ]);

            Laboratorium::where('id', $request->laboratorium)->update([
                "status" => "unavailable"
            ]);
        });

        return redirect()->route("loan.laboratorium.index")->with('success', "Data peminjaman laboratorium {$loan->id} berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoanLaboratorium  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanLaboratorium $loan)
    {
        if ($loan->status == false) {
            return redirect()->back()->withErrors("data peminjaman dengan id:{$loan->id} belum dikembalikan");
        }
        $temp = $loan;
        LoanLaboratorium::destroy($loan->id);

        return redirect()->route("loan.laboratorium.index")->with('success', "Data peminjaman laboratorium {$temp->name} berhasil dihapus");
    }

    public function confirm(LoanLaboratorium $loan)
    {
        DB::transaction(function () use ($loan) {
            LoanLaboratorium::where('id', $loan->id)->update(["status" => 1]);
            Laboratorium::where('id', $loan->laboratorium_id)->update(["status" => "available"]);
        });

        return redirect()->route("loan.laboratorium.index")->with('success', "Peminjaman laboratorium {$loan->laboratorium->name} berhasil diselesaikan");
    }
}
