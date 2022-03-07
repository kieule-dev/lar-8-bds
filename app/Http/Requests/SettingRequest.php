<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    private $table            = 'slider';
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

        // dd($this->all());
        $id = $this->id;

        $condThumb = 'bail|required|image';
        $condName  = "bail|required|between:5,100|unique:$this->table,name";

        if(!empty($id)){ // edit
            $condThumb = 'bail|image';
            $condName  .= ",$id";
        }
        return [
            // 'name'        => $condName,
            // 'description' => 'bail|required|min:5',
            // 'status'      => 'bail|in:active,inactive',
            // 'link'        => 'bail|required|min:5|url',
            // 'thumb'       => $condThumb
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
