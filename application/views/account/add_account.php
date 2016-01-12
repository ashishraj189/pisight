<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //$attributes = array('class' => 'email', 'id' => 'myform');
        echo form_open();
        $options = array(
            'Credit' => 'Credit',
            'med' => 'Medium Shirt',
            'large' => 'Large Shirt',
            'xlarge' => 'Extra Large Shirt',
        );

        
        echo form_dropdown('type_of_account', $options, 'large');

        echo form_close();
        ?>

    </body>
</html>
