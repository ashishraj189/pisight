<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
if(isset($msg) && !empty($msg))
{
    echo "<h1>".$msg."</h1>";
}
else
{  
  echo '<h1>Thanks For Registration. Please verify your email id to complete registration process.</h1>';
}
?>

