<script src="<?= base_url();?>assets/main/js/acl_master.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Master</h1>
    </div>
</div>
<style type="text/css">
    /*.collapse-wrapper{
		width: 95%;
		background-color: #fff;
	}
	.collapse-head{
		background-color:  #30a5ff;
	}
	.btn.no-border-radius{
		border-radius: 0;
	}*/
    .mgb-10 {
        margin-bottom: 10px;
    }

    input.width-ddl {
        width: 100% !important;
    }
</style>

<!-- <div class="collapse-wrapper"> <div class="collapse-head"> <button
class="btn btn-sm no-border-radius" data-toggle="collapse"
data-target="#test-collapse"><i class="fa fa-align-justify"></i></button> </div>
<div class="collapse show" id="test-collapse"> CONTEN </div> </div> -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab" aria-expanded="true">Brach</a>
                    </li>
                    <li class="">
                        <a href="#tab2" data-toggle="tab" aria-expanded="false">Groups</a>
                    </li>
                    <li class="">
                        <a href="#tab3" data-toggle="tab" aria-expanded="false">Access</a>
                    </li>
                    <li class="">
                        <a href="#tab4" data-toggle="tab" aria-expanded="false">Users</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab1">
                        <div class="row">
                            <div class="col-md-12 mgb-10">
                                <button
                                    class="btn btn-sm btn-success pull-right"
                                    onclick="aclMaster.addBranch()">Add Branch</button>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-grid" id="gridBranch"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <div class="row">
                            <div class="col-md-12 mgb-10">
                                <button
                                    class="btn btn-sm btn-success pull-right"
                                    onclick="aclMaster.addGroups()">Add Group</button>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-grid" id="gridGroup"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3">
                        <div class="row">
                            <div class="col-md-12 mgb-10">
                                <button
                                    onclick="aclMaster.addAccess()"
                                    class="btn btn-sm btn-success pull-right">Add Access</button>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-grid" id="listAccess"></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4">
                        <div class="row">
                            <div class="col-md-12 mgb-10">
                                <button onclick="aclMaster.addUser()" 
                                        class="btn btn-sm btn-success pull-right">Add User</button>
                            </div>
                            <div class="col-md-12">
                                <div class="custom-grid" id="gridUser"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div
    id="modalBranch"
    class="modal fade"
    role="dialog"
    data-bind="with:aclMaster"
    data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Branch</h4>
            </div>
            <div class="modal-body" data-bind="with:fBranch">
                <div class="row">
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="brach_title">Branch Name</label>
                            <div class="col-sm-8">
                                <input
                                    type="text"
                                    name="Branch Name"
                                    class="form-control input-form"
                                    placeholder="Branch Name"
                                    required="required"
                                    id="brach_title"
                                    data-bind="value: BRANCH_TITLE">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="brach_location">Branch Location</label>
                            <div class="col-sm-8">
                                <input
                                    type="text"
                                    name="Branch Location"
                                    class="form-control input-form"
                                    placeholder="Branch Location"
                                    required="required"
                                    id="brach_location"
                                    data-bind="value: BRANCH_LOCATION">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="enable_branch">Branch Status</label>
                            <div class="col-sm-8">
                                <input
                                    name="Branch Status"
                                    style="width:100%"
                                    class="form-control input-form"
                                    id="enable_branch"
                                    required="required"
                                    data-bind="kendoDropDownList: { data: viewModel.ddlStatus, dataTextField : 'text', dataValueField : 'value' , value: ENABLE_BRANCH }">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" data-bind="click: aclMaster.saveBranch">Sumbit</button>
                <!-- <button type="button" class="btn btn-default"
                data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>

<div
    id="modalGroups"
    class="modal fade"
    role="dialog"
    data-bind="with:aclMaster"
    data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Groups</h4>
            </div>
            <div class="modal-body" data-bind="with:fGroups">
                <div class="row">
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="group_title">Groups Name</label>
                            <div class="col-sm-8">
                                <input
                                    type="text"
                                    name="Groups Name"
                                    class="form-control input-form"
                                    placeholder="Groups Name"
                                    required="required"
                                    id="group_title"
                                    data-bind="value: GROUP_TITLE">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="group_branch">Groups Branch</label>
                            <div class="col-sm-8">
                                <select
                                    name="Groups Branch"
                                    style="width:100%"
                                    class="form-control input-form"
                                    id="group_branch"
                                    data-bind="kendoMultiSelect: { data: aclMaster.dataBranch, dataTextField : 'BRANCH_TITLE', dataValueField : 'ID_BRANCH' , value: aclMaster.groupBranch }"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="enable_Groups">Groups Status</label>
                            <div class="col-sm-8">
                                <input
                                    name="Groups Status"
                                    style="width:100%"
                                    class="form-control input-form"
                                    id="enable_Groups"
                                    required="required"
                                    data-bind="kendoDropDownList: { data: viewModel.ddlStatus, dataTextField : 'text', dataValueField : 'value' , value: ENABLE_GROUP }">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="groups_index">Groups Index</label>
                            <div class="col-sm-8">
                                <input
                                    name="Groups Index"
                                    style="width:100%"
                                    class="form-control input-form"
                                    id="groups_index"
                                    required="required"
                                    data-bind="kendoNumericTextBox: { min: 0 , value: GROUP_INDEX, spinners : false, decimals: 0 }">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" data-bind="click: aclMaster.saveGroups">Sumbit</button>
                <!-- <button type="button" class="btn btn-default"
                data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>

<div
    id="modalAccess"
    class="modal fade"
    role="dialog"
    data-bind="with:aclMaster"
    data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Access</h4>
            </div>
            <div class="modal-body" data-bind="with:fAccess">
                <div class="row">
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="group_title">Access Name</label>
                            <div class="col-sm-8">
                                <input
                                    type="text"
                                    name="Access Name"
                                    class="form-control input-form"
                                    placeholder="Access Name"
                                    required="required"
                                    id="group_title"
                                    data-bind="value: ACCESS_TITLE">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="enable_Access">Access Parent</label>
                            <div class="col-sm-8">
                                <input
                                    name="Access Parent"
                                    style="width:100%"
                                    class="form-control input-form"
                                    id="enable_Access"
                                    data-bind="kendoDropDownList: { data: aclMaster.dataAccess, dataTextField : 'ACCESS_TITLE', dataValueField : 'ACCESS_ID' , value: PARENT_ID, optionLabel: 'Top Level' }">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="access_icon">Access Icon</label>
                            <div class="col-sm-8">
                                <input
                                    type="text"
                                    name="Access Icon"
                                    class="form-control input-form"
                                    placeholder="home"
                                    id="access_icon"
                                    data-bind="value: ACCESS_ICON">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="access_url">Access Url</label>
                            <div class="col-sm-8">
                                <input
                                    type="text"
                                    name="Access Url"
                                    class="form-control input-form"
                                    placeholder="#"
                                    id="access_url"
                                    data-bind="value: ACCESS_URL">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="enable_Access">Access Status</label>
                            <div class="col-sm-8">
                                <input
                                    name="Access Status"
                                    style="width:100%"
                                    class="form-control input-form"
                                    id="enable_Access"
                                    required="required"
                                    data-bind="kendoDropDownList: { data: viewModel.ddlStatus, dataTextField : 'text', dataValueField : 'value' , value: ENABLE_ACCESS }">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Access_index">Access Index</label>
                            <div class="col-sm-8">
                                <input
                                    name="Access Index"
                                    style="width:100%"
                                    class="form-control input-form"
                                    id="Access_index"
                                    required="required"
                                    data-bind="kendoNumericTextBox: { min: 0 , value: ACCESS_INDEX, spinners : false, decimals: 0 }">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" data-bind="click: aclMaster.saveAccess">Sumbit</button>
                <!-- <button type="button" class="btn btn-default"
                data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>

<div
    id="modalManageAccess"
    class="modal fade"
    role="dialog"
    data-bind="with:aclMaster"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Access</h4>
            </div>
            <div class="modal-body">
                <div class="row">
									<div class="custom-grid" id="listManageAccess"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" data-bind="click: aclMaster.saveAccessGroups">Sumbit</button>
                <!-- <button type="button" class="btn btn-default"
                data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>

<div
    id="modalUser"
    class="modal fade"
    role="dialog"
    data-bind="with:aclMaster"
    data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">User</h4>
            </div>
            <div class="modal-body" data-bind="with:fUser">
                <div class="row">
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="group_title">Employee</label>
                            <div class="col-sm-8">
                                <input
                                    style="width:100%"
                                    type="text"
                                    name="Employee"
                                    class="form-control input-form"
                                    placeholder="Employee"
                                    required="required"
                                    id="group_title"
                                    data-bind="kendoDropDownList: { data: aclMaster.dataEmployee, dataTextField : 'NAME', dataValueField : 'EMPLOOYEEID' , value: EMPLOOYEEID, optionLabel: 'Select Employee' }">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="enable_Access">Enable User</label>
                            <div class="col-sm-8">
                                <input
                                    name="Access Status"
                                    style="width:100%"
                                    class="form-control input-form"
                                    id="enable_Access"
                                    required="required"
                                    data-bind="kendoDropDownList: { data: viewModel.ddlStatus, dataTextField : 'text', dataValueField : 'value' , value: ENABLE_USER }">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mgb-10">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="enable_Access">User Groups</label>
                            <div class="col-sm-8">
                                <button class="btn btn-sm btn-primary"  onclick="aclMaster.addUserGroups()">Add Group</button>
                            </div>
                            <div class="col-sm-12" style="margin-top:8px;">
                                <div class="custom-grid" id="gridUserGroups"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" data-bind="click: aclMaster.saveUser">Sumbit</button>
                <!-- <button type="button" class="btn btn-default"
                data-dismiss="modal">Close</button> -->
            </div>
        </div>

    </div>
</div>