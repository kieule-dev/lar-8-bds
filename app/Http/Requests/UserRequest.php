<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private $table            = 'user';
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
        $id   = $this->id;
        $task = $this->task;

        // dd($this->all());
       

        $condAvatar   = '';
        $condUserName = '';
        $condEmail    = '';
        $condPass     = '';
        $condLevel    = '';
        $condStatus   = '';
        $condFullname = '';
        $condPhone    = '';

       
        switch ($task) {
            case 'add':
                $condUserName   = "bail|required|between:5,100|unique:$this->table,username";
                $condEmail      = "bail|required|email|unique:$this->table,email";
                $condFullname   = 'bail|required|min: 5';
                $condPass       = 'bail|required|between:5,100|confirmed';
                $condPhone      = 'bail|required|numeric';
                $condStatus     = 'bail|in:active,inactive';
                $condLevel      = 'bail|in:admin,member';
                $condAvatar     = 'bail|required|image';
                break;
            case 'edit-info':
                $condUserName   = "bail|required|between:5,100|unique:$this->table,username,$id"; 
                $condFullname   = 'bail|required|min: 5';
                $condAvatar     = 'bail|image';
                $condStatus     = 'bail|in:active,inactive';
                $condEmail      = "bail|required|email|unique:$this->table,email,$id";
                $condPhone      = 'bail|required|numeric';
                
                break;
            case 'change-password':
                $condPass = 'bail|required|between:5,100|confirmed';
                break;
            case 'change-level':
                $condLevel = 'bail|in:admin,member';
                break;
            case 'front-end':
            
                return [
                    'username' => ['required', 'string', 'max:255'],
                    'email'    => ['required', 'string', 'email', 'max:255', 'unique:user'],
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                ];

                break;
            default:
                break;
        }
        

        return [
            'username' => $condUserName,
            'email'    => $condEmail,
            'fullname' => $condFullname,
            'status'   => $condStatus,
            'phone'    => $condPhone,
            'password' => $condPass,
            'level'    => $condLevel,
            'avatar'   => $condAvatar
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Name kh??ng ???????c r???ng',
            // 'name.min'      => 'Name :input chi???u d??i ph???i c?? ??t nh???t :min k?? t???',
        ];
    }
    public function attributes()
    {
        return [
            // 'description' => 'Field Description: ',
        ];
    }
}
