<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\Amenities;

class PropertyTypeController extends Controller
{
    public function AllType(){

        $types = PropertyType::latest()->get();
        return view('backend.type.all_type' ,compact('types'));

    } // End Method

    public function AddType(){

        return view ('backend.type.add_type');

    }// End Method

    public function StoreType(Request $request){
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification=array(
            'message'=>'Property Type Created Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.type')->with($notification);

    }// End Method

    public function EditType($id){

        $types = PropertyType::findorFail($id);
        return view('backend.type.edit_type',compact('types'));

    }// End Method

    public function UpdateType(Request $request){

        $pid = $request->id;

        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification=array(
            'message'=>'Property Type Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.type')->with($notification);

    }// End Method

    public function DeleteType($id){

        PropertyType::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Property Type Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    ///////// All Amenities Methods  ////////////
    public function AllAmenities(){

        $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenities' ,compact('amenities'));
        
    } // End Method

    public function AddAmenities(){

        return view('backend.amenities.add_amenities');
    }

    public function StoreAmenities(Request $request){
        $request->validate([
            'amenities_name' => 'required',

        ]);

        Amenities::insert([
            'amenities_name' => $request->amenities_name,

        ]);
        $notification=array(
            'message'=>'Amenities Created Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.amenities')->with($notification);

    }// End Method

    public function EditAmenities($id){

        $amenitie = Amenities::findorFail($id);
        return view('backend.amenities.edit_amenities',compact('amenitie'));

    }// End Method

    public function UpdateAmenities(Request $request){

        $aid = $request->id;

        Amenities::findOrFail($aid)->update([
            'amenities_name' => $request->amenities_name,
            
        ]);
        $notification=array(
            'message'=>'Amenities Updated Successfully',
            'alert-amenities'=>'success'
        );
        return redirect()->route('all.amenities')->with($notification);

    }// End Method

    public function DeleteAmenities($id){

        Amenities::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Amenities Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
