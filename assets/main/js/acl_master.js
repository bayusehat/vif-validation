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
    columns.push({
        title : "Access",
        width : 15,
        headerAttributes: { style: "text-align: center;" },
        attributes: { style: "text-align: center;" },
        template : function(e) {
            return  '<a style="width: fit-content" class="btn btn-primary btn-sm btn-action" href="javascript:aclMaster.manageAccess(this,'+e.GROUP_ID+',\''+e.uid+'\')">Manage Access</a>'
        }
    })
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

aclMaster.selectedGroupIdForManageAccess = ""
aclMaster.manageAccess = function(e,id,uid) {
    aclMaster.selectedGroupIdForManageAccess = id
    viewModel.ajaxPost(base_url + "aclmaster/getdatamanageaccess", {GROUP_ID:id}, function(res) {
        aclMaster.generateManageAccess(res);
    })
    $("#modalManageAccess").modal("show")
}

aclMaster.generateManageAccess = function(dataJson) {
    column = [
        {
            field: "ACCESS_TITLE",
            title: "Menu",
            width: 200,
            headerAttributes: { style: "text-align: center;" },
            // attributes: { style: "text-align: left;" },
        },
        {
            title: "View",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                checked = e.DO_VIEW ? "checked" : ""
                return "<input name='DO_VIEW' type='checkbox' " + checked + ">"
            },
            attributes: { style: "text-align: center;" }
        }, 
        {
            title: "Create",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                checked = e.DO_ADD ? "checked" : ""
                return "<input name='DO_ADD' type='checkbox' " + checked + ">"
            },
            attributes: { style: "text-align: center;" }
        }, 
        {
            title: "Edit",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                checked = e.DO_EDIT ? "checked" : ""
                return "<input name='DO_EDIT' type='checkbox' " + checked + ">"
            },
            attributes: { style: "text-align: center;" }
        }, 
        {
            title: "Delete",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                checked = e.DO_DELETE ? "checked" : ""
                return "<input name='DO_DELETE' type='checkbox' " + checked + ">"
            },
            attributes: { style: "text-align: center;" }
        }, 
        {
            title: "Approve",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                checked = e.DO_APPROVE ? "checked" : ""
                return "<input name='DO_APPROVE' type='checkbox' " + checked + ">"
            },
            attributes: { style: "text-align: center;" }
        }, 
        {
            title: "Payment",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                checked = e.DO_PAYMENT ? "checked" : ""
                return "<input name='DO_PAYMENT' type='checkbox' " + checked + ">"
            },
            attributes: { style: "text-align: center;" }
        }, 
    ]

    $("#listManageAccess").html("")
    $("#listManageAccess").kendoTreeList({
        dataSource: dataJson,
        columns: column,
        dataBound :function(e) {
            var treeList = e.sender;
            var rows = $("tr.k-treelist-group", treeList.tbody);
            $.each(rows, function(idx, row) {
                treeList.expand(row);
            });
        }
    });
    
}

aclMaster.saveAccessGroups = function() {
    // ManageAccessForGroups
    param = {
        data : aclMaster.processDataManageAcccess(),
    }

    // if (aclMaster.validateForm("#modalGroups")) {
        // console.log(param);
        viewModel.ajaxPost(base_url + "aclmaster/manageaccessforgroups", param, function(res) {
            if (res.status) {
                swal_success(res.message)
                // $("#modalGroups").modal("hide")
                // aclMaster.getDataGroups()
            }else{
                swal_failed(res.message)
            }
        }, function(err) {
            swal_failed(err.responseText);

        })
    // }
}

aclMaster.processDataManageAcccess = function() {
    dataAccess = []
    listData = $("#listManageAccess").data("kendoTreeList").dataSource.data()
    _.forEach(listData, function(vData,kData) {
        access = {}
        access["GROUP_ID"] = aclMaster.selectedGroupIdForManageAccess
        access["ACCESS_ID"] = vData["ACCESS_ID"]
        myInput = $("#listManageAccess").data("kendoTreeList").tbody.find("tr[data-uid='" + vData["uid"] + "'] input");
        _.forEach(myInput, function(vInput,kInput){
            access[$(vInput).attr("name")] = $(vInput).is(":checked") ? 1 : 0;
        })

        dataAccess.push(access)
    })

    return dataAccess
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
aclMaster.dataAccess = ko.observableArray([])

aclMaster.addAccess = function() {
    ko.mapping.fromJS(aclMaster.newAccess(), aclMaster.fAccess)
    $("#modalAccess").modal("show")
}

aclMaster.getDataAccess = function() {
    // console.log("GET DATA ACCESS");
    
    viewModel.ajaxPost(base_url + "aclmaster/getdataaccess", {}, function(res) {
        aclMaster.dataAccess(res)
        aclMaster.generateAccess(res);
    })
}

aclMaster.generateAccess = function(dataJson) {
    column = [
        {
            field: "ACCESS_TITLE",
            title: "Menu",
            width: 200,
            headerAttributes: { style: "text-align: center;" },
            // attributes: { style: "text-align: left;" },
        },
        /*{
            field: "view",
            title: "View",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                var check = CheckAction(e, "view")
                return "<input onclick='role.checkView(\"check-value-view-par-" + e.id + "\");' parId='check-value-view-par-" + e.parentId + "' id='check-value-view-par-" + e.id + "' class='rolecheck-value-view' type='checkbox' " + check.checked + " " + check.disabled + ">"
            },
            attributes: { style: "text-align: center;" }
        },
        {
            field: "add",
            title: "Add",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                var check = CheckAction(e, "add")
                return "<input onclick='role.checkAdd(\"check-value-add-par-" + e.id + "\");' parId='check-value-add-par-" + e.parentId + "' id='check-value-add-par-" + e.id + "' class='rolecheck-value-add' type='checkbox' " + check.checked + " " + check.disabled + ">"
            },
            attributes: { style: "text-align: center;" }
        },
        {
            field: "edit",
            title: "Edit",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                var check = CheckAction(e, "edit")
                return "<input onclick='role.checkEdit(\"check-value-edit-par-" + e.id + "\");' parId='check-value-edit-par-" + e.parentId + "' id='check-value-edit-par-" + e.id + "' class='rolecheck-value-edit' type='checkbox' " + check.checked + " " + check.disabled + ">"
            },
            attributes: { style: "text-align: center;" }
        },
        {
            field: "del",
            title: "Delete",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                var check = CheckAction(e, "del")
                return "<input onclick='role.checkDelete(\"check-value-del-par-" + e.id + "\");' parId='check-value-del-par-" + e.parentId + "' id='check-value-del-par-" + e.id + "' class='rolecheck-value-del' type='checkbox' " + check.checked + " " + check.disabled + ">"
            },
            attributes: { style: "text-align: center;" }
        }, {
            field: "request",
            title: "Request Approval",
            width: 80,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                var check = CheckAction(e, "request")
                return "<input onclick='role.checkRequest(\"check-value-request-par-" + e.id + "\");' parId='check-value-request-par-" + e.parentId + "' id='check-value-request-par-" + e.id + "' class='rolecheck-value-request' type='checkbox' " + check.checked + " " + check.disabled + ">"
            },
            attributes: { style: "text-align: center;" }
        },
        {
            field: "approve",
            title: "Approve",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                var check = CheckAction(e, "approve")
                return "<input onclick='role.checkApprove(\"check-value-approve-par-" + e.id + "\");' parId='check-value-approve-par-" + e.parentId + "' id='check-value-approve-par-" + e.id + "' class='rolecheck-value-approve' type='checkbox' " + check.checked + " " + check.disabled + ">"
            },
            attributes: { style: "text-align: center;" }
        }, {
            field: "download",
            title: "Download/Print",
            width: 80,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                var check = CheckAction(e, "download")
                return "<input onclick='role.checkDownload(\"check-value-download-par-" + e.id + "\");' parId='check-value-download-par-" + e.parentId + "' id='check-value-download-par-" + e.id + "' class='rolecheck-value-download' type='checkbox' " + check.checked + " " + check.disabled + ">"
            },
            attributes: { style: "text-align: center;" }
        },
        {
            field: "upload",
            title: "Upload",
            width: 60,
            headerAttributes: { style: "text-align: center;" },
            template: function(e) {
                var check = CheckAction(e, "upload")
                return "<input onclick='role.checkUpload(\"check-value-upload-par-" + e.id + "\");' parId='check-value-upload-par-" + e.parentId + "' id='check-value-upload-par-" + e.id + "' class='rolecheck-value-upload' type='checkbox' " + check.checked + " " + check.disabled + ">"
            },
            attributes: { style: "text-align: center;" }
        }*/
    ]
    column.push(
        {
            title : "Action",
            width : 40,
            headerAttributes: { style: "text-align: center;" },
            attributes: { style: "text-align: center;" },
            template : function(e) {
                btnDelete = ""
                hrefDelete = "javascript:void(0)"
                disableDelete = "disabled"
                if (!_.find(aclMaster.dataAccess(),function(f) {return f.PARENT_ID == e.ACCESS_ID })) {
                    hrefDelete = 'javascript:aclMaster.deleteAccess(this,'+e.ACCESS_ID+',\''+e.uid+'\')'
                    disableDelete = ""
                }
                if (true) {
                    btnDelete = '<a class="btn btn-danger btn-sm btn-action" href="'+hrefDelete+'" '+disableDelete+'>Delete</a>'
                }
                return  '<a class="btn btn-primary btn-sm btn-action" href="javascript:aclMaster.editAccess(this,'+e.ACCESS_ID+',\''+e.uid+'\')">Edit</a>' + 
                        btnDelete
            }
        }
    )
    $("#listAccess").html("")
    $("#listAccess").kendoTreeList({
        // height: 350,
        dataSource: dataJson,
        // schema: {
        //     model: {
        //         id: "id",
        //         parentId: "parentId",
        //         fields: {
        //             parentId: { field: "PARENT_ID",  nullable: true },
        //             id: { field: "ACCESS_ID", type: "number" },
        //         },
        //         expanded: true
        //     }
        // },
        columns: column,
        dataBound :function(e) {
            // console.log("E", e);
            var treeList = e.sender;
            var rows = $("tr.k-treelist-group", treeList.tbody);
            $.each(rows, function(idx, row) {
                treeList.expand(row);
            });
        }
    });

    // setTimeout(function() {
    //     $("#listAccess").data("kendoTreeList").refresh();
    //     var treeList = $("#listAccess").data("kendoTreeList");
    //     var rows = $("tr.k-treelist-group", treeList.tbody);
    //     $.each(rows, function(idx, row) {
    //         treeList.expand(row);
    //     });
    // }, 500);
}

aclMaster.editAccess = function(e,id,uid) {
    dt = _.find(aclMaster.dataAccess(), function(e) {
        return e.ACCESS_ID == id
    })
    delete dt.id
    delete dt.parentId
    ko.mapping.fromJS(dt, aclMaster.fAccess)
    $("#modalAccess").modal("show")
}

aclMaster.saveAccess = function() {
    dt = ko.mapping.toJS(aclMaster.fAccess)
    dt.PARENT_ID = dt.PARENT_ID == "" ? null : dt.PARENT_ID
    dt.ACCESS_ICON = dt.ACCESS_ICON == "" ? "home" : dt.ACCESS_ICON
    dt.ACCESS_URL = dt.ACCESS_URL == "" ? "#" : dt.ACCESS_URL
    param = {
        data : dt
    }

    if (aclMaster.validateForm("#modalAccess")) {
        // console.log(param);
        viewModel.ajaxPost(base_url + "aclmaster/saveaccess", param, function(res) {
            if (res.status) {
                swal_success("Data Saved")
                $("#modalAccess").modal("hide")
                aclMaster.getDataAccess()
            }else{
                swal_failed(res.message)
            }
        }, function(err) {
            swal_failed(err.responseText);
        })
    }
}

aclMaster.deleteAccess = function(e,id,uid) {
    swal_confirm_delete(function() {
        param = {
            "ACCESS_ID" : id,
        }
        url = base_url + "aclmaster/deleteaccess"
        aclMaster.doDelete(url,param, aclMaster.getDataAccess)
    })
}

$(function() {
    // $(".modal").attr("data-backdrop","static")
    // $(".modal").attr("data-keyboard",false)
    aclMaster.getDataBranch()
    aclMaster.getDataGroups()
    aclMaster.getDataAccess()
})