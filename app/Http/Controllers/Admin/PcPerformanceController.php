<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PcPerformance;
use App\Models\PcBudget;
use App\Models\Chipset;

class PcPerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = PcBudget::orderBy('id','ASC')->get();
        $chipsets = Chipset::orderBy('id','ASC')->get();
        $data = compact('budgets','chipsets');
        return view('admin.pc-performances.index',$data);
    }

    public function updateOrInsert(Request $request){
        $validated = $request->validate([
            'pc_budget_id' => 'required',
            'chipset_id' => 'required',
            'pixel' => 'required',
            'cod_fps' => 'required',
            'fortnite_fps' => 'required',
            'minecraft_fps' => 'required',
            'gta_fps' => 'required',
        ]);
        
        $performance = PcPerformance::where('pc_budget_id',$request->pc_budget_id)->where('chipset_id',$request->chipset_id)->where('pixel',$request->pixel)->first();
    
        if(empty($performance)){
            //insert
            $performance = new PcPerformance();
        }
        
        $performance->pc_budget_id=$request->pc_budget_id;
        $performance->chipset_id=$request->chipset_id;
        $performance->pixel=$request->pixel;
        $performance->cod_fps=$request->cod_fps;
        $performance->fortnite_fps=$request->fortnite_fps;
        $performance->minecraft_fps=$request->minecraft_fps;
        $performance->gta_fps=$request->gta_fps;
        $performance->save();

        session()->flash("alert-success","PC Performance updated successfully.");
        return redirect()->route("admin.pc-performances.index");
    }
    
    public function get_pc_performances(Request  $request){
        $performance = PcPerformance::where('pc_budget_id',$request->pc_budget_id)->where('chipset_id',$request->chipset_id)->where('pixel',$request->pixel)->first();
        if(!empty($performance)){
            return response()->json(['response' => true, 'data' => $performance,'message'=>'Data available']);
        }else{
            return response()->json(['response' => false, 'data' => $performance,'message'=>'Data not available']);
        }
    }
    
    
    
}
