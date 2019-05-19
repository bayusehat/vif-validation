<div class="panel panel-container pad-rl">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Subject</label>
						<input type="text" name="subject" class="form-control" placeholder="Subject" id="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Description</label>
						<input type="text" name="description" class="form-control" placeholder="Description" id="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Currency</label>
						<input type="text" name="currency" class="form-control" placeholder="currency" id="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Amount in Word</label>
						<input type="text" name="amount_in_word" class="form-control" placeholder="Amount in word" id="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Bank</label>
						<input type="text" name="bank" class="form-control" placeholder="File" id="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Account</label>
						<input type="text" name="account_number" class="form-control" placeholder="Account Number" id="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="account_name" class="form-control" placeholder="Account Name" id="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Stage</label>
						<input type="text" name="stage" class="form-control" placeholder="Stage" id="">
					</div>
				</div>
			</div>
		<hr>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<h4>Detail Forms</h4>
					</div>
					<table class="table table-striped table-bordered table-sm">
						<tr>
							<th>Code</th>
							<th>Description</th>
							<th>Amount</th>
							<th>Action</th>
						</tr>
						<tr>
							<td><input type="text" name="code" placeholder="Code" class="form-control"></td>
							<td><input type="text" name="description_detail" placeholder="Description" class="form-control"></td>
							<td><input type="text" name="amount" placeholder="Amount" class="form-control"></td>
							<td><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
						</tr>
					</table>
					<div class="form-group">
						<a href="#" class="btn btn-secondary border btn-block btn-sm"><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="form-group">
						<label>Send To</label>
						<select class="form-control" name="">
							<option value="">Select Destination</option>
							<option>Dummy</option>
							<option>Dummy</option>
							<option>Dummy</option>
							<option>Dummy</option>
						</select>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<button type="submit" class="btn btn-success btn-block mt-3 right"><i class="fa fa-paper-plane"></i> Send Form</button>
				</div>
			</div>
		</div>
	</div>
</div>
