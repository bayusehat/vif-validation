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
	.mgb-10{
		margin-bottom: 10px
	}

</style>

<!-- <div class="collapse-wrapper">
	<div class="collapse-head">
		<button class="btn btn-sm no-border-radius" data-toggle="collapse" data-target="#test-collapse"><i class="fa fa-align-justify"></i></button>
	</div>
	<div class="collapse show" id="test-collapse">
		CONTEN
	</div>
</div> -->

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body tabs">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Brach</a></li>
					<li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Groups</a></li>
					<li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false">Access</a></li>
					<li class=""><a href="#tab4" data-toggle="tab" aria-expanded="false">Users</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="tab1">
						<div class="row">
							<div class="col-md-12 mgb-10">
								<button class="btn btn-sm btn-success pull-right">Add Branch</button>
							</div>
							<div class="col-md-12">
								<div class="custom-grid" id="gridBranch"></div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="tab2">
						<div class="row">
							<div class="col-md-12 mgb-10">
								<button class="btn btn-sm btn-success pull-right">Add Group</button>
							</div>
							<div class="col-md-12">
								<div class="custom-grid" id="gridGroup"></div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="tab3">
						<div class="row">
							<div class="col-md-12 mgb-10">
								<button class="btn btn-sm btn-success pull-right">Add Access</button>
							</div>
							<div class="col-md-12">
								<div class="custom-grid" id="gridAccess"></div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="tab4">
						<div class="row">
							<div class="col-md-12 mgb-10">
								<button class="btn btn-sm btn-success pull-right">Add User</button>
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

<div id="modalBranch" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Branch</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
