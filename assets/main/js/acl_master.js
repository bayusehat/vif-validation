aclMaster = {}
viewModel.aclMaster = aclMaster

aclMaster.dataBranch = ko.observableArray([]);

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
        aclMaster.dataBranch(res)
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
                return e.ENABLE_BRANCH == 1 ? "ENABLED" : "DISABLED"
            }
        },
        {
            title : "Action",
            width : 15,
            headerAttributes: { style: "text-align: center;" },
            attributes: { style: "text-align: center;" },
            template : function(e) {
                return  '<a class="btn btn-primary btn-sm btn-action" href="javascript:aclMaster.editBranch(this,'+e.ID_BRANCH+',\''+e.uid+'\')">Edit</a>' + 
                        '<a class="btn btn-danger btn-sm btn-action" href="javascript:aclMaster.deleteBranch(this,'+e.ID_BRANCH+',\''+e.uid+'\')">Delete</a>'
            }
        }
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
    ko.mapping.fromJS(aclMaster.newBranch(), aclMaster.fBranch)
    $("#modalBranch").modal("show")
}

aclMaster.editBranch = function(e,id,uid) {
    dt = _.find(aclMaster.dataBranch(), function(e) {
        return e.ID_BRANCH == id
    })
    ko.mapping.fromJS(dt, aclMaster.fBranch)
    $("#modalBranch").modal("show")
    // console.log({"e":e, "id":id, "uid":uid});
}

aclMaster.deleteBranch = function(e,id,uid) {
    swal_confirm_delete(function() {
        param = {
            "ID_BRANCH" : id,
        }
        url = base_url + "aclmaster/deletebranch"
        aclMaster.doDelete(url,param, aclMaster.getDataBranch)
    })
}

aclMaster.doDelete = function(url,param,callback) {
    viewModel.ajaxPost(url, param, function(res) {
            if (res.status) {
                swal_success(res.message)
                callback()
            } else {
                swal_error(res.message)
            }
        },function(err) {
            swal_success(err.responseText);
        })
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
            if (res.status) {
                swal_success("Data Saved")
                $("#modalBranch").modal("hide")
                aclMaster.getDataBranch()
            }else{
                swal_error(res.message)
            }
        }, function(err) {
            swal_success(err.responseText);

        })
    }
}

$(function() {
    aclMaster.getDataBranch()
})