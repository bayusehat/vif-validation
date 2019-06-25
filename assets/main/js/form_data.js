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

    //Verified Forms

    var dataSourceVerify = new kendo.data.DataSource({
        transport : {
            read :{
                url : base_url+"/form/getVerifiedForms",
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

    $("#gridVerify").kendoGrid({  
            dataSource : dataSourceVerify,
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
                    template : 
                    "<a href='"+base_url+"form/view_form/#: data.FORM_ID #'> #: data.SUBJECT # <i class='fa fa-link'></i></a>",
                    title: "SUBJECT",
                    width: "300px"
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
                    template:
                    "<div class='label label-success'>#: data.STATUS #</div>",
                    field: "STATUS",
                    title: "STATUS"
                }]
        })

    //Rejected Forms

    var dataSourceReject = new kendo.data.DataSource({
        transport : {
            read :{
                url : base_url+"/form/getRejectedForms",
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

    $("#gridRejected").kendoGrid({  
            dataSource : dataSourceReject,
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
                    template : 
                    "<a href='"+base_url+"form/view_form/#: data.FORM_ID #'> #: data.SUBJECT # <i class='fa fa-link'></i></a>",
                    title: "SUBJECT",
                    width: "300px"
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
                    template:
                    "<div class='label label-danger'>#: data.STATUS #</div>",
                    field: "STATUS",
                    title: "STATUS"
                }]
        })