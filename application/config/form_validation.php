<?php
$config = array(
        'report' => array(
                // Gemstone
                array(
                        'field' => 'gemid',
                        'label' => 'Gemstone',
                        'rules' => 'trim|required',
                        'errors' => array('required' => 'Variety Field is empty'),
                ),
                // Report Type
                array(
                        'field' => 'radio-1',
                        'label' => 'Report Type',
                        'rules' => 'required'
                ),
                // Report #ID
                array(
                        'field' => 'rmid',
                        'label' => 'ID',
                        'rules' => 'trim|alpha_dash'
                ),
                // Object
                array(
                        'field' => 'object',
                        'label' => 'Object',
                        'rules' => 'trim|callback_check_default',
                        'errors' => array('check_default' => 'Please select an option for object field'),
                ),
                // Weight
                array(
                        'field' => 'weight',
                        'label' => 'Weight',
                        'rules' => 'trim|required|decimal'
                ),
                // Species & Group (spgroup)
                array(
                        'field' => 'spgroup',
                        'label' => 'Species/Group',
                        'rules' => 'trim|required|callback_special_chars',
                        'errors' => array(
                          'required' => '%s field is empty',
                          'special_chars'=>'Invalid characters in %s field'
                        ),
                ),
                // Gem Width
                array(
                        'field' => 'gemWidth',
                        'label' => 'Width',
                        'rules' => 'trim'
                ),
                // Gem Height
                array(
                        'field' => 'gemHeight',
                        'label' => 'Height',
                        'rules' => 'trim|decimal'
                ),
                // Gem Length
                array(
                        'field' => 'gemLength',
                        'label' => 'Length',
                        'rules' => 'trim|decimal'
                ),
                // Color
                array(
                        'field' => 'color',
                        'label' => 'Color',
                        'rules' => 'trim|callback_special_chars',
                        'errors' => array('special_chars' => 'Invalid characters in %s field'),
                ),
                // Shape & Cut
                array(
                        'field' => 'shapecut',
                        'label' => 'Shape & Cut',
                        'rules' => 'trim|callback_special_chars',
                        'errors' => array('special_chars' => 'Invalid characters in %s field'),
                ),
                // Comment
                array(
                        'field' => 'comment',
                        'label' => 'Comment',
                        'rules' => 'trim|callback_special_chars',
                        'errors' => array('special_chars' => 'Invalid characters in %s field'),
                ),
                // Other
                array(
                        'field' => 'other',
                        'label' => 'Other',
                        'rules' => 'trim|callback_special_chars',
                        'errors' => array('special_chars' => 'Invalid characters in %s field'),
                ),
                // Amount
                array(
                        'field' => 'amount',
                        'label' => 'Amount',
                        'rules' => 'trim|required|decimal'
                ),
        ),
        'gemstone' => array(
                array(
                        'field'=> 'gemName',
                        'label' => 'Gemstone Name',
                        'rules' => 'trim|required|alpha_numeric_spaces'
                ),
                array(
                        'field'=> 'gemDesc',
                        'label' => 'Gemstone Description',
                        'rules' => 'trim|required|callback_special_chars',
                        'errors' => array('special_chars' => 'Invalid characters in %s field'),
                ),
        )
);
?>
