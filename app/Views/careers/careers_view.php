<?php $session = \Config\Services::session(); ?>
<?php echo ($this->extend("layouts/header-new")) ?>
<?php echo ($this->section("body")) ?>


<style>
    .career .action-dropdown {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: max-content;
        /* padding: 5px 5px; */
    }

    .career .action-dropdown a {
        color: #8146D4 !important;
        display: block;
        /* color: black !important; */
        /* text-decoration: none !important; */
        width: 100% !important;
        padding: 5px 10px !important;
    }

    .career .action-dropdown a:hover {
        background-color: #F0E5FF;
    }
</style>

<?php
    use App\Models\CareerModel;
    $CAREER = new CareerModel();
?>


<div class="career ms-4 mt-1">
    <div class="row ms-0 me-0 pt-2">
        <div class="col col-lg-8 ps-4 mt-1">
            <a href="<?php echo site_url('/add-career') ?>"><i class="fa-solid fa-plus"></i> Add New Career</a>
        </div>
        <div class="col col-lg-4 ps-5">
            <div class="action ms-5">
                <i class="fa-solid fa-calendar-days"></i>
                <input class="form-control" type="text" style="padding-left: 35px; box-sizing: border-box;" id="reportrange">
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
                <input type="hidden" name="todate" id="todate" value="<?= $todate ?>"/>
                <button class="btn btn-primary" style="margin-left: 10px;" onclick="datefilter()">Check</button>
            </div>
        </div>
    </div>
    <div class="row ms-1 me-1 pt-2">
        <table class="table table-hover ms-2" id="dataTable">
            <thead class="table-secondary">
                <tr>
                    <td>S.No</td>
                    <td>Job Title</td>
                    <td>Applicants</td>
                    <td>Job Category</td>
                    <td>Experience</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                if ($allCareerList): ?>
                    <?php foreach ($allCareerList as $career): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $career['job_Title']; ?></td>
                            <td><a href="<?php echo base_url('applicants/' . $career['job_IDPK'] . '?&fdate=' . $fdate . '&todate=' . $todate); ?>"><?php echo ($CAREER->NofApplicants($career['job_IDPK'], ['fdate' => $fdate, 'todate' => $todate])); ?></a></td>
                            <td><?php echo $career['job_cat_name']; ?></td>
                            <td><?php echo $career['Options'] ?></td>
                            <?php
                            $isActive = $career['active_Id'];
                            $buttonClass = $isActive ? 'color: #029008;' : 'color: #F3120A;';
                            $statusText = $isActive ? 'Enabled' : 'Disabled';
                            $buttonText = $isActive ? 'Disable' : 'Enable';
                            ?>
                            <td style="<?= $buttonClass ?>"><?= $statusText ?></td>
                            <td>
                                <a href="javascript:void(0);" class="menu-trigger">
                                    <img src="<?= base_url('public/images/img/Group.png'); ?>" alt="menu" id="menu-icon">
                                </a>
                                <div class="action-dropdown" style="display: none;">
                                    <a href="<?php echo base_url('edit-career/' . $career['job_IDPK']); ?>" class="ps-1 pe-1">Edit</a>
                                    <a href="<?= base_url('deact-act-career/' . $career['job_IDPK']) ?>" class="ps-1 pe-1"><?= $buttonText ?></a>
                                </div>
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

    const menuTriggers = document.querySelectorAll('.menu-trigger');
    menuTriggers.forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.stopPropagation();
            document.querySelectorAll('.action-dropdown').forEach((dropdown) => {
                dropdown.style.display = 'none';
            });
            const dropdown = trigger.nextElementSibling;
            dropdown.style.display = 'block';
        });
    });

    document.addEventListener('click', () => {
        document.querySelectorAll('.action-dropdown').forEach((dropdown) => {
            dropdown.style.display = 'none';
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
        window.location.href = 'careers?fdate=' + fromdateid + '&todate=' + todateid;
    }
</script>

<?php echo ($this->endSection()) ?>