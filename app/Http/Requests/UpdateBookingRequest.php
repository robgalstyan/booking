<?php

namespace App\Http\Requests;

use App\Models\Booking;
use App\Models\Room;
use App\Rules\BookingRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->can('manage', [Booking::class, $this->route('id')])){
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
            'book_start' => [
                'required',
                'date_format:Y-m-d',
                'after:' . date('d-m-Y', strtotime('-1 day')),
            ],
            'book_end' => [
                'required',
                'date_format:Y-m-d',
                'after:' . Carbon::parse($this->book_start)->subDay()
            ],
        ];
    }
}
