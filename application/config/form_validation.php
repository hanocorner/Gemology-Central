<?php
$config = array(
        'report' => array(
                // Gemstone
                array(
                        'field' => 'gemid',
                        'label' => 'Variety',
                        'rules' => 'trim|required',
                        'errors' => array('required' => '%s field is empty'),
                ),
                // Report Type
                array(
                        'field' => 'repotype',
                        'label' => 'Report Type',
                        'rules' => 'required'
                ),
                // Report #ID
                array(
                        'field' => 'reportid',
                        'label' => 'ID',
                        'rules' => 'trim'
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
                        'rules' => 'trim|required',
                        'errors' => array('required' => '%s field is empty'),
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
                        'rules' => 'trim'
                ),
                // Shape & Cut
                array(
                        'field' => 'shapecut',
                        'label' => 'Shape & Cut',
                        'rules' => 'trim'
                ),
                // Comment
                array(
                        'field' => 'comment',
                        'label' => 'Comment',
                        'rules' => 'trim'
                ),
                // Other
                array(
                        'field' => 'other',
                        'label' => 'Other',
                        'rules' => 'trim'
                ),
                // Amount
                array(
                        'field' => 'amount',
                        'label' => 'Amount',
                        'rules' => 'trim|required'
                ),
        ),
        'gemstone' => array(
                array(
                        'field'=> 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|min_length[3]|max_length[30]'
                ),
                array(
                        'field'=> 'description',
                        'label' => 'Description',
                        'rules' => 'trim|min_length[3]|max_length[50]'
                ),
        ),
        'admin_auth' => array(
                array(
                        'field'=> 'username',
                        'label' => 'Username',
                        'rules' => 'trim|required|alpha_numeric_spaces'
                ),
                array(
                        'field'=> 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required|alpha'
                ),
        ),
        'draft' => array(
                // Color
                array(
                        'field' => 'color',
                        'label' => 'Color',
                        'rules' => 'trim|min_length[3]|max_length[30]'
                ),
                // Shape & Cut
                array(
                        'field' => 'shapecut',
                        'label' => 'Shape & Cut',
                        'rules' => 'trim|min_length[3]|max_length[30]'
                ),
                // Weight
                array(
                        'field' => 'weight',
                        'label' => 'Weight',
                        'rules' => 'trim|decimal'
                ),
                // Report Type
                array(
                        'field' => 'repotype',
                        'label' => 'Report Type',
                        'rules' => 'required'
                ),
                // Report Type
                array(
                        'field' => 'cstid',
                        'label' => 'Customer',
                        'rules' => 'required'
                )
        )
);
?>
