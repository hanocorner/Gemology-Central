<?php
$config = array(
        'report' => array(
                // Gemstone
                array(
                        'field' => 'gemid',
                        'label' => 'Gemstone',
                        'rules' => 'required|callback_check_default',
                        'errors' => array(
                        'check_default' => 'Please select a gemstone from the list'
                        ),
                ),
                // Report #ID
                array(
                        'field' => 'rmid',
                        'label' => 'ID',
                        'rules' => 'trim|required|alpha_dash'
                ),
                // Object
                array(
                        'field' => 'object',
                        'label' => 'Object',
                        'rules' => 'trim|required'
                ),
                // Variety
                array(
                        'field' => 'variety',
                        'label' => 'Variety',
                        'rules' => 'trim|required'
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
                        'rules' => 'trim'
                ),
                // Gem Width
                array(
                        'field' => 'gemWidth',
                        'label' => 'Width',
                        'rules' => 'trim|decimal'
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
                        'rules' => 'trim|alpha_dash|alpha_numeric_spaces'
                ),
                // Shape & Cut
                array(
                        'field' => 'shapecut',
                        'label' => 'Shape',
                        'rules' => 'trim|alpha_dash|alpha_numeric_spaces'
                ),
                // Comment
                array(
                        'field' => 'comment',
                        'label' => 'Comment',
                        'rules' => 'trim|alpha_dash|alpha_numeric_spaces'
                ),
                // Other
                array(
                        'field' => 'other',
                        'label' => 'Other',
                        'rules' => 'trim|alpha_dash|alpha_numeric_spaces'
                ),
                // Amount
                array(
                        'field' => 'amount',
                        'label' => 'Amount',
                        'rules' => 'trim|alpha_dash|alpha_numeric_spaces'
                ),
        )
);
?>
