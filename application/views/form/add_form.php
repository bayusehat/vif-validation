<div class="panel panel-container pad-rl">
	<form method="post" id="formApplication" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Subject <span class="color-red">*</span> </label>
							<input type="text" name="subject" class="form-control" placeholder="Subject" id="" required="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Description <span class="color-red">*</span></label>
							<input type="text" name="description" class="form-control" placeholder="Description" id="" required="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Currency <span class="color-red">*</span></label>
							<input type="text" name="currency" class="form-control" placeholder="currency" id="" required="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Amount in Word <span class="color-red">*</span></label>
							<input type="text" name="amount_in_word" class="form-control" placeholder="Amount in word" id="" required="">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Bank <span class="color-red">*</span></label>
							<input type="text" name="bank" class="form-control" placeholder="Bank" id="" required="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Account <span class="color-red">*</span></label>
							<input type="text" name="account_number" class="form-control" placeholder="Account Number" id="" required="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Name <span class="color-red">*</span></label>
							<input type="text" name="account_name" class="form-control" placeholder="Account Name" id="" required="">
						</div>
					</div>
				</div>
			<div class="hr-line"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<table class="table table-striped table-hover table-sm" id="detailTable">
							<thead>
								<tr>
									<th>Code</th>
									<th>Description</th>
									<th>Amount</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="amountDetail">
								<tr>
									<td><input type="text" name="code[0]" placeholder="Code" class="form-control code"></td>
									<td><input type="text" name="description_detail[0]" placeholder="Description" class="form-control"></td>
									<td><input type="text" name="amount[0]" placeholder="Amount" class="form-control"></td>
									<td><button type="button" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i></button></td>
								</tr>
								<tr id="last"></tr>
							</tbody>
						</table>
						<div class="form-group">
							<a href="#" class="btn btn-primary btn-block btn-sm" id="addRowDetail"><i class="fa fa-plus"></i></a>
						</div>
					</div>
				</div>
			<div class="hr-line"></div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Attachment <span class="color-red">*</span></label>
							<input type="file" name="attachment[]" class="form-control" multiple="">
						</div>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="mt-3">
							<span class="color-red">*You can add attachment more than one</span>
						</div>
					</div>
				</div>
			<div class="hr-line"></div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<!-- <div class="form-group">
							<label>Send To</label>
							<select class="form-control" name="">
								<option value="">Select Destination</option>
								<option>Dummy</option>
								<option>Dummy</option>
								<option>Dummy</option>
								<option>Dummy</option>
							</select>
						</div> -->
					</div>
					<div class="col-md-6 col-sm-12">
						<button type="submit" class="btn btn-success btn-block right" id="btnSendForm"><i class="fa fa-paper-plane"></i> Send Form</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	var i = 1;
	$(function(){
		$("#addRowDetail").click(function(){
			row = '<tr>'+
						'<td><input type="text" name="code['+i+']" placeholder="Code" class="form-control code"></td>'+
						'<td><input type="text" name="description_detail['+i+']" placeholder="Description" class="form-control"></td>'+
						'<td><input type="text" name="amount['+i+']" placeholder="Amount" class="form-control"></td>'+
						'<td><button type="button" class="btn btn-danger btn-sm btn-block del"><i class="fa fa-trash"></i></button></td>'+
					'</tr>';
			$(row).insertBefore("#last");
			i++;
			$('.code').focus();
			$('body, html').animate({ scrollTop: $("#amountDetail").offset().top }, 1000);
		});

		$("#detailTable").delegate("button", "click", function() {
		   $(this).closest("tr").remove(); 
		});
	});
 	// var validator = $("#formApplication").kendoValidator().data("kendoValidator");
	$("#btnSendForm").click(function(event) {
		event.preventDefault();
		var form = $("#formApplication").closest("form");
		var formData = new FormData(form[0]);
			viewModel.ajaxFilePost(base_url+"form/add_form_run",formData,function(res){
				swal_success(res.msg);
				$('form#formApplication').trigger('reset');
				setTimeout(function(){
					window.location = base_url+"form";
				},1000);
			});
		});
		
</script>