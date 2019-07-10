<div class="panel panel-container pad-rl">
	<form method="post" id="formApplication" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-8 col-sm-12">
				<div class="form-group">
					<h3 class="text-info"><i class="fa fa-file-text"></i> Form</h3>
				</div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="form-group">
					<h3 class="text-info"><i class="fa fa-history"></i> History</h3>
				</div>
			</div>
		</div>
	<div class="hr-line"></div>
		<div class="row">
			<div class="col-md-4 col-sm-12">
				<div class="form-group">
					<label>Branch</label>
					<br>
					<div class="label label-info"><?= $form->BRANCH_TITLE;?></div>
				</div>
				<div class="form-group">
					<label>Status</label>
					<br>
					<?php
					   if($form->STATUS == 'Verified'){
					   		echo '<div class="label label-success">'.$form->STATUS.'</div>';
					   }else if($form->STATUS == 'Rejected'){
					   		echo '<div class="label label-danger">'.$form->STATUS.'</div>';
					   }else if($form->STATUS == 'Paid'){
					   		echo '<div class="label label-info">'.$form->STATUS.'</div>';
					   }else{
					   		echo '<div class="label label-warning">'.$form->STATUS.'</div>';
					   }
					?>
				</div>
				<div class="form-group">
					<label>Subject</label>
					<input type="text" name="" class="form-visible" value="<?= $form->SUBJECT;?>">
				</div>
				<div class="form-group">
					<label>Description</label>
					<input type="text" name="" class="form-visible" value="<?= $form->DESCRIPTION;?>">
				</div>
				<div class="form-group">
					<label>Currency</label>
					<?php
						if($form->CURRENCY == 1){
							$val = 'IDR';
							$sym = 'Rp';
						}else{
							$val = 'USD';
							$sym = '$';
						}
					?>
					<input type="text" name="" class="form-visible" value="<?= $val;?>">
				</div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="form-group">
					<label>Amount</label>
					<input type="text" name="" class="form-visible" value="<?= $val.' '.number_format($form->TOTAL_AMOUNT);?>">
				</div>
				<div class="form-group">
					<label>Amount in Word</label>
					<input type="text" name="" class="form-visible" value="<?= $form->AMOUNT_IN_WORD;?>">
				</div>
				<div class="form-group">
					<label>Bank</label>
					<input type="text" name="" class="form-visible" value="<?= $form->BANK;?>">
				</div>
				<div class="form-group">
					<label>Account</label>
					<input type="text" name="" class="form-visible" value="<?= $form->ACCOUNT_NUMBER;?>">
				</div>
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="" class="form-visible" value="<?= $form->ACCOUNT_NAME;?>">
				</div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="scroll">
					<?php
						if(count($history)>0){
							foreach ($history as $data) {
								echo
									'<div class="form-group">
										<label>'.$data->HISTORY_STATUS.' by '.$data->NAME.'</label>
										<br>
										<p>On '.date('d F Y H:i',strtotime($data->CREATED_DATE)).'</p>
									</div>';
							}
						}
						// for($i=0;$i<5;$i++){
						// 	echo
						// 	'<div class="form-group">
						// 		<label>Created by ...</label>
						// 		<br>
						// 		<p>On Saturday, 15 June 2019</p>
						// 	</div>';
						// }
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="form-group">
					<h3 class="text-info"><i class="fa fa-list-alt"></i> Detail</h3>
				</div>
			</div>
		</div>
	<div class="hr-line"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th>Code</th>
							<th>Description</th>
							<th>Duedate</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($detail > 0){
							foreach ($detail as $data) {
								echo 
								'<tr>
									<td>'.$data->CODENAME.' - '.$data->CODEDES.'</td>
									<td>'.$data->DESCRIPTON.'</td>
									<td>'.date('d F Y',strtotime($data->DUEDATE)).'</td>
									<td>'.$sym.' '.number_format($data->AMOUNT).'</td>
								</tr>';
							}
						}
						
						?>
						<tr>
							<td colspan="3">
								<label class="right">Total Amount</label>
							</td>
							<td colspan="1">
								<span class="currency"><?= $sym;?> </span><span id="total"><?= number_format($form->TOTAL_AMOUNT);?></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="form-group">
					<h3 class="text-info"><i class="fa fa-paperclip"></i> Attachment</h3>
				</div>
			</div>
		</div>
	<div class="hr-line"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div id="lightgallery">
				<?php
				if(count($attachment) > 0){
						foreach ($attachment as $data) { 
							echo 
							'<a class="thumbnail" href="'.base_url().'assets/uploads/files/'.$data->FILE_NAME.'">
						      	<img src="'.base_url().'assets/uploads/files/'.$data->FILE_NAME.'" style="width: 100%"/>
							</a>';
						} 
					}else{
						echo '<h4><i class="fa fa-times color-red"></i> No files uploaded</h4>';
				} 
				?> 
				</div>
			</div>
		</div>
	<div class="hr-line"></div>
		<div class="row">
			<div class="col-md-5 col-sm-12">
				<label>Notes</label>
				<textarea class="form-control" name="notes" id="notes"></textarea>
			</div>
		</div>
	<br>
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<?php
				if($form->STATUS != 'Verified' && $form->STATUS != 'Rejected'){ ?>
					<button type="submit" class="btn btn-success btn-lg" id="btnSendForm" onclick="verifyForm(event,<?= $form->FORM_ID;?>);"><i class="fa fa-paper-plane"></i> Verify</button>
					<button type="submit" class="btn btn-danger btn-lg" id="btnRejectedForm"><i class="fa fa-times"></i> Reject</button>
			<?php } ?>
			
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	function verifyForm(event,id) {
		event.preventDefault();
		var form = $("#formVerify").closest("form");
		var formData = $("#notes").val();
			swal_confirm(function(){
				viewModel.ajaxPost(base_url+"form/verifyForm/"+id,formData,function(res){
						swal_success(res.msg);
						setTimeout(function(){
							window.location = base_url+"form/verifiedForms";
				},1000);
			});
		})		
	}

	function rejectedForm(argument) {
		// body...
	}
</script>