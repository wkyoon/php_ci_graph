<?php echo form_open('tbdatum/edit/'.$tbdatum['idx']); ?>

	<div>
		Mac : 
		<input type="text" name="mac" value="<?php echo ($this->input->post('mac') ? $this->input->post('mac') : $tbdatum['mac']); ?>" />
	</div>
	<div>
		Thrhlder : 
		<input type="text" name="thrhlder" value="<?php echo ($this->input->post('thrhlder') ? $this->input->post('thrhlder') : $tbdatum['thrhlder']); ?>" />
	</div>
	<div>
		Val01 : 
		<input type="text" name="val01" value="<?php echo ($this->input->post('val01') ? $this->input->post('val01') : $tbdatum['val01']); ?>" />
	</div>
	<div>
		Tinfo : 
		<input type="text" name="tinfo" value="<?php echo ($this->input->post('tinfo') ? $this->input->post('tinfo') : $tbdatum['tinfo']); ?>" />
	</div>
	
	<button type="submit">Save</button>
	
<?php echo form_close(); ?>