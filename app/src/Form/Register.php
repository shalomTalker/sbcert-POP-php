<?php
namespace Tutorial\Form;
use Pop\Form\Form;
use Tutorial\Model;
class Register extends Form
{
    public function __construct(array $fields = NULL, $action = NULL, $method = 'post')
    {
        parent::__construct($fields, $action, $method);
        $fieldConfig = [
            'first_name' => [
                'type' => 'text',
                'label' => 'First Name',
                'required' => TRUE,
                'attributes' => [
                    'class' => 'form-control'
                ],
            ],
            'last_name' => [
                'type' => 'text',
                'label' => 'Last Name',
                'required' => TRUE,
                'attributes' => [
                    'class' => 'form-control'
                ],
            ],
            'password' => [
                'type' => 'password',
                'label' => 'Password',
                'required' => TRUE,
                'attributes' => [
                    'class' => 'form-control'
                ],
            ],
            'submit' => [
                'type' => 'submit',
                'value' => 'Submit',
            ],
        ];
        $this->addFieldsFromConfig($fieldConfig);
    }
    public function generateDynamicText($type = 0)
    {
                $titleNode = '<h3>' . 'Client type: ' . $type . '</h3>';
                $this->addNodeValue($titleNode);
        
    }
}