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
			dataSource : dataSource,
			// height: 500,
                // groupable: true,
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
                    title: "Subject",
                    width: "300px",
                    template : 
                    "<a href='"+base_url+"form/view_form/#: data.FORM_ID #'> #: data.SUBJECT # <i class='fa fa-link'></i></a>"
                },{
                    field: "TOTAL_AMOUNT",
                    title: "Total Amount",
                    format: "{0:n}"
                },{
                	field: "STAGE",
                	title: "Stage"
                },{
                	field: "STATUS",
                	title: "Status",
                	template : 
                	"# if(STATUS == 'Open'){ # <div class='label label-primary'> #: data.STATUS #</div>#}"+
                	"else if(STATUS == 'Paid'){# <div class='label label-info'>#: data.STATUS #</div>#}"+
                	"else if(STATUS == 'Verified'){# <div class='label label-success'>#: data.STATUS #</div>#}"+
                	"else{# <div class='label label-danger'>#: data.STATUS #</div>#}#"
                }]
		})