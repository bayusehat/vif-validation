<div class="panel panel-container pad-rl">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="row">
				<div class="col-md-12">
					<a href="<?= base_url();?>form/add_form" class="btn btn-success mb-3 right"><i class="fa fa-plus"></i> ADD NEW FORM</a>
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
		sort: { field: "FORM_ID", dir: "desc" },
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
                // groupable: true,
                sortable: true,
               	// filterable: {
                //     mode: "row"
                // },
                pageable: {
                    refresh: true,
                    pageSizes: true,
                    buttonCount: 5
                },
                columns: [{
                    // field: "SUBJECT",
                    template : 
                    "<a href='"+base_url+"form/view_form/#: data.FORM_ID #'> #: data.SUBJECT # <i class='fa fa-link'></i></a>",
                    title: "SUBJECT",
                    width : "300px"
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
                	field:
                	"STATUS",
                	title: "STATUS"
                }
                // {
                //     template: 
                //     "<div class='form-group'>"+
                //     	"<a href='javascript:void(0)' onclick='return deleteForm(#: data.FORM_ID #)' class='btn btn-danger'><i class='fa fa-trash'></i></a>"+
                //     "</div>",
                //     title: "ACTION",
                // }
                ]
		})

	function deleteForm(id) {
		swal_confirm(function(){
			viewModel.ajaxPost(base_url+"/form/deleteForm/"+id,{"FORM_ID" : id},function(res) {
				swal_success(res.msg);
				getform();
			},
			function(res){
				swal_failed(res.msg);
			});
		})
	}
	
	$(function(){
		getform()
	});
</script>

