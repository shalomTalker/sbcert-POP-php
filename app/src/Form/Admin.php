<?php

namespace Tutorial\Form;

use Pop\Form\Form;
use Pop\Validator\LengthLte;

class Admin extends Form
{
    
    public function __construct(array $fields = null, $action = null, $method = 'post')
    {
        parent::__construct($fields, $action, $method);


        $fieldConfig = [
            'type' => [
                'type'   => 'select',
                'label'  => 'Type',
                'values' => [
                    'type 1'    => 'Type 1',
                    'type 2'    => 'Type 2',
                    'type 3'    => 'Type 3'
                ],
                'selected' => 'type 1',
                'attributes' => [
                    'class' => 'form-control'
                ],
            ],
            'email' => [
                'type'       => 'email',
                'label'      => 'Email-Address (Required)',
                'required'   => true,
                'attributes' => [
                    'class' => 'form-control'
                ],
            ],
            'submit' => [
                'type'  => 'submit',
                'value' => 'Submit'
            ]
        ];
        $this->addFieldsFromConfig($fieldConfig);
    }

}