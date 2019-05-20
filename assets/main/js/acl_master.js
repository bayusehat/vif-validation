aclMaster = {}
viewModel.aclMaster = aclMaster

aclMaster.newBranch = function() {
    return {
        ID_BRANCH: "",
        BRANCH_TITLE: "",
        BRANCH_LOCATION: "",
        ENABLE_BRANCH: 0,
    }
}

aclMaster.fBranch = ko.mapping.fromJS(aclMaster.newBranch())

aclMaster.getDataBranch = function() {
    viewModel.ajaxPost(base_url + "aclmaster/getdatabranch", {}, function(res) {
        aclMaster.generateBranch(res);
    })
}

aclMaster.generateBranch = function(jsonData) {
    columns = [{
            title: "Branch Id",
            field: "ID_BRANCH",
            width: 20,
        },
        {
            title: "Branch Name",
            field: "BRANCH_TITLE",
            width: 20,
        },
        {
            title: "Branch Location",
            field: "BRANCH_LOCATION",
            width: 20,
        },
        {
            title: "Branch Status",
            field: "ENABLE_BRANCH",
            width: 20,
            template: function(e) {
                return e.ENABLE_BRANCH == "1" ? "ENABLED" : "DISABLED"
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

aclMaster.validateForm = function(idModal) {
    var validator = $(idModal + " .input-form").kendoValidator().data("kendoValidator")
    if (!validator.validate()) {
        swal("Error", validator.errors()[0], "error")
        return false
    }
    return true
}

aclMaster.saveBranch = function() {
    data = ko.mapping.toJS(aclMaster.fBranch)
    param = {
        data: data
    }
    if (aclMaster.validateForm("#modalBranch")) {
        viewModel.ajaxPost(base_url + "aclmaster/savebranch", param, function(res) {
            console.log(res);
        }, function(err) {
            console.log(err);

        })
    }
}

$(function() {
    aclMaster.getDataBranch()
})