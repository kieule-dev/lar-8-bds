<?php

namespace App\Http\Controllers\News;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Slider;
use App\Models\Message;
use App\Models\Property;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyImage;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    //======== INDEX =========
    public function index()
    {
        $properties = Property::where('status','active')->paginate(6);
        $city       = Property::select('city','image','city_slug')->get()->groupBy('city_slug')->toArray();
         
        // dd($city);
      
        $posts      = Post::paginate(6);
        $type       = Property::select('type')->distinct('type')->get();
        $slider     = Slider::select('thumb', 'name')->where('status','active')->get();
      
        
        return view('news.pages.home.index',compact('properties','city','posts','type', 'slider'));
    }


    public function dashboard () {
        $messages = Message::where('user_id',Auth::user()->id)->paginate(5);
        $properties = Property::where('user_id',Auth::user()->id)->paginate(5);
        return view('user.index',compact('messages','properties'));
    }

    public function property (Request $request) {

        $value = $request->session()->get('userInfo');

       
        if ($value != null)
            return view('news.pages.user.property');
        return redirect()->route('auth/login');
    }

    public function profile () {
        return view('user.profile');
    }

    public function removeImage($file){
        $path = public_path('upload/property/'.$file->image);
        if(isset($path))
            unlink($path);
    }

    public function removeProfilePath($file){
        $path = public_path('upload/property/'.$file->profile_path);
        if(isset($path))
            unlink($path);
    }

    public function update (Request $request) {
        // dd($request->all());
        $request->validate([
            'profile_path' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required',
            'address' => 'required',
        ],[
            'profile_path.image' => 'Nhập đúng định dạng của ảnh',
            'profile_path.mimes' => 'Nhập đúng định dạng của ảnh',
            'profile_path.max' => 'Kích thước hình ảnh quá lớn',
            'name.required' => 'Tên của bạn không được trống',
            'email.required' => 'Email của bạn không được trống',
            'email.email' => 'Nhập đúng định dạng của email',
            'address.required' => 'Địa chỉ của bạn không được trống',
            'phone.required' => 'Điện thoại của bạn không được trống',
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->facebook = $request->facebook;

        if ($request->hasFile('profile_path')) {
            if ($user->profile_path != 'no-image.png')
                $this->removeProfilePath($user);
            $imageName = $request->name.'-'.Carbon::now()->timestamp.'.'.$request->profile_path->extension(); 
            $request->profile_path->storeAs('user',$imageName);
            $user->profile_path = $imageName;
        }

        $user->save();
        session()->flash('message','Cập nhật thông tin của bạn thành công !');
        return back();
    }

    public function change (Request $request) {
        $request->validate([
            'pwd' => ['required', new MatchOldPassword],
            'new_pwd' => 'required|min:8',
            'confirm_pwd' => 'same:new_pwd',
        ],[
            'pwd.required' => 'Mật khẩu hiện tại không được trống !',
            'new_pwd.required' => 'Mật khẩu mới không được trống !',
            'new_pwd.min' => 'Mật khẩu mới ít nhất 8 ký tự !',
            'confirm_pwd.same' => 'Mật khẩu phải giống nhau!',
        ]);
        User::find(Auth::user()->id)->update(['password' => Hash::make($request->new_pwd)]);
        session()->flash('message','Mật khẩu của bạn đã được thay đổi !');
        return back();
    }

    public function changepwd () {
        return view('user.change-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'purpose' => 'required',
            'description' => 'required',
            'bath' => 'required',
            'bed' => 'required',
            'area' => 'required',
            'price' => 'required',
            'city' => 'required',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,svg,gif|max:2048', 
            'floor_plan' => 'image|mimes:jpeg,jpg,png,svg,gif|max:2048', 
        ],[
            'name.required' => 'Tên căn hộ không được trống',
            'type.required' => 'Loại căn hộ không được trống',
            'purpose.required' => 'Mục đích không được trống',
            'description.required' => 'Mô tả không được trống',
            'bath.required' => 'Số phòng tắm không được trống',
            'bed.required' => 'Số phòng ngủ không được trống',
            'area.required' => 'Diện tích không được trống',
            'price.required' => 'Giá căn hộ không được trống',
            'city.required' => 'Thành phố không được trống',
            'address.required' => 'Địa điểm không được trống',
            'image.required' => 'Hình ảnh địa diện không được trống',
            'image.image' => 'Nhập đúng định dạng hình ảnh',
            'image.mimes' => 'Nhập đúng loại hình ảnh',
            'image.max' => 'Kích thước quá lớn',
            'floor_plan.image' => 'Nhập đúng định dạng hình ảnh',
            'floor_plan.mimes' => 'Nhập đúng loại hình ảnh',
            'floor_plan.max' => 'Kích thước quá lớn',
        ]);
        $property = new Property();
        $property->name = $request->name;
        $property->slug = Str::slug($request->name).'-'.Carbon::now()->timestamp;
        if ($request->type == "house")
            $property->type = "Căn hộ";
        else 
            $property->type = "Chung cư";
        $property->type_slug = Str::slug($property->type);
        if ($request->purpose == "sale") 
            $property->purpose = "Bán";
        else
            $property->purpose = "Cho thuê";
        $property->description = $request->description;
        $property->bed = $request->bed;
        $property->bath = $request->bath;
        $property->area = $request->area;
        $property->price = $request->price;
        $property->city = $request->city;
        $property->city_slug = Str::slug($request->city);
        $property->address = $request->address;
        $property->video = $request->video;
        $property->user_id = Auth::user()->id;

        if ($request->hasFile('image')) {
            $imageName = $property->slug.'.'.$request->image->extension();
            $request->image->storeAs('property',$imageName);
            $property->image = $imageName;
        }
        else 
            $property->image = "no-image.jpg";

        if ($request->hasFile('floor_plan')) {
            $floor_plan = 'ban-thiet-ke'.'-'.Carbon::now()->timestamp.'.'.$request->floor_plan->extension();
            $request->floor_plan->storeAs('property',$floor_plan);
            $property->floor_plan = $floor_plan;
        }

        $property->save();
        
        if ($request->hasFile('images')) {
            foreach ($request->images as $item) {
                $img = new PropertyImage();
                $img->property_id = $property->id;
                $name = Str::random(8).'-'.$item->extension();
                $item->storeAs('property',$name);
                $img->image = $name;
                $img->save();
            }
        }
        session()->flash('message','Thêm căn hộ thành công!');
        return back();
    }

    public function removeFloorPlan($file){
        $path = public_path('upload/property/'.$file->floor_plan);
        if(isset($path))
            unlink($path);
    }

    public function destroy($id) {
        $property = Property::find($id);
        $this->removeImage($property);
        $this->removeFloorPlan($property);

        foreach (PropertyImage::where('property_id',$property->id)->get() as $item) {
            $this->removeImage($item);
        }

        $property->delete();
        session()->flash('message','Xóa căn hộ thành công !');
        return back();
    }
}
