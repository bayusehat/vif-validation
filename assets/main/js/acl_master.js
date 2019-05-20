aclMaster = {}
viewModel.aclMaster = aclMaster

aclMaster.getDataBranch = function() {
	viewModel.ajaxPost(base_url+"aclmaster/getdatabranch",{},function(res) {
		aclMaster.generateBranch(res);
	})
}

aclMaster.generateBranch = function(jsonData) {
	columns = [
		{
			title : "Branch Id",
			field : "ID_BRANCH",
			width : 20,
		},
		{
			title : "Branch Name",
			field : "BRANCH_TITLE",
			width : 20,
		},
		{
			title : "Branch Location",
			field : "BRANCH_LOCATION",
			width : 20,
		},
		{
			title : "Branch Status",
			field : "ENABLE_BRANCH",
			width : 20,
			template: function(e) {
				return e.ENABLE_BRANCH=="1"?"ENABLED":"DISABLED"
			}
		},
	]
	$('#gridBranch').kendoGrid({
        dataSource: {
            data: jsonData,
        },
        sortable: true,
        filterable: false,
        scrollable: true,
        columns: columns,
    })
}

aclMaster.addBranch = function() {
	$("#modalBranch").modal("show")
}

$(function() {
	aclMaster.getDataBranch()
})