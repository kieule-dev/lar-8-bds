<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    private $table            = 'article';

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

        // dd($this);

        $condName = "bail|required|between:5,100|unique:$this->table,name";
        $condThumb= 'bail|required|image';//|max:2000

        if(!empty($id)){
            $condName .= ",$id";
            $condThumb = 'bail|image|max:500';
        }

        return [
            'name'              => $condName,
            'short_description' => 'bail|required|min:5',
            'description'       => 'bail|required|min:5',
            'quote'             => 'bail|required|min:5',
            'status'            => 'bail|in:active,inactive',
            'thumb'             => $condThumb
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
