<?php

namespace App\Http\Controllers;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\gallery;
use App\galleryImages;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use File;
class GalleryController extends Controller
{
    //

	public function viewGalleryList(){
		$galleries=gallery::all();

		return view('gallery.newgallery')->with(['galleries'=>$galleries]);
	}

	public function saveGallery(Request $request){
    //validate the request
		$validate=Validator::make($request->all(),['gallery_name'=>'required|min:3',]
			);
		if($validate->fails()){
			return redirect('gallery/list')->withErrors($validate)->withInput();
		}		
		$gallery=new gallery;
		$gallery->name=$request->gallery_name;
		$gallery->created_by=Auth::user()->id;
		$gallery->published=1;
		$gallery->save();

		return redirect()->back();
	}

	public function viewGalleyPics($id){
		$gallery=Gallery::findOrFail($id);
		return view('gallery.gallery-view')->with('gallery',$gallery);
	}

	public function doImageUpload(Request $request){
  //get the file from the post request
		$file=$request->file('file');
   //set my file name
		$filename=uniqid().$file->getClientOriginalName();
   //move the file to the correct location
		$file->move('gallery/images',$filename);
   //save image details to db
		$gallery=Gallery::find($request->gallery_id);
		$image=$gallery->images()->create([
			'gallery_id'=>$request->gallery_id,
			'picname'=>$filename,
			'picsize'=>$file->getClientSize(),
			'picmime'=>$file->getClientMimeType(),
			'picpath'=>'gallery/images/'.$filename,
			'created_by'=>Auth::user()->id
			]);
		return $image;
	}
	public function deleteGallery($id){
//load the gallery
		$currentGallery=Gallery::findOrFail($id);
 //check ownership
		if ($currentGallery->created_by!=Auth::user()->id) {
 		# code...
			abort('403','You are not allowed to delete');
		}	
 	//get the images 
		$images =$currentGallery->images();

 	//delete the images
		foreach ($currentGallery->images as $image) {
 		# code...

			$filename=$image->picname;
	//$file_path =public_path("gallery\images\{$filename}");
	//echo $file_path;
             //if(File::exists($file_path)) {
            // File::delete($file_path);		
             //}
			unlink(public_path("/gallery/images/".$filename));

	       //unlink("public/gallery/images/".$image->picname);
	      //echo public_path($image->picname);


		}

 	//delete the DB records
		$currentGallery->images()->delete();
		$currentGallery->delete();
		Session::flash('flash_success','you have deleted the gallery successfully');

		return redirect()->back();
	}

	public function deleteimage($id){
		$galleryimage=galleryImages::findOrFail($id);
		$imagepath=$galleryimage->picpath;
	    //echo $imagepath;
		$filename=$galleryimage->picname;
		unlink(public_path("/gallery/images/".$filename));
		$galleryimage->delete();
		Session::flash('flash_success','you have deleted the Image successfully');

		return redirect()->back();			
	}

	public function updateimageithcaption(Request $request,$id){
    
	$galleryimage=galleryImages::findOrFail($id);
    $galleryimage->caption1=$request->caption1;
    $galleryimage->caption2=$request->caption2;
	$galleryimage->save();

   Session::flash('flash_success','you have updated the Image successfully');

   return redirect('/gallery/view/'.$galleryimage->gallery_id);	
	}

	public function showupdate($id){
     $galleryimage=galleryImages::findOrFail($id);
      	
     return view('gallery.imageupdate')->with(['galleryimage'=>$galleryimage]);
	}



}
