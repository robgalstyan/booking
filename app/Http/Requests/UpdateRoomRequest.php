<?php

namespace App\Http\Requests;

use App\Http\Services\RoomService;
use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->hasRole('admin')){
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'price' => ['required', 'integer'],
            'number' => ['required', 'integer', 'unique:rooms,number,'.$this->route('id')]
        ];
    }
}
