<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditTask extends CreateTask
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $status_labels= array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        $status_labels = implode( '、', $status_labels);

        return $messages + [
            'status.in' => ':attributeには' . $status_labels. 'いずれかを指定してください。',
        ];
    }
}
