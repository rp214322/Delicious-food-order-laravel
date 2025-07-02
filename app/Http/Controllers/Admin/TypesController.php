<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Types;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\Storage;


class TypesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function types()    { 
        
              
        $types = Types::orderBy('type')->get();
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
         
        return view('admin.pages.types',compact('types'));
    }
    
    public function addeditType()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        
        return view('admin.pages.addedittype');
    }
    
    public function addnew(Request $request)
    { 
    	
    	$data =  \Input::except(array('_token')) ;
	    
	    $rule=array(
		        'type' => 'required'
                // 'type_image' => 'required'		         
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	    $inputs = $request->all();
		
		if(!empty($inputs['id'])){
           
            $type_obj = Types::findOrFail($inputs['id']);

        }else{

            $type_obj = new Types;

        }

        //News image
        $type_image = $request->file('type_image');
         
        if($type_image){
            // Ensure directory exists
            if (!Storage::disk('public')->exists('type')) {
                Storage::disk('public')->makeDirectory('type');
            }
            if ($type_obj->type_image) {
                Storage::disk('public')->delete('type/'.$type_obj->type_image.'.jpg');
            }
            $hardPath = substr($inputs['type'],0,100).'_'.time();
            $img = Image::make($type_image);
            $img->fit(160, 160)->save(storage_path('app/public/type/'.$hardPath.'.jpg'));
            $type_obj->type_image = $hardPath;
        }
		 
		
		$type_obj->type = $inputs['type']; 
		 
		
		 
	    $type_obj->save();
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function editType($id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	     
          $type = Types::findOrFail($id);
          
          return view('admin.pages.addedittype',compact('type'));
        
    }	 
    
    public function delete($id)
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	
        $type = Types::findOrFail($id);
        $type->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
     
    	
}
