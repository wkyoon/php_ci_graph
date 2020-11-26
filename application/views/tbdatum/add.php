<?php echo form_open('tbdatum/add'); ?>

	<div>
		Mac : 
		<input type="text" name="mac" value="<?php echo $this->input->post('mac'); ?>" />
	</div>
	<div>
		Thrhlder : 
		<input type="text" name="thrhlder" value="<?php echo $this->input->post('thrhlder'); ?>" />
	</div>
	<div>
		Val01 : 
		<input type="text" name="val01" value="<?php echo $this->input->post('val01'); ?>" />
	</div>
	<div>
		Tinfo : 
		<input type="text" name="tinfo" value="<?php echo $this->input->post('tinfo'); ?>" />
	</div>
	
	<button type="submit">Save</button>

<?php echo form_close(); ?>