<?php

namespace App\Http\Controllers\News;

use App\Models\Tag;
use App\Models\Message;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyImage;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;



class PropertyController extends Controller
{
    public function index () {
        $properties = Property::where('status', 'active')->orderBy('id', 'DESC')->paginate(9);
        return view('news.pages.property.index',compact('properties'));
    }

    
    public function city($city) {
      
        $properties = Property::where('city_slug',$city)->paginate(9);
      
        return view('news.pages.property.city',compact('properties'));
    }

    public function category($name) {
       
        $category = Property::where('type',strtolower($name))->paginate(9);
       

        return view('news.pages.property.category',compact('category'));
    }
    public function citys() {
        // dd(123);
        $city       = DB::table('properties')
                    ->select(DB::raw('count(*) as total , city_slug, city, image'))
                    ->groupBy('city_slug')
                    ->limit(6)
                    ->get()->toArray();
      
        return view('news.pages.property.citys',compact('city'));
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

        $user_id = $property->user_id;
        $infoUser = DB::table('user')->select('fullname', 'avatar','phone', 'email', 'id')->where('id',$user_id )->first();
       
       
        session(['infoUser' => $infoUser]);
    

       

        // $images   = PropertyImage::where('property_id',$property->id)->get();
       
        $video    = $this->convertYoutube($property->video);
        $tags     = Tag::all();
        $hots     = Property::orderBy('view','DESC')->limit(4)->get();
        $property->increment('view');


        return view('news.pages.property.detail',compact('property','infoUser','video','tags','hots'));
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
       
        $emailObj = session('infoUser')/* ->email */;
        $property = Property::where('id',$request->property_id)->first();
        $slug = $property->slug;
      
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
            'slug' => ''
        ]);

        array_push($data, $slug);

        // dd($data);

        $message              = new Message();
        $message->name        = $request->name;
        $message->phone       = $request->phone;
        $message->message     = $request->message;
        $message->user_id     = $emailObj->id;
        $message->property_id = $request->property_id;
        $message->save();

      
        Mail::to( $emailObj->email)->send(new ContactFormMail($data));
    
        return response()->json();
    }
}
