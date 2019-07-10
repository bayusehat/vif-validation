<div class="panel panel-container pad-rl">
	<form method="post" id="formApplication" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Subject <span class="color-red">*</span> </label>
							<input type="text" name="subject" class="form-control capitalize" placeholder="Subject" id="" required="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Description <span class="color-red">*</span></label>
							<input type="text" name="description" class="form-control capitalize" placeholder="Description" id="" required="">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Currency <span class="color-red">*</span></label>
							<select name="currency" class="form-control" id="currency">
								<option value="1">IDR</option>
								<option value="2">USD</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Amount in Word <span class="color-red">*</span></label>
							<input type="text" name="amount_in_word" class="form-control capitalize" placeholder="Amount in word" id="" required="">
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
							<input type="text" name="account_name" class="form-control capitalize" placeholder="Account Name" id="" required="">
						</div>
					</div>
				</div>
			<div class="hr-line"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<table class="table table-striped table-hover table-sm table-bordered" id="detailTable">
							<thead>
								<tr>
									<th>Code</th>
									<th>Description</th>
									<th>Duedate</th>
									<th>Amount</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="amountDetail">
								<tr>
									<td>
										<select class="form-control code" name="code[]" required="">
											<?php
												foreach ($datacode as $data) { ?>
												    <option value="<?= $data->CODE_ID;?>"><?= $data->NAME.' - '.$data->DESCRIPTION;?></option>
											<?php } ?>
										</select>
									</td>
									<td><input type="text" name="description_detail[]" placeholder="Description" class="form-control"></td>
									<td>
										<div class="input-group">
											<span class="input-group-btn">
                                                <a class="btn btn-default" type="button"><i class="fa fa-calendar"></i></a>
                                            </span>
											<input type="text" name="duedate[]" placeholder="duedate" class="form-control dates" required="">
										</div>
									</td>
									<td>
										<div class="input-group">
											<span class="input-group-btn">
                                                <a class="btn btn-default currency" type="button">Rp</a>
                                            </span>
											<input type="text" name="amount[]" placeholder="0" class="form-control amount" onkeyup="amountChange()" required="">
										</div>
									</td>
									<td><button type="button" class="btn btn-danger btn-sm btn-block"><i class="fa fa-trash"></i></button></td>
								</tr>
								<tr id="last">
									<td colspan="5">
										<div class="form-group">
											<a href="#" class="btn btn-secondary btn-block btn-sm" id="addRowDetail"><i class="fa fa-plus"></i></a>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="3">
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
			<div class="hr-line"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label>Attachment</label>
							<input type="file" name="files" class="form-control">
						</div>
					</div>
				</div>
			<div class="hr-line"></div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<label>Send To</label>
							<select class="form-control" name="">
								<option value="">Select Destination</option>
								<option>Manager</option>
								<option>Direktur</option>
								<option>Accounting Pusat</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<button type="submit" class="btn btn-success btn-lg" id="btnSendForm"><i class="fa fa-paper-plane"></i> Send Form</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(".dates").datepicker({dateFormat: 'yy-mm-dd'});
	$('input[name="files"]').fileuploader({
            addMore: true,
            extensions: ['jpg', 'jpeg', 'png', 'xls', 'xlsx', 'doc', 'docx', 'ppt', 'pptx', 'pdf', 'txt'],
            fileMaxSize: 1,
            limit: 25,
            theme: 'default'
        });
	function total(){
		var sum = 0;
        $(".amount").each(function() {
          var value = $(this).val();
          var i = value.replace(/,/g, '')
            if(!isNaN(i) && i.length != 0) {
                  sum += parseFloat(i);
                }
            });
        $("#total").text(sum);
        $('#total').priceFormat({
	        prefix: '',
	        limit: 12,
	        centsLimit: 0,
	        thousandsSeparator: ','
	    });
	}

	function amountChange() {
		total();
		$(".amount").keyup(function(){
			total()
		});
	}

	$("#currency").change(function(){
		var val = $(this).val();
		if(val == '1'){
			$('.currency').text('Rp ');
		}else{
			$('.currency').text('$ ');
		}
	});

	$(function(){
		$("#addRowDetail").click(function(){
			$.getJSON('<?php echo base_url();?>form/getCodeData',function(data){
				html = '';
				html += '<select class="form-control code" name="code[]">';
				for(i=0;i<data.length;i++){
					html += '<option value="'+data[i].CODE_ID+'">'+data[i].NAME+' - '+data[i].DESCRIPTION+'</option>';
				}
				html += '</select>';
				row = '<tr>'+
						'<td>'+html+'</td>'+
						'<td><input type="text" name="description_detail[]" placeholder="Description" class="form-control"></td>'+
						'<td>'+
							'<div class="input-group">'+
								'<span class="input-group-btn">'+
                                    '<a class="btn btn-default" type="button"><i class="fa fa-calendar"></i></a>'+
                                '</span>'+
								'<input type="text" name="duedate[]" placeholder="duedate" class="form-control dates">'+
							'</div>'+
						'</td>'+
						'<td>'+
							'<div class="input-group">'+
								'<span class="input-group-btn">'+
                                    '<a class="btn btn-default currency" type="button">Rp</a>'+
                                '</span>'+
								'<input type="text" name="amount[]" placeholder="0" class="form-control amount" onkeyup="amountChange()">'+
							'</div>'+
						'</td>'+
						'<td><button type="button" class="btn btn-danger btn-sm btn-block del"><i class="fa fa-trash"></i></button></td>'+
					'</tr>';
				$(row).insertBefore("#last");
				total();
				$(document).find('#currency').trigger('change');
				$('.amount, #amount').priceFormat({
			        prefix: '',
			        limit: 12,
			        centsLimit: 0,
			        thousandsSeparator: ','
			    });

				$('.code').focus();
				$(".dates").datepicker({dateFormat: 'yy-mm-dd'});
				// $('body, html').animate({ scrollTop: $("#amountDetail").offset().top }, 1000);
			})
		});

		$("#detailTable").delegate("button", "click", function() {
		   $(this).closest("tr").remove();
		   total(); 
		});
	});

	$('.amount, #total').priceFormat({
        prefix: '',
        limit: 12,
        centsLimit: 0,
        thousandsSeparator: ','
    });

 	// var validator = $("#formApplication").kendoValidator().data("kendoValidator");
	$("#formApplication").submit(function(event) {
		event.preventDefault();
		var form = $("#formApplication").closest("form");
		var formData = new FormData(form[0]);
			swal_confirm(function(){
				viewModel.ajaxFilePost(base_url+"form/add_form_run",formData,function(res){
						swal_success(res.msg);
						$('form#formApplication').trigger('reset');
						setTimeout(function(){
							window.location = base_url+"form";
					},1000);
				});
			})		
		});
</script>