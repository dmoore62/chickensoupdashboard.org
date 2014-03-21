<?php 

?>
<div class="modal">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Create New Event</h4>
      </div>
      <form id="new-event" action="../recipients/view.php" method="POST" class="form-horizontal">
      <legend></legend>
		<fieldset>
			<div class="control-group">  
	            <label class="control-label" for="event-type">Event Type</label>  
	            <div class="controls">  
	              <select name="event-type" id="event-type" class="form-control" title="Select event type...">
	              	<option>Select Event Type...</option>
	              	<option value="0">Transportation</option>
	              	<option value="1">Visit</option>
	              	<option value="2">Meal</option>
	              	<option value="3">Other</option>
	              </select>
	            </div>  
	        </div>
	        
		</fieldset>
		<div class="modal-footer">
			<input type="submit" name="save" class="btn btn-primary" value="SAVE" /><br/>
		</div>
		</form>
		<script type="text/javascript">
			$('.phone-mask').mask("(999)999-9999");

			$('#event-type').on('change', function(){
				alert('here');
			});
		</script>
</div>