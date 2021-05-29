<?php $this->load->view('template/header.php');    ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php $this->load->view('template/navigation.php') ?>
    <?php $this->load->view('template/sidebar.php');    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Directory</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)" class="btn btn-primary add_candidate_form">Add Directory</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>





      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Search Form</h3>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="" method="POST" id="searchDistributorForm">
            <div class="row">

              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Name</label>
                <select name="first_name" class="form-control f_name" id="f_name">
                  <option value="">--Select Any One--</option>
                  <?php foreach (array_unique($first_name) as $key => $value) { ?>
                    <option value="<?php echo $value ?>"><?php echo $value;  ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Telephone No</label>
                <select name="mobile_no" class="form-control mobile_no" id="mobile_no">
                  <option value="">--Select Any One--</option>
                  <?php foreach (array_unique($mobile_no) as $key => $value) { ?>
                    <option value="<?php echo $value ?>"><?php echo $value;  ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputEmail1">&nbsp;</label>
                <label for="exampleInputEmail1">&nbsp;</label>
                <label for="exampleInputEmail1">&nbsp;</label>
                <input type="submit" class=" btn btn-primary" />
              </div>
            </div>

          </form>
        </div>
        <!-- /.card-body -->

        <!-- /.card-footer -->
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Directory Listings</h3>
          <div class="card-tools">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->

          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <div id="directory_data">

          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->

          <div id="addDirectoryModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"> User Info</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div id="modalData"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
</body>

<?php $this->load->view('template/footer.php');    ?>
<script src="<?php echo base_url() ?>assets/js/custom.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.mobile_no, .f_name').select2();
    var formData = $('#searchDistributorForm').serialize();
    getAllDirectoryInfo(formData)

  })
  $('body').on('submit', '#searchDistributorForm', function(e) {
    e.preventDefault();
    var formData = $('#searchDistributorForm').serialize();
    console.log(formData);
    getAllDirectoryInfo(formData)
  })
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>