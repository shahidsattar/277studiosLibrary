<script type="text/javascript">
function submitValidate_workshop_add_stepfour()
{
	var formArray = $('#login_form').serialize();
	
	$.post('<?php echo base_url();?>login/login_validation/' , formArray, function(data)
	
	{
	if (data.success)
	{
		//alert('logged inn Successfully');
		top.location = '<?php echo base_url();?>home/';
	}
	
	else
	
	{
	for (var i in data.errors)
	
	{
	$('#'+i).css('border-color', 'red');
	$('#'+i).validationEngine('showPrompt', data.errors[i], '', 'topRight', true);
	}
	
	for (var z in data.hidden)
	
	{
	$('#login_form#' +data.hidden[z]).validationEngine('hide');
	}
	
	}
	
	
	
	}, 'json');
	return false;
}

</script>



	<!--<img src="<?=base_url()?>images/logo.png" style="margin-top:-43px; margin-bottom:77px; width:100%">-->
    <div class="container">
	
      <form name="login_form" id="login_form" class="form-signin" method="post" action="<?=base_url()?>login">
        <h2 class="form-signin-heading">Please sign in</h2>
		<?php
			if(validation_errors()){
			echo '<div class="warning" style="width:500px;">'.validation_errors().'</div>';
			}
			if(!empty($msg))
			{?>
			<div class="success"><?php echo $msg;?></div>
			<?php	}
			if($this->session->flashdata('error_message'))
			echo '<div class="warning">'.@$this->session->flashdata('error_message').'</div>';
			?>
        <input type="text" class="input-block-level" name="email" id="email" placeholder="Email address" <?php if(@$email){ echo @$email;}else { set_value('email'); }?>>
        <input type="password" class="input-block-level" placeholder="Password" name="password" id="password" <?php if(@$password){ echo @$password;}else { set_value('password'); }?>>
        <label class="checkbox">
          <input type="checkbox" value="rememberme"> Remember me
        </label>
		
        <button class="btn btn-large btn-primary" type="submit" onClick="submitValidate_workshop_add_stepfour();return false;">Sign in</button>
		<a href="<?php echo $this->config->item('base_url');?>login/forget_password" style="float:right" >Forget Password</a>

		
	      </form>

    </div> <!-- /container --> 