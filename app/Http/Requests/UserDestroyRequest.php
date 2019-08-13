<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !($this->route('user') == config('cms.default_user_id') || //khong dc xoa user co id=1
                    $this->route('user') == auth()->user()->id ); //khong dc xoa chinh minh
    }

    public function forbiddenResponse()
    {
        return redirect()->back()->with('error-message', 'You can not delete default user or delete yourself');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
