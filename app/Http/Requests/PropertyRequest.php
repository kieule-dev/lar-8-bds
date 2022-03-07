<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
{
    private $table            = 'properties';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    
        $id = $this->id;
        $condThumb = 'bail|required|image';
        $condName  = "bail|required|between:1,100|unique:$this->table,name";

        if(!empty($id)){ // edit
            $condThumb = 'bail|image';
            $condName  .= ",$id";
        }
        return [
            'name'        => $condName,
            'category'    => 'bail|notIn:0',
            'description' => 'bail|required|min:1',
            'purpose'     => 'bail|in:sell,lease',
            'bed'         => 'bail|required|min:1',
            'bath'        => 'bail|required|min:1',
            'area'        => 'bail|required|min:1|max:10',
            'price'       => 'bail|required|min:1',
            'city'        => 'bail|required|notIn:default',
            'video'       => 'bail|required|min:5|url',
            'address'     => 'bail|required|min:1',
            'status'      => 'bail|in:active,inactive',
            'image'       => $condThumb,
            'design'      => $condThumb,
            // 'album'       => $condThumb,
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Name không được rỗng',
            // 'name.min'      => 'Name :input chiều dài phải có ít nhất :min ký tứ',
        ];
    }
    public function attributes()
    {
        return [
            // 'description' => 'Field Description: ',
        ];
    }
}
