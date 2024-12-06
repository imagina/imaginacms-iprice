<?php

namespace Modules\Iprice\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateTariffRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'system_name' => 'required|min:2',
          'type_id' => 'required',
          'operation_id' => 'required'
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }

    public function getValidator(){
        return $this->getValidatorInstance();
    }
    
}
