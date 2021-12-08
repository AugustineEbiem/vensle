<?php
$output = "<p>Hi,</p>";
$output.= "<p>Please click on the following link to reset your password.</p>";
$output.= "<p>-------------------------------------------------------------</p>";
$output.= "<p><a href='https://vensle.com/recovery/password_reset.php?key={$key}&email={$email}&action=reset' target='_blank'>Click here to reset password</a></p>";    
$output.= "<p>-------------------------------------------------------------</p>";
$output.= "<p>This link will expire after 12 hours for security reason.</p>";
$output.= "<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your password as someone may have guessed it.</p>";    
$output.= "<p>Thanks,</p>";
$output.= "<p>Vensle Support Team</p>";
return $output;