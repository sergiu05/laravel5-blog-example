<?php

namespace Unicorn\Http\Requests;

use Unicorn\Http\Requests\Request;

class AlbumCreateRequest extends Request
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
    	
    	if ($this->isMethod('put')) {

    		return [
	            'title' => 'required|max:255',
	            'price' => 'required|numeric',	            
	            'description' => 'required',
	            'artist' => 'required|exists:artists,id',
	            'genre' => 'required|exists:genres,id',
	            'id' => 'required|exists:albums,id'
        	];

    	}

        return [
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png,bmp',
            'description' => 'required',
            'artist' => 'required|exists:artists,id',
            'genre' => 'required|exists:genres,id'
        ];

    }

    public function messages() {

    	return [
    		'artist.required' => 'Choose the artist of this album.',
    		'artist.exists' => 'This artist does not exists. Pls define him/her first.',
    		'genre.required' => 'Pls specify the gender of this album.',
    		'genre.exists' => 'This genre does not exists. Pls create it first and the use it.'
    	];
    }
}
