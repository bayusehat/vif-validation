aclMaster = {}
viewModel.aclMaster = aclMaster

aclMaster.dataBranch = ko.observableArray([]);

aclMaster.newBranch = function() {
    return {
        ID_BRANCH: "",
        BRANCH_TITLE: "",
        BRANCH_LOCATION: "",
        ENABLE_BRANCH: 1,
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
                swal_failed(res.message)
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
                swal_failed(res.message)
            }
        }, function(err) {
            swal_failed(err.responseText);

        })
    }
}

aclMaster.dataGroups = ko.observableArray([])
aclMaster.newGroups = function() {
    return {
        GROUP_ID: "",
        GROUP_TITLE: "",
        ENABLE_GROUP: 1,
        GROUP_INDEX: 0,
    }
}
aclMaster.fGroups = ko.mapping.fromJS(aclMaster.newGroups())
aclMaster.groupBranch = ko.observableArray([])

aclMaster.getDataGroups = function() {
    viewModel.ajaxPost(base_url + "aclmaster/getdatagroups", {}, function(res) {
        aclMaster.generateGroups(res);
        aclMaster.dataGroups(res)
    })
}

aclMaster.generateGroups = function(jsonData) {
    tmp = function(title) {
        return "<span class='tmp-title' >"+title+"</span>"
    }
    columns = [{
            title: "Group Id",
            field: "GROUP_ID",
            width: 20,

        },
        {
            title: "Group Name",
            field: "GROUP_TITLE",
            width: 20,
        },
        {
            title: "Group Status",
            field: "ENABLE_GROUP",
            width: 20,
            template: function(e) {
                return e.ENABLE_GROUP == 1 ? "ENABLED" : "DISABLED"
            }
        },
        {
            title: "Group Branch",
            field: "BRANCH_TITLE",
            width: 20,
            template: function(e) {
                arr = []
                e.BRANCH_TITLE.forEach(val => {
                    arr.push(tmp(val))
                });
                return arr.join("&nbsp;&nbsp;")
            }
        },
        {
            title : "Action",
            width : 15,
            headerAttributes: { style: "text-align: center;" },
            attributes: { style: "text-align: center;" },
            template : function(e) {
                return  '<a class="btn btn-primary btn-sm btn-action" href="javascript:aclMaster.editGroups(this,'+e.GROUP_ID+',\''+e.uid+'\')">Edit</a>' + 
                        '<a class="btn btn-danger btn-sm btn-action" href="javascript:aclMaster.deleteGroups(this,'+e.GROUP_ID+',\''+e.uid+'\')">Delete</a>'
            }
        }
    ]
    $('#gridGroup').kendoGrid({
        dataSource: {
            data: jsonData,
        },
        sortable: true,
        filterable: false,
        scrollable: true,
        columns: columns,
    })
}

aclMaster.addGroups = function() {
    ko.mapping.fromJS(aclMaster.newGroups(), aclMaster.fGroups)
    aclMaster.groupBranch([])
    $("#modalGroups").modal("show")
}

aclMaster.editGroups = function(e,id,uid) {
    dt = _.find(aclMaster.dataGroups(), function(e) {
        return e.GROUP_ID == id
    })
    dtjs = aclMaster.newGroups()
    dtjs.GROUP_ID = dt.GROUP_ID
    dtjs.GROUP_TITLE = dt.GROUP_TITLE
    dtjs.ENABLE_GROUP = dt.ENABLE_GROUP
    dtjs.GROUP_INDEX = dt.GROUP_INDEX
    ko.mapping.fromJS(dtjs, aclMaster.fGroups)
    aclMaster.groupBranch(dt.ID_BRANCH)
    $("#modalGroups").modal("show")
    // console.log("IB BRANCH SELECTED", dt.ID_BRANCH);
    // console.log({"e":e, "id":id, "uid":uid});
}

aclMaster.saveGroups = function() {
    param = {
        data : ko.mapping.toJS(aclMaster.fGroups),
        data_join : aclMaster.groupBranch()
    }

    if (aclMaster.validateForm("#modalGroups")) {
        // console.log(param);
        viewModel.ajaxPost(base_url + "aclmaster/savegroups", param, function(res) {
            if (res.status) {
                swal_success("Data Saved")
                $("#modalGroups").modal("hide")
                aclMaster.getDataGroups()
            }else{
                swal_failed(res.message)
            }
        }, function(err) {
            swal_failed(err.responseText);

        })
    }
    
    
}

aclMaster.deleteGroups = function(e,id,uid) {
    swal_confirm_delete(function() {
        param = {
            "GROUP_ID" : id,
        }
        url = base_url + "aclmaster/deletegroups"
        aclMaster.doDelete(url,param, aclMaster.getDataGroups)
    })
}

aclMaster.manageAccess = function(e,id,uid) {
    
}

aclMaster.newAccess = function() {
    return {
        ACCESS_ID : "",
        ACCESS_TITLE : "",
        ACCESS_ICON : "home",
        ACCESS_URL : "#",
        ACCESS_INDEX : 0,
        PARENT_ID : "",
        ENABLE_ACCESS : 1,
    }
}

aclMaster.fAccess = ko.mapping.fromJS(aclMaster.newAccess())

aclMaster.addAccess = function() {
    ko.mapping.fromJS(aclMaster.newAccess(), aclMaster.fAccess)
    $("#modalAccess").modal("show")
}

$(function() {
    // $(".modal").attr("data-backdrop","static")
    // $(".modal").attr("data-keyboard",false)
    aclMaster.getDataBranch()
    aclMaster.getDataGroups()
})