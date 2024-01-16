<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class MyValidationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'product_code' => 'required',
            'model_name' => 'required',
            'storage' => 'required',
            'battery_percenatge' => 'required',
            'working_properly' => 'required',
            'original_screen' => 'required',
            'phone_unopened' => 'required',
            'battery_original' => 'required',
            'mobile_condition' => 'required',
            'mdms_registered' => 'required',
            'device_defect' => 'required',
            'front_part'=> 'required',
            'back_part'=> 'required',
            'with_battery_percentage'=> 'required',
            'defect_description',
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'province' => 'required',
            'city' => 'required',
            'agreed' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'model_name.required' => 'Enter your Mobile Model Name.',
            'storage.required'=> 'Enter your Mobile storage.',
            'battery_percenatge.required' => 'Enter your Battery Percenatge.',
            'working_properly.required' => 'Please Choose option.',
            'original_screen.required' => 'Please Choose option.',
            'phone_unopened.required' => 'Please Choose option.',
            'battery_original.required'=>'Please Choose option.',
            'mobile_condition.required' => 'Please Choose option.',
            'mdms_registered.required' => 'Please Choose option.',
            'device_defect.required' => 'Please Choose option.',
            'name.required' => 'Please Enter name .',
            'phone.required' => 'please enter a phone.',
            'phone.numeric' => 'please enter a valid phone number.',
            'phone.digits' => 'The phone must be exactly 10 digits.',
            'province.required' => 'please choose a province',
            'city.required' => 'please enter a city.',
            'agreed.required' => 'You must agree to the terms.',
            'front_part'=> 'Please insert Front Part Image',
            'back_part'=> 'Please insert Back Part Image',
            'with_battery_percentage'=> 'Please insert Image with Battery Percentage',

        ];
    }
}
