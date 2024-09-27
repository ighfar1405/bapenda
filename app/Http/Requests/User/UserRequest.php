<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
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
        // $ignoreUsername = request()->username ?? null;
        // $ignoreEmail = request()->email ?? null;
        $ignoreUsername = '';
        $ignoreEmail    = '';
        $id             = request()->segment(4);

        $user = \App\Entity\User\User::find($id);
        if ($user) {
            $ignoreUsername = 'unique:users,username,'.$user->id;
            $ignoreEmail    = 'unique:users,email,'.$user->id;
        }

        return [
            'nama' => 'required|string|max:255',
            'username' => [ 'required', 'max:20', $ignoreUsername ],
            'email'    => [ 'required', 'email','max:255', $ignoreEmail],
            'password' => 'nullable|string|min:8|max:255|confirmed',
            'hak_akses' => 'required|in:1,2'
        ];
    }
}
