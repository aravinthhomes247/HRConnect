<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<?php

use App\Models\CareerModel;

$CAREER = new CareerModel();
?>

<style>
    a.btn.disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

<div class="applicant ms-4 mt-3">
    <div class="row ms-0 me-0 mt-3 pt-2">
        <div class="col col-lg-9 mt-1 pe-0 ps-3">
            <div class="row">
                <div class="col-auto ms-2">
                    <h4><?= $designation ?></h4>
                </div>
                <div class="col ms-2">
                    <span>Applicants <strong><?= $Tapplicants ?></strong></span>
                    <span>Unique <strong><?= count($applicants) ?></strong></span>
                </div>
            </div>
        </div>
        <div class="col col-lg-3 pe-0">
            <div class="action">
                <i class="fa-solid fa-calendar-days"></i>
                <?php
                if (empty($fdate)) {
                    $fdate = date("2020-01-01");
                }
                ?>
                <?php
                if (empty($todate)) {
                    $todate = date("Y-m-d");
                }
                ?>
                <input class="form-control" type="text" style="padding-left: 35px; box-sizing: border-box;" id="reportrange">
                <button class="btn btn-primary" style="margin-left: 10px;" onclick="datefilter()">Check</button>
            </div>
        </div>
    </div>
    <div class="row ms-1 me-1 mt-3 pt-2">
        <table class="table table-hover ms-2" id="dataTable">
            <thead class="table-secondary">
                <tr>
                    <td>S.No</td>
                    <td>Name</td>
                    <td>Mail</td>
                    <td>Mobile No</td>
                    <td>CTC</td>
                    <td>Resume</td>
                    <td>Applied On</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                if ($applicants): ?>
                    <?php foreach ($applicants as $applicant): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $applicant['candname']; ?></td>
                            <td>
                                <p><?php echo $applicant['candmail']; ?>
                                <p>
                            </td>
                            <td><?php echo $applicant['candnumber']; ?></td>
                            <td>₹ <?php echo $applicant['ctc']; ?></td>
                            <!-- <td><a href="https://superadmin.right2shout.in/images/resume/1733777079-inbound6036311708275517864.pdf" download="1733777079-inbound6036311708275517864.pdf" class="btn"><i class="fa-solid fa-file-arrow-down"></i> Download</a></td> -->
                            <?php
                                if ($applicant['pdf_file'] != NULL && !empty($applicant['pdf_file'])) {
                                    $PDFPATH = "https://superadmin.right2shout.in/images/resume/" . $applicant['pdf_file'];
                                    $style = "";
                                } else {
                                    $PDFPATH = "javascript:void(0);";
                                    $style = "disabled";
                                }
                            ?>
                            <td>
                                <a href="<?= $PDFPATH ?>" download="<?= $applicant['pdf_file'] ?? '' ?>" class="btn <?= $style ?>">
                                    <i class="fa-solid fa-file-arrow-down"></i> Download
                                </a>
                            </td>
                            <td>
                                <?php echo date("h:iA, m/d/y", strtotime($applicant['date_created'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#reportrange').daterangepicker({
            format: 'YYYY/MM/DD',
            locale: {
                format: 'YYYY/MM/DD'
            },
            startDate: '<?= date("Y/m/d", strtotime($fdate)) ?>',
            endDate: '<?= date("Y/m/d", strtotime($todate)) ?>',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
        }, function(start, end, label) {
            // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    function datefilter() {
        var daterange = document.getElementById("reportrange").value;
        var temp1 = daterange.split('-').pop();
        var dateString1 = temp1.replaceAll('/', "-");
        var todateid = moment(dateString1).format('YYYY-MM-DD');
        var temp2 = daterange.slice(0, 10);
        var dateString2 = temp2.replaceAll('/', "-");
        var fromdateid = moment(dateString2).format('YYYY-MM-DD');
        var currentdate = moment().format('YYYY-MM-DD');
        var id = <?= $designation_id ?>;
        window.location.href = id + '?fdate=' + fromdateid + '&todate=' + todateid;
    }
</script>


<?= $this->endSection() ?>