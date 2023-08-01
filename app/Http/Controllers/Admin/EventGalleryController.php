<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{EventGallery,Event};

class EventGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['events']=Event::where('status','!=',2)->latest()->get(['id','title','date']);
        return view('admin.event_gallery.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('file');
        $imageName = time() .'eve_'.$image->getClientOriginalExtension();
        $image->move(public_path('images/events'),$imageName);
        // 
        EventGallery::updateOrCreate([
                'id' => decryptid($request->id),
            ],[
                'image'=>$imageName,
                'event_id'=>$request->event,
            ]);
        return response()->json(['success'=>$imageName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $images=EventGallery::latest()->get(['id','image']);
        $html='<div class="row">';

        foreach ($images as $key => $image) {
            $html.='<div class="col-md-2" style="margin-bottom:16px;" align="center">
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:16px;" align="center">
                                <img src="'.asset('images/events/'.$image->image).'" class="img-thumbnail" width="175" heigth="175" style="heigth:175px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:16px;" align="center">
                                <button tyoe="button" class="btn btn-link remove_image" data-id="'.$image->id.'" data-name="'.$image->image.'"> Remove</button>
                            </div>
                        </div>
                    
                </div> 
            ';
        }

        echo $html;
        // $response = [
        //         'status' => true,
        //         'html'=>$html
        //         'icon' => 'success',
        //     ];

        // return response($response);
    }

    public function event_images(Request $request)
    {
        $images=EventGallery::latest()->where('event_id',$request->event_id)->get(['id','image']);
        $html='<div class="row">';

        foreach ($images as $key => $image) {
            $html.='<div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.asset('images/events/'.$image->image).'" class="img-thumbnail" width="175" heigth="175" style="heigth:175px;">
                <button tyoe="button" class="btn btn-link remove_image" data-id="'.$image->id.'" data-name="'.$image->image.'"> Remove</button>
                </div> 
            ';
        }

        $response = [
                'status' => true,
                'html'=>$html,
                'icon' => 'success',
            ];

        return response($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function deleteImage(Request $request)
    {
         try {
            EventGallery::where('id',$request->id)->delete();
            \File::delete(public_path('images/events/'.$request->name));
            $response = [
                'status' => true,
                'message' => "Image Deleted Successfully",
                'icon' => 'success',
            ];
        }catch (\Throwable $e) {
            $response = [
                'status' => false,
                'message' => "Something Went Wrong! Please Try Again.",
                'icon' => 'error',
            ];
        }

         return response($response);
    }
}
