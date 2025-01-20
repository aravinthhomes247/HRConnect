<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header") ?>

<?= $this->section("body") ?>
<style>
    .activeclass {
        background-color: #0b3544 !important;
        border-color: #0b3544 !important;
        background-image: none;
    }
</style>

<?php
  use App\Models\CareerModel;
  $CAREER = new CareerModel();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="card-title">Applicants(<span id="Tot-App"><?= $Tapplicants ?></span>) Unique(<span id="Tot-Uniq"><?= count($applicants) ?></span>)</h3>
                                </div>
                                <div class="col-3">
                                    <!-- <div class="d-flex justify-content-end mb-2">
                                        <a href="<?php echo site_url('/add-career') ?>" class="btn bg-orange mb-2">Add New Career</a>
                                    </div> -->
                                    <div class="d-flex justify-content ">
                                        <div class="form-group mt-1">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control form-control-sm float-right" id="reportrange">
                                                <?php
                                                if (empty($fdate)) {
                                                    $fdate = date("2020-01-01");
                                                }
                                                ?>
                                                <input type="hidden" name="fdate" id="fdate" value="<?= $fdate ?>" />
                                                <?php
                                                if (empty($todate)) {
                                                    $todate = date("Y-m-d");
                                                }
                                                ?>
                                                <input type="hidden" name="todate" id="todate" value="<?= $todate ?>" />
                                                <a class="btn btn-sm bg-orange" onclick="datefilter()">Check</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Name</th>
                                        <th>Mail</th>
                                        <th>Number</th>
                                        <th>CTC</th>
                                        <!-- <th>Comments</th> -->
                                        <th>Designation</th>
                                        <th>Applied On</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    if ($applicants): ?>
                                        <?php foreach ($applicants as $applicant): ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $applicant['candname']; ?></td>
                                                <td><?php echo $applicant['candmail']; ?></td>
                                                <td><?php echo $applicant['candnumber']; ?></td>
                                                <td><?php echo $applicant['ctc']; ?></td>
                                                <!-- <td><?php echo $applicant['comments']; ?></td> -->
                                                <td><?php echo $applicant['designation']; ?></td>
                                                <td><?php echo $applicant['date_created']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>


<script>
    $(document).ready(function() {
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('a.bg-orange ').filter(function() {
            return this.href == url;
        }).addClass('activeclass');

    })
</script>


<script>
    $(document).ready(function() {

        $('.Search').change(function() {
            if ($("#examp1 > tbody > tr > td").length == 1) {
                $('#count').empty();
                $('#count').append('0');;
            } else {
                $('#count').empty();
                $('#count').append(' ' + $("#examp1 > tbody > tr").length);
            }
        });
    });
</script>
<?= $this->endSection() ?>