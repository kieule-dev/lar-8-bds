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
            'pwd.required' => 'Mật khẩu hiện tại không được trống !',
            'new_pwd.required' => 'Mật khẩu mới không được trống !',
            'new_pwd.min' => 'Mật khẩu mới ít nhất 8 ký tự !',
            'confirm_pwd.same' => 'Mật khẩu phải giống nhau!',
        ]);
        User1::find(Auth::user()->id)->update(['password' => Hash::make($request->new_pwd)]);
        session()->flash('message', 'Mật khẩu của bạn đã được thay đổi !');
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
            'name.required'        => 'Tên căn hộ không được trống',
            'type.required'        => 'Loại căn hộ không được trống',
            'purpose.required'     => 'Mục đích không được trống',
            'description.required' => 'Mô tả không được trống',
            'bath.required'        => 'Số phòng tắm không được trống',
            'bed.required'         => 'Số phòng ngủ không được trống',
            'area.required'        => 'Diện tích không được trống',
            'price.required'       => 'Giá căn hộ không được trống',
            'city.required'        => 'Thành phố không được trống',
            'address.required'     => 'Địa điểm không được trống',
            'image.required'       => 'Hình ảnh địa diện không được trống',
            'image.image'          => 'Nhập đúng định dạng hình ảnh',
            'image.mimes'          => 'Nhập đúng loại hình ảnh',
            'image.max'            => 'Kích thước quá lớn',
            'floor_plan.image'     => 'Nhập đúng định dạng hình ảnh',
            'floor_plan.mimes'     => 'Nhập đúng loại hình ảnh',
            'floor_plan.max'       => 'Kích thước quá lớn',
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

        session()->flash('message', 'Thêm căn hộ thành công!');
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
        session()->flash('message', 'Xóa căn hộ thành công !');
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
