<div class='modal <?php echo $edit_set ?>'>
<?php include('edit_set_form_handler.php')?>
	<div class='modal-content'>
		<span class='close-modal'>&times;</span>
		<h1 class='content-heading' ><?php echo $set_name ?></h1>


		<form action='' method='post' class='edit-set'>

			<p>Re-name:
				<?php $value = isset($set_name) ? $set_name : '';?>
				<input type='text' name='set_name' value='<?php echo $value ?>' />
				<?php if(isset($_POST['set_name']) && empty($_POST['set_name']) ){
				echo "<span class='error'>Set name not valid </span>";} ?>
			</p>

			<?php include('day_switch.php')?>

			<input type="submit" class='btn-update' name='<?php echo $set_id ?>' value="Update Set">

		</form>

		<?php include('add_task_table.php')?>


	</div> <!--Modal Content End-->
</div> <!--Modal End-->