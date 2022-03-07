@extends('news.main')

@section('content')
<div class="page-banner-Diện tích">
    <div class="container">
        <div class="page-banner-content wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="2000ms">
            <h2>Post</h2>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
              
                <li>Post</li>
            </ul>
        </div>
    </div>
    <div class="page-banner-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="2000ms">
        <img src="{{ asset('images/page-banner.png') }}" alt="image">
    </div>
</div>


<div class="submit-property-area ptb-100">
    <div class="container">
        @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
        <div class="submit-property-form">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Name of the apartment </label>
                            <input value="{{ old('name') }}" type="text" name="name" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Acreage</label>
                            <input value="{{ old('area') }}" type="text" name="area" class="form-control">
                            @error('area')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Price (USD/m<sup>2</sup>)</label>
                            <input value="{{ old('price') }}"  type="text" name="price" class="form-control">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Type of apartment </label>
                            <select name="type">
                                <option value="" {{ old('type') == '' ? 'selected' : '' }}>-- Selected --</option>
                                <option value="house" {{ old('type') == 'house' ? 'selected' : '' }} >House</option>
                                <option value="apartment"{{ old('type') == 'apartment' ? 'selected' : '' }} >Apartment</option>
                            </select>
                            @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Purpose</label>
                            <select name="purpose">
                                <option value="" {{ old('purpose') == '' ? 'selected' : '' }}>-- Selected --</option>
                                <option value="sale" {{ old('purpose') == 'sale' ? 'selected' : '' }}>Sell</option>
                                <option value="rent" {{ old('purpose') == 'rent' ? 'selected' : '' }}>Rent</option>
                            </select>
                            @error('purpose')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Bedroom</label>
                            <select name="bed">
                                <option value=""  {{ old('bed') == '' ? 'selected' : '' }}>-- Selected --</option>
                                <option value="1"  {{ old('bed') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2"  {{ old('bed') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3"  {{ old('bed') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4"  {{ old('bed') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5"  {{ old('bed') == '5' ? 'selected' : '' }}>5</option>
                            </select>
                            @error('bed')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Bathroom</label>
                            <select name="bath">
                                <option value=""{{ old('bath') == '' ? 'selected' : '' }}>-- Selected --</option>
                                <option value="1"{{ old('bath') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2"{{ old('bath') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3"{{ old('bath') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4"{{ old('bath') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5"{{ old('bath') == '5' ? 'selected' : '' }}>5</option>
                            </select>
                            @error('bath')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Representative image  </label>
                            <input type="file" name="image" class="form-control-file">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>The design</label>
                            <input type="file" name="floor_plan" class="form-control-file">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Detailed pictures</label>
                            <input type="file" name="images[]" multiple class="form-control-file">
                            @error('images')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="form-group">
                            <label>Link youtube</label>
                            <input value="{{ old('video') }}"  type="text" name="video" class="form-control">
                            @error('video')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="form-group">
                            <label>Description of the apartment </label>
                            <textarea  id="description" rows="35" name="description" class="form-control">{!! old('description') !!}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h4>Location Information </h4>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>Location </label>
                            <input value="{{ old('address') }}"  type="text" name="address" class="form-control">
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label>City</label>
                            <input value="{{ old('city') }}" type="text" name="city" class="form-control">
                            @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                </div>
                <button type="submit" class="default-btn">Confirm<span></span></button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.tiny.cloud/1/wl0hy3kumawhadevkqc4e81r6m900s5jbcbx30qu575s6ptk/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#description'
    })
</script>
@endpush