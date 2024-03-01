<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PcBudget;

class PcBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = PcBudget::orderBy('id','ASC')->get();
        $data = compact('budgets');
        return view('admin.pc-budgets.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pc-budgets.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $budget = PcBudget::find($id);
        if(empty($budget)){
            return redirect()->back();
        }
    	$data = compact('budget');
        return view('admin.pc-budgets.edit',$data);
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
        $id = base64_decode($id);
        $validated = $request->validate([
            'title' => 'required|unique:pc_budgets,id,'.$id,
            'amount' => 'required|numeric',
        ]);
        $budget = PcBudget::find($id);
        $budget->title = $request->title;
        $budget->amount = $request->amount;
        $budget->save();

        session()->flash("alert-success","PC budget updated successfully.");
        return redirect()->route("admin.pc-budgets.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
