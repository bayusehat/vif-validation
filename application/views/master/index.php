<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Master</h1>
	</div>
</div>
<!-- <div class="panel panel-default">
	<div class="panel-heading">Master</div>
	<div class="panel-body">
		<div class="col-md-12">
			<ul>
				<li>test 1</li>
				<li>test 1</li>
				<li>test 1</li>
				<li>test 1</li>
				<li>test 1</li>
				<li>test 1</li>
			</ul>
		</div>
	</div>
</div> -->

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
						<div id="gridBranch"></div>
					</div>
					<div class="tab-pane fade" id="tab2">
						<h4>Tab 2</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor.</p>
					</div>
					<div class="tab-pane fade" id="tab3">
						<h4>Tab 3</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor.</p>
					</div>
					<div class="tab-pane fade" id="tab4">
						<h4>Tab 4</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget rutrum purus. Donec hendrerit ante ac metus sagittis elementum. Mauris feugiat nisl sit amet neque luctus, a tincidunt odio auctor.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function getBranch() {
		viewModel.ajaxPost(base_url+"aclmaster/getdatabranch",{},function(res) {
			console.log(res);
		})
	}
	$(function() {
		getBranch();
	})
</script>
