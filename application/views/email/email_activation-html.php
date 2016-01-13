<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Your new email address on <?php //echo $site_name; ?></title></head>
<body>
<? //print_r($feedbackdetail);

?>
<div style="">
	<div id="header" style="background-image: url('<?php echo base_url(); ?>artefacts/images/site/header-bg.jpg');
		background-repeat: repeat-x;
		height: 111px;
		margin: 0 auto;
		width: 982px;">

		<div class="logo" style="    float: left;
    height: 77px;
    margin: 17px;
    width: 197px;"><a href=""><img src="<?php echo base_url(); ?>artefacts/images/site/logo_new.png" width="194"
		                           height="77"/></a>
		</div>
	</div>

	<div style="margin-left: auto;margin-right: auto;width:986px;">
		<div><h1 style="font-weight: bold;color: #509DFF">Welcome to Skillsapien!</h1></div>

		<div>
			Thank you for registering your email with us!
		</div>
		<br/>
		To complete the registration process, please click here to confirm your email address:</br><br/>
		<a href="<?php echo $activation_link; ?>"><?php echo $activation_link; ?></a></br><br/></br>
		<br> <br/>
		Thanks and best regards,</br>
		<br/><br/>
		The Skillsapien Team</br>
		<br/>
		<img src="<?php echo base_url(); ?>artefacts/images/site/logo_new.png" width="100"/>
	</div>
</div>


</body>
</html>