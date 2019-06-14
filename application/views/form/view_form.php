<div class="panel panel-container pad-rl">
	<form method="post" id="formApplication" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="form-group">
					<h3 class="text-info"><i class="fa fa-file-text"></i> Form</h3>
				</div>
			</div>
		</div>
	<div class="hr-line"></div>
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<div class="form-group">
					<label>Branch</label>
					<div class="label label-primary"><?= $form->CREATE_FOR_BRANCH;?></div>
				</div>
				<div class="form-group">
					<label>Status</label>
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
					<input type="text" name="" class="form-visible" value="<?= $form->CURRENCY;?>">
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
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
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="form-group">
					<h3 class="text-info"><i class="fa fa-money"></i> Detail</h3>
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
						<tr>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">
								<label class="right"><h2>TOTAL</h2></label>
							</td>
							<td colspan="2">
								<h2><span class="currency">Rp </span><span id="total">0</span></h2>
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
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12">
				<button type="submit" class="btn btn-success btn-lg" id="btnSendForm"><i class="fa fa-paper-plane"></i> Verify</button>
				<button type="submit" class="btn btn-danger btn-lg" id="btnRejectedForm"><i class="fa fa-times"></i> Reject</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
</script>