<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $all_event = Event::all();
        return view('admin.event.all_event')->with(compact('all_event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.event.add_event');
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
        $data = $request->all();
        $event = new Event();
        $event->event_name = $data['event_name'];
        $event->event_desc = $data['event_desc'];
        $event->event_content = $data['event_content'];
        $event->event_start = $data['event_start'];
        $event->event_end = $data['event_end'];
        $event->event_status = $data['event_status'];
        $event->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $event->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('event_image')) {
            $name = $request->file('event_image')->getClientOriginalName();
            // $name = $request->file('image')->hashName();
            $path = $request->file('event_image')->storeAs('public/event_image', $name);
            $event->event_image = $name;
        }
        $event->save();
        return redirect()->back()->with('status', 'Thêm sự kiện thành công');
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
        $event = Event::find($id);
        return view('admin.event.edit_event')->with(compact('event'));
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
        $data = $request->all();
        $event = Event::find($id);
        $event->event_name = $data['event_name'];
        $event->event_desc = $data['event_desc'];
        $event->event_content = $data['event_content'];
        $event->event_start = $data['event_start'];
        $event->event_end = $data['event_end'];
        $event->event_status = $data['event_status'];
        $event->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->hasFile('event_image')) {
            if ($event->event_image != null) {
                Storage::delete('public/event_image/' . $event->event_image);
            }
            $name = $request->file('event_image')->getClientOriginalName();
            // $name = $request->file('image')->hashName();
            $path = $request->file('event_image')->storeAs('public/event_image', $name);
            $event->event_image = $name;
        }
        $event->save();
        return redirect()->back()->with('status', 'Sửa sự kiện thành công');
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
        $event = Event::find($id);
        $event_details = EventDetail::where('event_id', $id)->get();
        $products = $event->products;
        foreach ($products as $product) {
            $product->event_id = 0;
            $product->event_detail_id = 0;
            $product->save();
        }
        foreach ($event_details as $event_detail) {
            $event_detail->delete();
        }
        if ($event->event_image != null) {
            Storage::delete('public/event_image/' . $event->event_image);
        }
        $event->delete();
        return redirect()->back()->with('status', 'Xóa sự kiện thành công');
    }
}
