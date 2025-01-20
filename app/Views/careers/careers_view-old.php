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
                                <div class="col-8">
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
                                <div class="col-4">
                                    <div class="d-flex justify-content-end mb-2">
                                        <a href="<?php echo site_url('/add-career') ?>" class="btn bg-orange mb-2">Add New Career</a>
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
                                            <th>JobTitle</th>
                                            <th>Applicants</th>
                                            <th>JobCategory</th>
                                            <th>JobExperience</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        if ($allCareerList): ?>
                                            <?php foreach ($allCareerList as $career): ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $career['job_Title']; ?></td>
                                                    <td><a href="<?php echo base_url('applicants/' . $career['job_IDPK'].'?&fdate='.$fdate.'&todate='.$todate); ?>"><?php echo ($CAREER->NofApplicants($career['job_IDPK'],['fdate'=>$fdate,'todate'=>$todate])); ?></td>
                                                    <td><?php echo $career['job_cat_name']; ?></td>
                                                    <td><?php echo $career['job_experience'] ?></td>
                                                    <td>
                                                        <a class="btn btn-sm" href="<?php echo base_url('edit-career/' . $career['job_IDPK']); ?>"><i class="fa-solid fa-pen"></i></a>

                                                        <?php
                                                        $isActive = $career['active_Id'];
                                                        $buttonClass = $isActive ? 'btn-outline-primary-career' : 'btn-outline-danger-career';
                                                        $buttonText = $isActive ? 'Activate' : 'Deactivate';
                                                        ?>
                                                        <a class="btn <?php echo $buttonClass; ?>" href="<?= base_url('deact-act-career/' . $career['job_IDPK']) ?>">
                                                            <?php echo $buttonText; ?>
                                                        </a>
                                                    </td>
                                                    <!-- <td><a class="btn btn-sm" href="http://localhost/HRPANEL/delete-career/<?php echo ($career['job_IDPK']) ?>"><i class="fa-solid fa-trash"></i></a></td> -->
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

    function datefilter()
    {
        var daterange = document.getElementById("reportrange").value;
        var temp1 = daterange.split('-').pop();
        var	dateString1 = temp1.replaceAll('/', "-");	
        var todateid = moment(dateString1).format('YYYY-MM-DD');	
        var temp2 = daterange.slice(0,10);
        var	dateString2 = temp2.replaceAll('/', "-");
        var fromdateid = moment(dateString2).format('YYYY-MM-DD'); 
        var currentdate = moment().format('YYYY-MM-DD');
        window.location.href = 'careers?fdate='+fromdateid+'&todate='+todateid;
    }
</script>
<?= $this->endSection() ?>