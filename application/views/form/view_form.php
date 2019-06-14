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
					<div class="label label-primary"><?= $form->CREATE_FOR_BRANCH;?></div>
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
				<div class="form-group">
					<label>Created by ...</label>
					<br>
					<p>On Saturday, 15 June 2019</p>
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
				<div id="attachment">
				<?php
				if($attachment > 0){ ?>
				<?php 
				foreach ($attachment as $data) { ?>
					<a class="item" href="<?= base_url();?>assets/uploads/files/<?= $data->FILE_NAME;?>">
				      	<img src="<?= base_url();?>assets/uploads/files/<?= $data->FILE_NAME;?>" />
					</a>
				<?php	} ?>
			<?php }else{ ?>
				<label>No Files Uploaded</label>
			<?php } ?> 
				</div>
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