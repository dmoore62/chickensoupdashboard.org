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
			<input id="event-type-input" type="hidden" name="event-type" value=""/>
			<div class="control-group">  
	            <label class="control-label" for="event-type">Event Type</label>  
	            <div class="controls">  
	              <select name="event-type" id="event-type" class="form-control" title="Select event type...">
	              	<option>Select Event Type...</option>
	              	<option value="0">Transportation</option>
	              	<option value="1">Visit</option>
	              	<option value="2">Meal</option>
	              	<!-- <option value="3">Other</option> -->
	              </select>
	            </div>
	        </div>
	    </fieldset>
	    <div class="event-form" id="trans">
	    	<fieldset>
	    		<div class="control-group">
	    			<label class="control-label" for="from-date">Date:</label>
	    			<div class="controls">
	    				<input type="text" name="from-date" id="from-date" class="datepick" />
	    			</div>
	    		</div>
	    		<div class="control-group">  
				    <label class="control-label" for="round-trip">Round Trip?</label>  
				        <div class="controls">  
				            <select name="round-trip" id="round-trip" class="form-control">
				             	<option value="1">Yes</option>
				              	<option value="0">No</option>
				            </select>  
				        </div>  
				</div>
				<div class="control-group">  
				    <label class="control-label" for="stay">Stay with Client?</label>  
				        <div class="controls">  
				            <select name="stay" id="stay" class="form-control">
				             	<option value="1">Yes</option>
				              	<option value="0">No</option>
				            </select>  
				        </div>  
				</div>
	    		<div class="control-group">
	    			<label class="control-label" for="time">Pick Up Time</label>
	    			<div class="controls">
	    				 <div class="input-append bootstrap-timepicker">
							<input id="time" name="time" type="text" class="timepick">
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="appt-time">Appt. Time</label>
	    			<div class="controls">
	    				 <div class="input-append bootstrap-timepicker">
							<input id="appt-time" name="appt-time" type="text" class="timepick">
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="destination">Destination</label>
	    			<div class="controls">
	    				<input type="text" name="destination" id="destination"/>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="appt-length">Appt. Length</label>
	    			<div class="controls">
	    				<input type="text" name="appt-length" id="appt-length"/>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="directions">Directions</label>
	    			<div class="controls">
	    				<textarea id="directions" name="directions"></textarea>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="spec-instructions">Special Inspec-instructions</label>
	    			<div class="controls">
	    				<textarea id="spec-instructions" name="spec-instructions"></textarea>
	    			</div>
	    		</div>
	    		<div class="control-group">  
				    <label class="control-label" for="recurring">Recurring Event?</label>  
				        <div class="controls">  
				            <select name="recurring" id="recurring" class="form-control">
				             	<option value="1">Yes</option>
				              	<option value="0">No</option>
				            </select>  
				        </div>  
				</div>
				<div class="control-group">  
				    <label class="control-label" for="needs">Other Needs?</label>  
				        <div class="controls">  
				            <select name="needs" id="needs" class="form-control">
				             	<option value="1">Yes</option>
				              	<option value="0">No</option>
				            </select>  
				        </div>  
				</div>
	    	</fieldset>    	
	    </div>
	    <div class="event-form" id="visit">
	        	<fieldset>
	    		<div class="control-group">
	    			<label class="control-label" for="from-date">Date:</label>
	    			<div class="controls">
	    				<input type="text" name="from-date" id="from-date" class="datepick" />
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="time">Start Time</label>
	    			<div class="controls">
	    				 <div class="input-append bootstrap-timepicker">
							<input id="time" name="time" type="text" class="timepick">
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="time">End Time</label>
	    			<div class="controls">
	    				 <div class="input-append bootstrap-timepicker">
							<input id="time" name="time" type="text" class="timepick">
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="location">Location</label>
	    			<div class="controls">
	    				<input type="text" name="location" id="location"/>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="directions">Directions</label>
	    			<div class="controls">
	    				<textarea id="directions" name="directions"></textarea>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="spec-instructions">Special Inspec-instructions</label>
	    			<div class="controls">
	    				<textarea id="spec-instructions" name="spec-instructions"></textarea>
	    			</div>
	    		</div>
	    		<div class="control-group">  
				    <label class="control-label" for="recurring">Recurring Event?</label>  
				        <div class="controls">  
				            <select name="recurring" id="recurring" class="form-control">
				             	<option value="1">Yes</option>
				              	<option value="0">No</option>
				            </select>  
				        </div>  
				</div>
				<div class="control-group">  
				    <label class="control-label" for="needs">Other Needs?</label>  
				        <div class="controls">  
				            <select name="needs" id="needs" class="form-control">
				             	<option value="1">Yes</option>
				              	<option value="0">No</option>
				            </select>  
				        </div>  
				</div>
	    	</fieldset>
	    </div>
	    <div class="event-form" id="meal">
	        <fieldset>
	    		<div class="control-group">
	    			<label class="control-label" for="from-date">Date: From</label>
	    			<div class="controls">
	    				<input type="text" name="from-date" id="from-date" class="datepick" />
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="to-date">To</label>
	    			<div class="controls">
	    				<input type="text" name="to-date" id="to-date" class="datepick" />
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="time">Time</label>
	    			<div class="controls">
	    				 <div class="input-append bootstrap-timepicker">
							<input id="time" name="time" type="text" class="timepick">
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="portions">Portions</label>
	    			<div class="controls">
	    				<input type="text" name="portions" id="portions"/>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="restrictions">Dietary Restrictions</label>
	    			<div class="controls">
	    				<textarea id="restrictions" name="restrictions"></textarea>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="deliver-to">Deliver To</label>
	    			<div class="controls">
	    				<input type="text" name="deliver-to" id="deliver-to"/>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="deliver-time">Deliver Time</label>
	    			<div class="controls">
	    				 <div class="input-append bootstrap-timepicker">
							<input id="deliver-time" name="deliver-time" type="text" class="timepick">
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
	    			</div>
	    		</div>
	    		<div class="control-group">
	    			<label class="control-label" for="directions">Directions</label>
	    			<div class="controls">
	    				<textarea id="directions" name="directions"></textarea>
	    			</div>
	    		</div>
	    		<div class="control-group">  
				    <label class="control-label" for="recurring">Recurring Event?</label>  
				        <div class="controls">  
				            <select name="recurring" id="recurring" class="form-control">
				             	<option value="1">Yes</option>
				              	<option value="0">No</option>
				            </select>  
				        </div>  
				</div>
				<div class="control-group">  
				    <label class="control-label" for="needs">Other Needs?</label>  
				        <div class="controls">  
				            <select name="needs" id="needs" class="form-control">
				             	<option value="1">Yes</option>
				              	<option value="0">No</option>
				            </select>  
				        </div>  
				</div>
	    	</fieldset>
	    </div>
	    <div class="event-form" id="other">
	        	General Form
	    </div>	        
		</fieldset>
		<div class="modal-footer">
			<input type="submit" name="save" class="btn btn-primary" value="SAVE" /><br/>
		</div>
		</form>
		<script type="text/javascript">
			$('.phone-mask').mask("(999)999-9999");

			$('#event-type').on('change', function(){
				var eventType = $(this).val();
				$('#event-type-input').val(eventType);
				$('.event-form').each(function(){
					$(this).hide();
				});
				switch (Number(eventType)){
					case 0:
						$('div#trans').show()
						break;
					case 1:
						$('div#visit').show();
						break;
					case 2:
						$('div#meal').show();
						break;
					case 3:
						$('div#other').show();
						break;
				} 
			});

			$('.datepick').datepicker();
			$('.timepick').timepicker();
		</script>
		<style type="text/css">
			div.event-form{
				display: none;
			}

			.datepicker,
			.bootstrap-timepicker-widget{
				z-index: 1151;
			}
		</style>
</div>