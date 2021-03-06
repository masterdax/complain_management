<script>
function getCities(stateId){
	$.ajax({
	  url: "<?php echo base_url('index.php/welcome/getCitiesByStateId') ?>",
	  method: "post",
	  data: {
		  'stateId':stateId
	  },
	  success: function(data) {
		var mydata = JSON.parse(data);
		if(mydata['status'] == 'success'){
			var mycity = "";
			for(var i=0;i< mydata['msg'].length;i++){
				mycity += '<option value="'+mydata['msg'][i]['id']+'">'+mydata['msg'][i]['name']+'</option>';
			}
			$("#cities").html(mycity);
			//cities
		}
	  },
	  error: function() {
		 
	  }
	});
}
function getSites(cityId){
	$.ajax({
	  url: "<?php echo base_url('index.php/welcome/getSitesByCityId') ?>",
	  method: "post",
	  data: {
		  'cityId':cityId
	  },
	  success: function(data) {
		var mydata = JSON.parse(data);
		if(mydata['status'] == 'success'){
			var mysite = "<option value=''>---Select---</option>";
			for(var i=0;i< mydata['msg'].length;i++){
				mysite += '<option value="'+mydata['msg'][i]['site_id']+'">'+mydata['msg'][i]['site_name']+'</option>';
			}
			$("#sites").html(mysite);
		
		}
	  },
	  error: function() {
		 
	  }
	});
}
function getTickets(siteId){
	
	$.ajax({
	  url: "<?php echo base_url('index.php/welcome/getTicketsBySiteId') ?>",
	  method: "post",
	  data: {
		  'siteId':siteId,
		  'route':'supervisor'
	  },
	  success: function(data) {
		var mydata = JSON.parse(data);
		if(mydata['status'] == 'success'){
			var myticket = "<option value=''>---Select---</option>";
			for(var i=0;i< mydata['msg'].length;i++){
				myticket += '<option value="'+mydata['msg'][i]['ticket_id']+'">'+mydata['msg'][i]['ticket_id']+'</option>';
			}
			$("#ticket").html(myticket);
		
		}
	  },
	  error: function() {
		 
	  }
	});
}

</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Area</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Area Master</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Allocate Site Technician For Complain</h3>
			  <?php
	if($this->session->flashdata('allocate_msg_tech')){
		?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('allocate_msg_tech'); ?></div>
		<?php 
	}
	if($this->session->flashdata('allocate_msg_error_tech')){
		?>
		<div class="alert alert-danger"><?php echo $this->session->flashdata('allocate_msg_error_tech'); ?></div>
		<?php
	}
	 
?>
		
			<?php if(validation_errors()) { ?>			
			<div class="alert alert-danger">
			<?php echo validation_errors();  ?>
			</div>	
			<?php
			} if(isset($status) && $status!="")  {
				?>
				<div class="alert alert-success"><?php echo $status; ?></div>
				<?php
			}
			?>		
	
	 

			  </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo base_url('index.php/welcome/add_allocate_technician'); ?>">
              <div class="box-body">
			  <div class="form-group">
                  <label  class="col-sm-2 control-label">State</label>
                  <div class="col-sm-10">
                    <select name="states" class="form-control" onchange="getCities(this.value);">
						<option value="">Select</option>
						<?php foreach($allStates as $states){
							?>
							<option value="<?php  echo $states['id']; ?>"><?php echo $states['name'];  ?></option>
							<?php
						} ?>
				   </select>
                  </div>
				  </div>
				   <div class="form-group">
                  <label  class="col-sm-2 control-label">city</label>
                  <div class="col-sm-10">
				   <select name="city" class="form-control" id="cities" onchange="getSites(this.value);">
						<option value="">Select</option>
				   </select>
                  </div>
                </div>
				  <div class="form-group">
                  <label  class="col-sm-2 control-label">Site</label>

                  <div class="col-sm-10">
				    <select name="site" class="form-control" id="sites" onchange="getTickets(this.value);">
					<option value="">Select</option>
				   </select>
                  </div>
                </div>
				  <div class="form-group">
                  <label  class="col-sm-2 control-label">TicketId #</label>
                  <div class="col-sm-10">
				  <!-- <input type="text" name="supervisor_name" class="form-control">-->
				  <select name="ticket_id" class="form-control" id="ticket">
					<option value="">Select</option>
				  </select>
                  </div>
				 
                </div>
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Technician Name</label>

                  <div class="col-sm-10"> 
				  <!-- <input type="text" name="qualification" class="form-control">-->
				  <select name="technician_id" class="form-control">
				  <?php foreach($allTechnicians as $technician){
							?>
							<option value="<?php  echo $technician['technician_id']; ?>"><?php echo $technician['technician_name'];  ?></option>
							<?php
						} ?>
				  </select>
                  </div>
                </div> 
                </div>
				
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Book</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        <!--/.col (right) -->

        </section>
     
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  