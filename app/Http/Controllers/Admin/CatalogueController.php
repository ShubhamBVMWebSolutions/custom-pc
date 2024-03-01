<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogue;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogues = Catalogue::orderBy('title','ASC')->get();
    	$data = compact('catalogues');
        return view('admin.catalogues.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalogues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:catalogues',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $catalogue = new Catalogue();
        $catalogue->title = $request->title;
        $catalogue->start_date = $request->start_date;
        $catalogue->end_date = $request->end_date;
        if($request->hasFile('banner'))
        {
            $dir = public_path('/')."uploads/catalogues/";
            

            $banner = time().'.'.$request->banner->getClientOriginalExtension();
            $uploadImg = $request->file('banner')->move($dir , $banner);
            $catalogue->banner = $banner;
        }
        
        if($request->hasFile('pdf'))
        {
            $dir = public_path('/')."uploads/catalogues/";
            

            $pdf = time().'.'.$request->pdf->getClientOriginalExtension();
            $uploadImg = $request->file('pdf')->move($dir , $pdf);
            $catalogue->pdf = $pdf;
        }
        $catalogue->status = $request->status;
        $catalogue->save();
        
        session()->flash("alert-success","Catalogue added successfully.");
        return redirect()->route("admin.catalogues.index");
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
        $catalogue = Catalogue::find($id);
        if(empty($catalogue)){
            return redirect()->back();
        }
    	$data = compact('catalogue');
        return view('admin.catalogues.edit',$data);
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
            'title' => 'required|unique:catalogues,id,'.$id,
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
        ]);

        $catalogue = Catalogue::find($id);
        $catalogue->title = $request->title;
        $catalogue->start_date = $request->start_date;
        $catalogue->end_date = $request->end_date;
        if($request->hasFile('banner'))
        {
            $dir = public_path('/')."uploads/catalogues/";
            

            $banner = time().'.'.$request->banner->getClientOriginalExtension();
            $uploadImg = $request->file('banner')->move($dir , $banner);
            $catalogue->banner = $banner;
        }
        
        if($request->hasFile('pdf'))
        {
            $dir = public_path('/')."uploads/catalogues/";
            

            $pdf = time().'.'.$request->pdf->getClientOriginalExtension();
            $uploadImg = $request->file('pdf')->move($dir , $pdf);
            $catalogue->pdf = $pdf;
        }
        $catalogue->status = $request->status;
        $catalogue->save();
        
        session()->flash("alert-success","Catalogue updated successfully.");
        return redirect()->route("admin.catalogues.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = Catalogue::find($idFor);
            $oldImage = $IsExists_info->banner;
            $oldPdf= $IsExists_info->pdf;
            if (!empty($oldImage)) {
                    $dir = public_path('/')."uploads/catalogues/";
                    if (file_exists($dir . $oldImage)) {
                        \File::delete($dir . $oldImage);
                    }
            }
            
            if (!empty($oldPdf)) {
                    $dir = public_path('/')."uploads/catalogues/";
                    if (file_exists($dir . $oldPdf)) {
                        \File::delete($dir . $oldPdf);
                    }
            }
                $ResponseStatus =  $IsExists_info->delete();
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
}
