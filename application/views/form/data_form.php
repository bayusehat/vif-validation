<div class="panel panel-container pad-rl">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="row">
				<div class="col-md-12">
					<a href="<?= base_url();?>form/add_form" class="btn btn-success mb-3 right"><i class="fa fa-plus"></i> Add New Form</a>
				</div>
			</div>
		<div class="hr-line"></div>
			<div id="grid">
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function getform(argument) {
		viewModel.ajaxPost(base_url+"/form/getFormData",{},function(res) {
			console.log(res);
		});
	}

	var dataSource = new kendo.data.DataSource({
		transport : {
			read :{
				url : base_url+"/form/getFormData",
				type : "POST",
				dataType : "json"
			}
		},
		pageSize :10,
		autoSync: true,
         	schema: {
             	model: {
                 	id: "FORM_ID",
                 	fields: {
                     	TOTAL_AMOUNT: { type: "number", validation: { required: true, min: 1} }
		            }
		        }
		    }
	})

	$("#grid").kendoGrid({	
	 		toolbar: ["excel"],
            excel: {
                fileName: "Data form Export.xlsx",
                filterable: true
            },	
			dataSource : dataSource,
			height: 500,
                groupable: true,
                sortable: true,
               	filterable: {
                    mode: "row"
                },
                pageable: {
                    refresh: true,
                    pageSizes: true,
                    buttonCount: 5
                },
                columns: [{
                    field: "SUBJECT",
                    title: "SUBJECT",
                }, {
                    field: "DESCRIPTION",
                    title: "DESCRIPTION"
                }, {
                    field: "TOTAL_AMOUNT",
                    title: "TOTAL AMOUNT",
                    format: "{0:n}"
                },{
                	field: "STAGE",
                	title: "STAGE"
                },{
                    template: "<div class='form-group'>"+
                    "<a href='"+base_url+"form/detail/#: data.FORM_ID #' class='btn btn-info'><i class='fa fa-eye'></i> DETAIL</a>"+
                    "<a href='"+base_url+"form/detail/#: data.FORM_ID #' class='btn btn-danger'><i class='fa fa-trash'></i> DELETE</a>"+
                    "</div>",
                    title: "ACTION",
                    width: 240
                }]
		})
	
	$(function(){
		getform()
	});
</script>

