<?php

namespace App\Http\Controllers\News;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User1;
use App\Models\Slider;
use App\Models\Message;
use App\Models\Property;
use App\Models\Companies;
use App\Models\Facilities;
use App\Models\Category;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyImage;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


use App\Models\UserModel as MainModel;
use App\Models\PropertyModel;
use App\Http\Requests\UserRequest as MainRequest;

class HomeController extends Controller
{
    private $params    = [];
  


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function __construct()
    {
        $this->model = new MainModel();
    }

    public function uploadThumbs($thumbObj)
    {
        $arrName = [];
        foreach ($thumbObj as $key => $value) {
            $thumbName       = Str::random(10) . '.' . $value->clientExtension();
            $value->storeAs('property', $thumbName, 'zvn_storage_image');
            array_push($arrName, $thumbName);
        }

        return $arrName;
    }
    public function uploadThumb($thumbObj)
    {
        $thumbName        = Str::random(10) . '.' . $thumbObj->clientExtension();
        $thumbObj->storeAs('user', $thumbName, 'zvn_storage_image');
        return $thumbName;
    }
    public function deleteThumb($thumbName){
        Storage::disk('zvn_storage_image')->delete( 'user/' . $thumbName);
    }

    //======== INDEX =========
    public function index()
    {
        $properties = Property::where('status', 'active')->orderBy('id', 'DESC')->paginate(6);
        $companies  = Companies::where('status', 'active')->paginate(10);
        $facilities = Facilities::where('status', 'active')->paginate(6);
        $city       = DB::table('properties')
                        ->select(DB::raw('count(*) as total , city_slug, city, image'))
                        ->groupBy('city_slug')
                        ->limit(6)
                        ->get()->toArray();
                  
        $posts      = Post::paginate(4);
        $category   = Category::paginate(8);
     
        $type       = Property::select('type')->distinct('type')->get();
        $slider     = Slider::select('thumb', 'name')->where('status', 'active')->get();

        return view('news.pages.home.index', compact('properties', 'category', 'companies', 'facilities', 'city', 'posts', 'type', 'slider'));
    }



    public function search(Request $request)
    {
        $this->params['keyword']['field'] = 'keyword';                       //$request->input('keyword', '');  // all id description
        $this->params['keyword']['value'] = $request->input('keyword', '');
        $this->params['city']['field']    = 'city';                          //$request->input('city', '');
        $this->params['city']['value']    = $request->input('city', '');
        $this->params['type']['field']    = 'type';                          //$request->input('type', '');
        $this->params['type']['value']    = $request->input('type', '');
        $this->params['purpose']['field'] = 'purpose';                       //$request->input('type', '');
        $this->params['purpose']['value'] = $request->input('purpose', '');



        $propertyObj =  new PropertyModel();

        $items              =  $propertyObj->listItems($this->params, ['task'  => 'news-list-items-search']);
        // dd($items);

        return view('news.pages.search.index', compact('items'));
    }


    public function dashboard()
    {
        $messages = Message::where('user_id', Auth::user()->id)->paginate(5);
        $properties = Property::where('user_id', Auth::user()->id)->paginate(5);
        return view('user.index', compact('messages', 'properties'));
    }

    public function property(Request $request)
    {

        $value = $request->session()->get('userInfo');

        if ($value != null)
            return view('news.pages.user.property');
        return redirect()->route('auth/login');
    }

    public function profile()
    {
        return view('news.pages.user.profile');
    }

    public function removeImage($file)
    {
        $path = public_path('upload/property/' . $file->image);
        if (isset($path))
            unlink($path);
    }

    public function removeProfilePath($file)
    {
        $path = public_path('upload/property/' . $file->profile_path);
        if (isset($path))
            unlink($path);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'profile_path' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'name'         => 'required',
            'email'        => 'email|required',
            'phone'        => 'required',
            'address'      => 'required',
        ]);
        $user               = User1::find($request->id);

        $params['fullname'] = $request->name;
        $params['email']    = $request->email;
        $params['phone']    = $request->phone;
        $params['address']  = $request->address;
        $params['facebook'] = $request->facebook;
        $params['level']    = $user->level;
        $params['id']       = $user->id;
        $params['avatar']   = $user->avatar;
        $params['username'] = $user->username;

        // dd($request->all());

        if ($request->hasFile('profile_path')) {
            if ($user->avatar_current != 'no-image.png') {
                $this->deleteThumb($request['avatar_current']);
            }
            $params['avatar'] = $this->uploadThumb($request['profile_path']);
          
          
        }
        $params['modified_by']   = "kerry";
        $params['modified']      = date(config('zvn.format.db'));
       
        DB::table('user')->where('id', $request->id)->update(($params));
        $request->session()->put('userInfo', $params);
        session()->flash('message', 'Update your information successfully!');
        return back();
    }

    public function change(Request $request)
    {
        $request->validate([
            'pwd' => ['required', new MatchOldPassword],
            'new_pwd' => 'required|min:8',
            'confirm_pwd' => 'same:new_pwd',
        ], [
            'pwd.required' => 'M???t kh???u hi???n t???i kh??ng ???????c tr???ng !',
            'new_pwd.required' => 'M???t kh???u m???i kh??ng ???????c tr???ng !',
            'new_pwd.min' => 'M???t kh???u m???i ??t nh???t 8 k?? t??? !',
            'confirm_pwd.same' => 'M???t kh???u ph???i gi???ng nhau!',
        ]);
        User1::find(Auth::user()->id)->update(['password' => Hash::make($request->new_pwd)]);
        session()->flash('message', 'M???t kh???u c???a b???n ???? ???????c thay ?????i !');
        return back();
    }

    public function changepwd()
    {
        return view('user.change-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'type'        => 'required',
            'purpose'     => 'required',
            'description' => 'required',
            'bath'        => 'required',
            'bed'         => 'required',
            'area'        => 'required',
            'price'       => 'required',
            'city'        => 'required',
            'address'     => 'required',
            'image'       => 'required|image|mimes:jpeg,jpg,png,svg,gif|max:2048',
            'floor_plan'  => 'image|mimes:jpeg,jpg,png,svg,gif|max:2048',
        ], [
            'name.required'        => 'T??n c??n h??? kh??ng ???????c tr???ng',
            'type.required'        => 'Lo???i c??n h??? kh??ng ???????c tr???ng',
            'purpose.required'     => 'M???c ????ch kh??ng ???????c tr???ng',
            'description.required' => 'M?? t??? kh??ng ???????c tr???ng',
            'bath.required'        => 'S??? ph??ng t???m kh??ng ???????c tr???ng',
            'bed.required'         => 'S??? ph??ng ng??? kh??ng ???????c tr???ng',
            'area.required'        => 'Di???n t??ch kh??ng ???????c tr???ng',
            'price.required'       => 'Gi?? c??n h??? kh??ng ???????c tr???ng',
            'city.required'        => 'Th??nh ph??? kh??ng ???????c tr???ng',
            'address.required'     => '?????a ??i???m kh??ng ???????c tr???ng',
            'image.required'       => 'H??nh ???nh ?????a di???n kh??ng ???????c tr???ng',
            'image.image'          => 'Nh???p ????ng ?????nh d???ng h??nh ???nh',
            'image.mimes'          => 'Nh???p ????ng lo???i h??nh ???nh',
            'image.max'            => 'K??ch th?????c qu?? l???n',
            'floor_plan.image'     => 'Nh???p ????ng ?????nh d???ng h??nh ???nh',
            'floor_plan.mimes'     => 'Nh???p ????ng lo???i h??nh ???nh',
            'floor_plan.max'       => 'K??ch th?????c qu?? l???n',
        ]);
        $property = new Property();
        $property->name = $request->name;
        $property->slug = Str::slug($request->name) . '-' . Carbon::now()->timestamp;
        $property->type = $request->type;
        $property->type_slug = Str::slug($property->type);
        $property->purpose = $request->purpose;
        $property->description = $request->description;
        $property->bed = $request->bed;
        $property->bath = $request->bath;
        $property->area = $request->area;
        $property->price = $request->price;
        $property->city = $request->city;
        $property->city_slug = Str::slug($request->city);
        $property->address = $request->address;
        $property->video = $request->video;
        $property->user_id = session('userInfo')['id'];

        if ($request->hasFile('image')) {
            $image = $this->uploadThumb($request->image);
            $property->image = $image;
        } else
            $property->image = "no-image.jpg";

        if ($request->hasFile('floor_plan')) {
            $design = $this->uploadThumb($request->floor_plan);
            $property->design = $design;
        }
        if ($request->hasFile('images')) {
            $property->album     = json_encode(array_values($this->uploadThumbs($request->images)));
        }

        $property->save();

        session()->flash('message', 'Th??m c??n h??? th??nh c??ng!');
        return back();
    }

    public function removeFloorPlan($file)
    {
        $path = public_path('upload/property/' . $file->floor_plan);
        if (isset($path))
            unlink($path);
    }

    public function destroy($id)
    {
        $property = Property::find($id);
        $this->removeImage($property);
        $this->removeFloorPlan($property);

        foreach (PropertyImage::where('property_id', $property->id)->get() as $item) {
            $this->removeImage($item);
        }

        $property->delete();
        session()->flash('message', 'X??a c??n h??? th??nh c??ng !');
        return back();
    }

    public function save(MainRequest $request)
    {

        if ($request->method() == 'POST') {

            $params = $request->all();
            $task   = "add-item";
            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route('auth/login')->with("zvn_notify", 'You have successfully registered. Please login');
        }
    }
}
