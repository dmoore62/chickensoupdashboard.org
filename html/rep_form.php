<?php 

?>
<div class="modal">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Create New Recipient</h4>
      </div>
      <form id="new-recip" action="../recipients/view.php" method="POST" class="form-horizontal">
      <legend></legend>
		<fieldset>
			<div class="control-group">  
	            <label class="control-label" for="fname">First Name</label>  
	            <div class="controls">  
	              <input type="text" class="input-large" name="fname" id="fname">  
	            </div>  
	        </div>
	        <div class="control-group">  
	            <label class="control-label" for="lname">Last Name</label>  
	            <div class="controls">  
	              <input type="text" class="input-large" name="lname" id="lname">  
	            </div>  
	        </div>
	        <div class="control-group">  
	            <label class="control-label" for="email">E-Mail</label>  
	            <div class="controls">  
	              <input type="text" class="input-large" name="email" id="email">  
	            </div>  
	        </div>
	        <div class="control-group">  
	            <label class="control-label" for="address">Address</label>  
	            <div class="controls">  
	              <input type="text" class="input-large" name="address" id="address">  
	            </div>  
	        </div>
	        <div class="control-group">  
	            <label class="control-label" for="city">City</label>  
	            <div class="controls">  
	              <input type="text" class="input-large" name="city" id="city">  
	            </div>  
	        </div>
	        <div class="control-group">  
	            <label class="control-label" for="postal">Zip</label>  
	            <div class="controls">  
	              <input type="text" class="input-large" name="postal" id="postal">  
	            </div>  
	        </div> 
			<div class="control-group">  
	            <label class="control-label" for="hphone">Home Phone</label>  
	            <div class="controls">  
	              <input type="text" class="input-large phone-mask" name="hphone" id="hphone">  
	            </div>  
	        </div>
		</fieldset>
		<div class="modal-footer">
			<input type="submit" name="save" class="btn btn-primary" value="SAVE" /><br/>
		</div>
		</form>
		<script type="text/javascript">
			$('.phone-mask').mask("(999)999-9999");
		</script>
</div>