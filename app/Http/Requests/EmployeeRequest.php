<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->getMethod();
        $actionName = $this->route()->getActionMethod();

        if($method === 'POST'){
            if($actionName == 'store'){
                return [
                    'first_name' => "required|string",
                    'last_name' => "required|string",
                    'salary' => "required",
                    'image' => "sometimes|nullable|image",
                    'manager_name' => "sometimes|nullable",
                    'department_id' => "sometimes|nullable|exists:departments,id",
                ];
            } // end of actionName check

        } // end of method check


        if($method === 'PUT'){
            if($actionName == 'update'){
                return [
                    'first_name' => "required|string",
                    'last_name' => "required|string",
                    'salary' => "required",
                    'image' => "sometimes|nullable|image",
                    'manager_name' => "sometimes|nullable",
                    'department_id' => "sometimes|nullable|exists:departments,id",
                ];
            } // end of actionName check

        } // end of method check
    }
}
