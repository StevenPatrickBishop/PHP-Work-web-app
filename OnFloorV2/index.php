<?php include('DB/database.php')?>
<?php include('functions.php')?>
<?php include('header.php')?>
<main>
	<?php include('main_menu.php')?>
	<div class="main-content-area">
		<div class="content-heading"><h1>Task Sets</h1></div>
		<div class="col-center sets">
		<?php include('new_set_modal.php')?>
		<button class="btn-add-set">Add Set</button>		
		<div class="table-wrap">
			<table id='set-table'>
				<tr class="table-heading">
					<th></th>
					<th>Task Count</th>
					<th class="col-width-shrink">Tasks performed this week</th>
					<th>Tasks overdue</th>
					<th>Execute on</th>
					<th></th>
				</tr> 

						<?php
						$dbc = db_connect();
						$query = "SELECT * FROM sets";
						$counter = 0;

						if ( $r = mysqli_query( $dbc, $query ) ) {
						while ( $record = mysqli_fetch_array( $r ) ) {
						$set_name = $record['set_name'];
						$days = $record['scheduled_for'];
						$set_id = $record['set_id'];
						$edit_set = 'ediSet'.$set_id;
						$delete_set = 'delSet'.$set_id;
						?>

				<tr>
					<td class='left-aligned-text'><?php echo $set_name?></td>
					<td><?php echo getNumberofTasksGivenSet($set_id);?></td>
					<td>0</td>
					<td>0</td>
					<td> <?php echo $days ?></td>

					<td class='tbl-buttons'>
						<button class='btn-edit-set <?php echo $edit_set ?>'>Edit</button>
						<?php include('edit_set.php');?>

						<button class='btn-delete-set <?php echo $delete_set?>'>&times;</button>
						<?php include('delete_set.php');?>
					</td>
				</tr>

				<?php } } db_disconnect($dbc); ?>  <!--end of query loop  -->

			</table>
		</div> <!--table wrap end-->
		</div>
	</div> <!--content area end-->
</main>
<?php include('footer.php') ?>