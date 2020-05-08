<script>
//set global user object
FECI.user = {
	department_idn : <?php echo $this->session->userdata('department_idn'); ?>,
	user_idn : <?php echo $this->session->userdata('user_idn'); ?>,
	user_name : '<?php echo $this->session->userdata('user_name'); ?>',
	first_name : '<?php echo quotes_to_entities($this->session->userdata('first_name')); ?>',
	last_name : '<?php echo quotes_to_entities($this->session->userdata('last_name')); ?>',
	is_admin : <?php echo $this->session->userdata('is_admin'); ?>,
	read_only: <?php echo $this->session->userdata('read_only'); ?> 
}
</script>
