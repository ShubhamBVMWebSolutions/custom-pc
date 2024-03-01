<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HighlightProduct;


class HighlightproductController extends Controller
{
   public function index(){
    $highlightproduct = HighlightProduct::first();
    return view('admin/highlight-product/manage_highlight_product', ['highlightproduct' => $highlightproduct]);
   }

   public function update(Request $request){
    $highlightproduct = HighlightProduct::first();
    if(!$highlightproduct){
        $highlightproduct = new HighlightProduct();
    }
    $highlightproduct->link1 = $request->input('link1');
    $highlightproduct->link2 = $request->input('link2');
    $highlightproduct->link3 = $request->input('link3');


    // Handle icon upload
    if ($request->hasFile('image1')) {
        $image = $request->file('image1');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/images', $filename);
        $highlightproduct->image1 = $filename;
    }

    if ($request->hasFile('image2')) {
        $image = $request->file('image2');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/images', $filename);
        $highlightproduct->image2 = $filename;
    }

    if ($request->hasFile('image3')) {
        $image = $request->file('image3');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move('public/images', $filename);
        $highlightproduct->image3 = $filename;
    }

    $highlightproduct->save();
    return redirect()->route('admin.highlightproduct.index')->with('message', 'Content updated successfully.');
   }

}