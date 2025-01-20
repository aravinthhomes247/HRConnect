<?php $session = \Config\Services::session(); ?>
<?= $this->extend("layouts/header-new") ?>
<?= $this->section("body") ?>

<style>
    .modal-footer .btn {
        width: max-content !important;
        background-color: #8146D4;
        color: white;
        border: 1px solid #8146D4;
        border-radius: 2px;
        padding: 3px 5px !important;
    }

    .modal-header {
        background-color: #925EDD14;
        text-align: center;
    }

    button.close {
        border: 1px solid #8146D4;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        color: #8146D4;
    }
</style>


<div class="Employees ms-4 mt-1">
    <div class="row ms-0 me-0 mt-2 pt-2">
        <div class="col col-lg-8">
            <input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
            <a href="<?= site_url('/reportemp?trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 1) ? 'active' : '' ?>">All</a>
            <a href="<?= site_url('/reportemp?trickid=2&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 2) ? 'active' : '' ?>">Late Comers - <?= $lateComers ?></a>
            <!-- <a href="#" class="btn">Early Log-Out</a>
            <a href="#" class="btn">Abnormal Time Log</a> -->
        </div>
        <div class="col col-lg-4">
            <div class="action ms-3">
                <i class="fa-solid fa-calendar-days"></i>
                <input class="form-control" type="text" style="padding-left: 35px; box-sizing: border-box;" id="reportrange">
                <?php
                if (empty($fdate)) {
                    $fdate = date("Y-m-d");
                }
                ?>
                <input type="hidden" name="fdate" id="fdate" value="<?= $fdate ?>" />
                <?php
                if (empty($todate)) {
                    $todate = date("Y-m-d");
                }
                ?>
                <input type="hidden" name="todate" id="todate" value="<?= $todate ?>" />
                <button class="btn btn-primary" style="margin-left: 10px;" onclick="datefilter()">Check</button>
                <button class="btn btn-primary" style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#modal-sm"><i class="fa-solid fa-download" style="color: #ffffff;"></i></button>
            </div>
        </div>
    </div>

    <div class="row ms-1 me-1 mt-2 pt-2">
        <?php if ($trickid == 1) { ?>
            <table class="table table-hover ms-2" id="examp1">
                <thead class="table-secondary">
                    <tr>
                        <td>S.No</td>
                        <td>Employee Name</td>
                        <td>Employee Code</td>
                        <td>Designation</td>
                        <td>Log-IN</td>
                        <td>Log-OUT</td>
                        <td>Total Hrs</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 1;
                        if ($selectedemps): ?>
                            <?php foreach ($selectedemps as $row): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['UserId'] ?>
                                        <input type="hidden" id="UserId" value="<?= $row['UserId'] ?>">
                                    </td>
                                    <td><?php echo $row['designations'] ?></td>
                                    <td> <?php echo $row['login'] ?> </td>
                                    <td> <?php echo $row['logout'] ?> </td>
                                    <td><?php echo $row['workingHours'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                </tbody>
            </table>
        <?php } else if($trickid == 2) { ?>
            <table class="table table-hover ms-2" id="examp1">
                <thead class="table-secondary">
                    <tr>
                        <td>S.No</td>
                        <td>Employee Name</td>
                        <td>Employee Code</td>
                        <td>Designation</td>
                        <td>Log-IN</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; if($lateComersDetailsLog): ?>
                        <?php foreach($lateComersDetailsLog as $row): ?>
                            <tr>                      
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['UserId']; ?></td>
                                <td><?php echo $row['designations']; ?></td>
                                <td><?php echo $row['FirstLogin']; ?></td>
                            </tr>
                        <?php endforeach; ?> 
                     <?php endif; ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Download Report</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="javascript:void(0);" class="btn button_export_pdf">Export to PDF</a>
                <a href="javascript:void(0);" class="btn button_export_excel">Export to Excel</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var trickid = $('#trickid').val();
        var filename;
        if(trickid == 1){
            filename = 'Logdata';
        }else if(trickid == 2){
            filename = 'LateEntry';
        }

        $('#examp1').DataTable({
            paging: true,
            info: true,
            buttons: [{
                    extend: 'excel',
                    title: filename
                },
                {
                    extend: 'pdfHtml5',
                    title: filename,
                    footer: true,
                    customize: function(doc) {
                        doc.content.splice(1, 0, {
                            margin: [0, 0, 0, 12],
                            width: 90,
                            alignment: 'center',
                            image: 'data:image/png;base64,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'

                        }, {
                            text: 'HM Towers,5th Floor, East Wing, \n #58,Brigade Road, Bengaluru, 560001 \n ',
                            alignment: 'center',
                            bold: true,
                            width: 'auto'
                            //, margin: [0, 10, 0, 0]
                        });
                        doc['footer'] = (function(page, pages) {
                            return {
                                columns: [
                                    '	© Homes247.in',
                                    {
                                        // This is the right column
                                        alignment: 'right',
                                        text: ['page ', {
                                            text: page.toString()
                                        }, ' of ', {
                                            text: pages.toString()
                                        }]
                                    }
                                ],
                                margin: [30, 10]
                            }
                        });
                    }
                },
            ]
        });

        $('.button_export_excel').click(() => {
            $('#examp1').DataTable().buttons(0, 0).trigger();
            $('#modal-sm .close').click();
        })

        $('.button_export_pdf').click(() => {
            $('#examp1').DataTable().buttons(0, 1).trigger();
            $('#modal-sm .close').click();
        });

        $('.Search').change(function() {
            if ($("#examp1 > tbody > tr > td").length == 1) {
                $('#count').empty();
                $('#count').append('0');;
            } else {
                $('#count').empty();
                $('#count').append(' ' + $("#examp1 > tbody > tr").length);
            }
        });

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
        window.location.href = 'reportemp?trickid=<?= $trickid ?>&fdate=' + fromdateid + '&todate=' + todateid;
    }
</script>

<?= $this->endSection() ?>