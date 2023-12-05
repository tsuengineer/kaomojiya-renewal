<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $userSlug = $this->user()->slug;

        return [
            'slug' => [
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_-]+$/',
                Rule::unique(User::class)->where(function ($query) use ($userSlug) {
                    return $query->where('slug', '!=', $userSlug);
                })
            ],
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            'avatar' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:50000',
            ],
            'profile' => [
                'nullable',
                'nullable',
                'string',
                'max:255'
            ],
            'twitter' => [
                'nullable',
                'string',
                'max:255'
            ],
            'instagram' => [
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }
}
