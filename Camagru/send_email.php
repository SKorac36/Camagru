<?php
   // include 'include.php';
    
    function send_verify_email($email, $username, $hash)
    {
        
        $to = $email;
        $subject =  "Registration";
        $header = "From: team@camagru.co.za";
        $token = substr($hash, 0, 5);
        $txt = "Dear $username

        Thanks for registering, follow this link to verify your email.
        Once you have done that you will be able to share images with your
        Squad, Yass, that is lit.
        http://localhost:8080/Camagru/verify_email.php?username=$username&token=$token&verify=true&reset=false
        ";
        mail($to, $subject, $txt, $header);
    }
    function reset_password_email($email, $username)
    {
        $to = $email;
        $subject = "Password reset";
        $header = "From: team@camagru.co.za";
        $txt = "Dear $username
        
        You have indicated that you would like to reset your password,
        if you would like to reset your password please follow this link:
        http://localhost:8080/Camagru/verify_email.php?username=$username&reset=true&verify=false";
        mail($to, $subject, $txt, $header);

    }
    function password_reset_email($email, $new)
    {
        $to = $email;
		$subject = "New Password";
		$header = "From: accounts@camagru.co.za";
		$txt = "Your new password is: ". $new. "
		
				You can change it by going to the \"Settings\" page.
				
				Kind Regards
				Camagru";

        mail($to,$subject,$txt,$header);
    }
    function comment_email($commenter, $owner, $email)
    {
        $to = $email;
        $subject = "Someone left a comment on your photo!";
        $header = "From: team:camagru.co.za";
        $txt = "Hello, $owner
                
                $commenter left a comment on your image.
                
                Kind Regards;
                Camagru";
        mail($to, $subject, $txt, $header);
    }
?>