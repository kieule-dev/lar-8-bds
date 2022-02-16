<?php

namespace App\Http\Controllers\News;

use App\Models\Tag;
use App\Models\Message;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyImage;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function index () {
        $properties = Property::where('status', 'active')->paginate(9);
        return view('news.pages.property.index',compact('properties'));
    }

    public function city($slug) {
        $properties = Property::where('city_slug',$slug)->paginate(9);
        return view('property',compact('properties'));
    }

    // YOUTUBE LINK TO EMBED CODE
    private function convertYoutube($youtubelink, $w = 800, $h = 410) {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"$w\" height=\"$h\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allowfullscreen></iframe>",
            $youtubelink
        );
    }

    public function detail ($slug) {
        $property = Property::where('slug',$slug)->first();
        // $images   = PropertyImage::where('property_id',$property->id)->get();
       
        $video    = $this->convertYoutube($property->video);
        $tags     = Tag::all();
        $hots     = Property::orderBy('view','DESC')->limit(5)->get();
        $property->increment('view');


        return view('news.pages.property.detail',compact('property','video','tags','hots'));
    }

    public function search () {
        $properties = Property::where('name','LIKE','%'.request()->keyword.'%')
                ->when(request()->city,function($query) {
                    $query->where('city_slug',request()->city);
                })
                ->when(request()->type,function($query) {
                    $query->where('type',request()->type);
                })
                ->paginate(9);

        return view('property',compact('properties'));
    }

    public function message (Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);
        $message = new Message();
        $message->name = $request->name;
        $message->phone = $request->phone;
        $message->message = $request->message;
        $message->user_id = $request->user_id;
        $message->property_id = $request->property_id;
        $message->save();

        return response()->json();
    }
}
