<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
                    'task_name' => "required|string",
                    'description' => "required|string",
                    'status' => "sometimes|nullable|in:pending,in_progress,completed",
                    'employee_ids.*' => "sometimes|nullable|exists:employees,id",
                ];
            } // end of actionName check

        } // end of method check


        if($method === 'PUT'){
            if($actionName == 'update'){
                return [
                    'task_name' => "required|string",
                    'description' => "required|string",
                    'status' => "sometimes|nullable|in:pending,in_progress,completed",
                    'employee_ids.*' => "sometimes|nullable|exists:employees,id",
                ];
            } // end of actionName check

        } // end of method check
    }
}
