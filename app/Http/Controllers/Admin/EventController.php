<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.event.index');
    }


    //Listing Data Of Event
    public function listing(){
        $data['eventData']= Event::where('status','!=',2)->latest()->get(['id','title','date']);
        $result = [];
        // $permissionList = permission();
        foreach ($data['eventData'] as $key=>$event) {
            $checkbox='';
            $checkbox='<input type="checkbox" class="checkbox"  name="id[]" id="' . encryptid($event['id']) . '" s onclick="single_unselected(this);"   style="    margin-left: 8px;"/>';
            $button = '';
            // if(in_array("19", $permissionList)){
                $button .= '<button class="edit_event btn btn-sm btn-success m-1"  data-id="'.encryptid($event['id']).'">
                <i class="mdi mdi-square-edit-outline"></i>
                </button>';
            // }
            // if(in_array("20", $permissionList)){
                $button .= '<button class="delete btn btn-sm btn-danger m-1" data-id="'.encryptid($event['id']).'">
                <i class="mdi mdi-delete"></i>
                </button>';
            // }
            $result[] = array(
            "0"=>$checkbox,
            "1"=>ucfirst($event->title),
            "2"=>Carbon::parse($event->date)->format('d-m-Y'),
            "3"=>$button
            );
        }
        return response()->json(['data'=>$result]);
    }

    public function uploadPhotoIndex()
    {
        return view('admin.event.photo_upload');
    }

    public function uploadPhotoStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images/events'),$imageName);
        
        // $imageUpload = new ImageUpload();
        // $imageUpload->filename = $imageName;
        // $imageUpload->save();
        return response()->json(['success'=>$imageName]);
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
         $request->validate(
            [
                'title' => 'required',
                'event_date' => 'required',
            ]
        );
        $imageName='';
        if(isset($request->file))
        {
            $image = $request->file('file');
            $imageName = time() .'_eve_'.$image->getClientOriginalExtension();
            $image->move(public_path('images/events/thumnail'),$imageName);
        }
        
        if(decryptid($request->event_id) != 0 && empty($imageName))
        {
            $event=Event::where('id',decryptid($request->event_id))->first();
            $imageName=$event->image;
            // dd($event);
        }
         $status=0;
        if($request->status && $request->status == 'on')
        {
            $status=1;
        }
        try {
            Event::updateOrCreate([
                'id' => decryptid($request->event_id),
            ],[
                'title' => $request->title,
                'image'=> $imageName,
                'date'=>Carbon::createFromFormat('d-m-Y', $request->event_date)
                ->format('Y-m-d H:i:s'),
                'user_id'=>Auth::user()->id,
                'status'=>$status,
            ]);
            $response = [
                'status' => true,
                'message' => 'Event data '.(decryptid($request->event_id) == 0 ? 'Added' : 'Updated').' Successfully',
                'icon' => 'success',
            ];
        } catch (\Throwable $e) {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong! Please Try Again.',
                'icon' => 'error',
            ];
        }
        return response($response);
        // return response($imageName);

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
         try {
            $data['event'] = Event::where('id',decryptid($id))->first();
            $response = [
                'date'=>Carbon::parse($data['event']->date)->format('d-m-Y'),
                'data'=>$data,
                'status'=>true,
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
        try {
            $update['status'] = 2;
            Event::where('id',decryptid($id))->update($update);;
            $response = [
                'status' => true,
                'message' => "Event Data Deleted Successfully",
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

    /* delete selected Event */
    public function deleteAll(Request $request)
    {
        $update['status'] = 2;
        $ids = [];
        $data_ids = $request->ids;
        foreach ($data_ids as $key => $value) {
            $ids[] = decryptid($value);
        }
        $events = Event::where('status', '!=', 2)->pluck('id')->toArray();
        $result = Event::whereIn('id', array_intersect($ids, $events))->update($update);
        if ($result) {
            $response = [
                'status' => true,
                'message' => 'Event Deleted Successfully',
                'icon' => 'success',
            ];
        } else {
            $response = [
                'status' => false,
                'message' => "error in deleting",
                'icon' => 'error',
            ];
        }
        return response($response);
    }


    /*Check Availability Of Event*/
     public function event_check(Request $request){
        if(isset($request) && $request->title && $request->id){
        $event = Event::where('title',$request->title)->where('id','!=',decryptid($request->id))->where('status','!=',2)->first('title');
        return(!is_null($event))? true :false;
        }else{
            return false;
        }
    }
}
