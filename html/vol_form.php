<?php 

?>
<div class="modal">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Create New Volunteer</h4>
      </div>
      <form id="new-vol" action="../volenteer/view.php" method="POST">
		<div class="modal-body">
			First Name: <input type="text" name="firstname" value="" /><br/>
			Last Name: <input type="text" name="lastname" value="" /><br/>
			Phone Number: <input class="phone-mask" type="text" name="phone" value="" /><br/>
		</div>
		<div class="modal-footer">
			<input type="submit" name="save" value="SAVE" /><br/>
		</div>
		</form>
		<script type="text/javascript">
			$('.phone-mask').mask("(999)999-9999");
		</script>
</div>