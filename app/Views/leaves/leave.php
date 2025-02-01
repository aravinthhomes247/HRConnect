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

    .dropdown {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: max-content;
    }

    .inner-dropdown {
        position: absolute;
        top: 50%;
        left: -63%;
        display: none;
        background-color: #fff;
        border: 1px solid #ddd;
        padding: 0px;
        z-index: 100;
    }

    .dropdown a {
        padding: 5px 10px !important;
        display: block;
        /* color: black !important; */
        text-decoration: none !important;
        width: 100% !important;
    }

    .dropdown a:hover {
        background-color: #f0f0f0;
    }

    .form-check.form-check-inline.orange {
        border: 1px solid #F06400;
        padding: 0.5% 5%;
        border-radius: 15px;
        color: #F06400;
    }

    .form-check.form-check-inline.orange .form-check-input {
        border: var(--bs-border-width) solid #F06400;
    }

    .form-check.form-check-inline.blue {
        border: 1px solid #017BB8;
        padding: 0.5% 5%;
        border-radius: 15px;
        color: #017BB8;
    }

    .form-check.form-check-inline.blue .form-check-input {
        border: var(--bs-border-width) solid #017BB8;
    }

    .form-check.form-check-inline.red {
        border: 1px solid #F94343;
        padding: 0.5% 5%;
        border-radius: 15px;
        color: #F94343;
    }

    .form-check.form-check-inline.red .form-check-input {
        border: var(--bs-border-width) solid #F94343;
    }

    .form-check.form-check-inline.green {
        border: 1px solid #029008;
        padding: 0.5% 5%;
        border-radius: 15px;
        color: #029008;
    }

    .form-check.form-check-inline.green .form-check-input {
        border: var(--bs-border-width) solid #029008;
    }

    .dropdown,
    .inner-dropdown {
        transition: opacity 0.2s ease, visibility 0.2s ease;
    }
</style>


<div class="Employees ms-4 mt-1">
    <div class="row ms-0 me-0 mt-2 pt-2">
        <div class="col col-lg-9">
            <input type="hidden" name="trickid" id="trickid" value="<?= $trickid ?>">
            <a href="<?= site_url('/leave?trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 1) ? 'active' : '' ?>">All - <?= $All ?? 0 ?></a>
            <a href="<?= site_url('/leave?trickid=2&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 2) ? 'active' : '' ?>">Pending - <?= $Pending ?? 0 ?></a>
            <a href="<?= site_url('/leave?trickid=3&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 3) ? 'active' : '' ?>">Approved - <?= $Approved ?? 0 ?></a>
            <a href="<?= site_url('/leave?trickid=4&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 4) ? 'active' : '' ?>">Rejected - <?= $Rejected ?? 0 ?></a>
        </div>
        <div class="col col-lg-3">
            <!-- <a href="javascript:void(0);" class="btn active" data-bs-toggle="modal" data-bs-target="#TicketAddModel">Add Ticket</a> -->
            <div class="action">
                <i class="fa-solid fa-calendar-days"></i>
                <input class="form-control" type="text" style="padding-left: 30px; box-sizing: border-box;" id="reportrange">
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
                <button class="btn btn-primary" style="margin-left: 5px;" onclick="datefilter()">Check</button>
            </div>
        </div>
    </div>

    <div class="row ms-1 me-1 mt-2 pt-2">
        <table class="table table-hover ms-2" id="examp1">
            <thead class="table-secondary">
                <tr>
                    <td>S.No</td>
                    <td>Employee Name</td>
                    <td>Leave Type</td>
                    <td>Reason</td>
                    <td>Status</td>
                    <td>Raised On</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if ($leaves): ?>
                    <?php foreach ($leaves as $leave): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $leave['EmployeeName'] ?></td>
                            <td><?= $leave['Name'] ?></td>
                            <td><?= $leave['Reason'] ?></td>
                            <?php
                            if ($leave['Status'] == 0) {
                                $color = '#F06400';
                                $text = 'Pending';
                            } else if ($leave['Status'] == 1) {
                                $color = '#029008';
                                $text = 'Approved';
                            } else if ($leave['Status'] == 2) {
                                $color = '#F94343';
                                $text = 'Rejected';
                            }
                            ?>
                            <td style="color:<?= $color ?>;"><?= $text ?></td>
                            <td><?= date('d/m/y, h:mA', strtotime($leave['Date'])) ?></td>
                            <td>
                                <a href="javascript:void(0);" class="menu-trigger">
                                    <img src="<?php echo base_url('../public/images/img/Group.png') ?>" alt="menu" id="menu-icon">
                                </a>
                                <div class="dropdown" style="display: none;">
                                    <a href="javascript:void(0);" data-id="<?= $leave['IDPK'] ?>" class="viewtic"><i class="fa-regular fa-eye"></i> View Details</a>
                                    <a href="javascript:void(0);" class="updatetic"><i class="fa-solid fa-angle-left"></i> Update Status</a>
                                    <div class="inner-dropdown" style="display: none;">
                                        <a href="<?= base_url('leave-update-status/' . $leave['IDPK'] . '/1') ?>" style="color:#029008">Approve</a>
                                        <a href="<?= base_url('leave-update-status/' . $leave['IDPK'] . '/2') ?>" style="color:#F94343">Reject</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="TicketAddModel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Raise a Ticket</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('add-ticket') ?>" method="post">
                    <input type="hidden" name="EmployeeIDFK" value="2">
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Ticket Subject</h6>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="Subject" placeholder="Enter Subject" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Issue Type</h6>
                        </div>
                        <div class="col-9">
                            <select name="TypeIDFK" class="form-select" required>
                                <option value="">Select Case Type</option>
                                <?php if($issuetypes): ?>
                                    <?php foreach ($issuetypes as $type): ?>
                                        <option value="<?= $type['IDPK'] ?>"><?= $type['Name'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Priority Level</h6>
                        </div>
                        <div class="col-9">
                            <select name="Priority" class="form-select" required>
                                <option value="">Select Level</option>
                                <option value="0">Low</option>
                                <option value="1">Medium</option>
                                <option value="2">High</option>
                                <option value="3">Critical</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-3">
                            <h6 class="mt-2">Description</h6>
                        </div>
                        <div class="col-9">
                            <textarea name="Description" class="form-control" placeholder="Explain..." required></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary w-50">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="TicketViewModel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Leave Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <h6>Employee Name</h6>
                        <span id="LeaveEmpName"></span>
                    </div>
                    <div class="col-3">
                        <h6>Leave Type</h6>
                        <span id="Leavetype"></span>
                    </div>
                    <div class="col-3">
                        <h6>Date</h6>
                        <span id="leaveRais"></span>
                    </div>
                    <div class="col-3" style="display:none;" id="COMPOFF">
                        <h6>CompOff</h6>
                        <span id="CO"></span>
                    </div>
                    <div class="col-3" style="display:none;" id="HPERN">
                        <h6>Duration</h6>
                        <span id="ST"></span> to <span id="ET"></span>
                    </div>
                    <div class="col-12 mt-2">
                        <h6>Reason</h6>
                        <span id="LeaveReason"></span>
                    </div>
                    <form action="<?= base_url('leave-update-status') ?>" method="post">
                        <input type="hidden" id="id" name="id">
                        <div class="col-12 mt-2">
                            <h6>Status Of Leave</h6>
                            <div class="form-check form-check-inline orange">
                                <input class="form-check-input" type="radio" name="Status" id="inlineRadio0" value="0">
                                <label class="form-check-label" for="inlineRadio0">Pending</label>
                            </div>
                            <div class="form-check form-check-inline green">
                                <input class="form-check-input" type="radio" name="Status" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Approved</label>
                            </div>
                            <div class="form-check form-check-inline red">
                                <input class="form-check-input" type="radio" name="Status" id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">Rejected</label>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const menuTriggers = document.querySelectorAll('.menu-trigger');
    menuTriggers.forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.stopPropagation();
            document.querySelectorAll('.dropdown').forEach((dropdown) => {
                dropdown.style.display = 'none';
            });
            const dropdown = trigger.nextElementSibling;
            dropdown.style.display = 'block';
        });
    });
    document.addEventListener('click', () => {
        document.querySelectorAll('.dropdown').forEach((dropdown) => {
            dropdown.style.display = 'none';
        });
    });
    document.querySelectorAll('.updatetic').forEach((updatetic) => {
        const dropdownContainer = updatetic.parentElement;
        const innerDropdown = dropdownContainer.querySelector('.inner-dropdown');
        if (innerDropdown) {
            updatetic.addEventListener('mouseenter', () => {
                innerDropdown.style.display = 'block';
            });
            innerDropdown.addEventListener('mouseenter', () => {
                innerDropdown.style.display = 'block';
            });
            updatetic.addEventListener('mouseleave', () => {
                setTimeout(() => {
                    if (!innerDropdown.matches(':hover') && !updatetic.matches(':hover')) {
                        innerDropdown.style.display = 'none';
                    }
                }, 50); // Add slight delay to handle mouse transitions smoothly
            });
            innerDropdown.addEventListener('mouseleave', () => {
                setTimeout(() => {
                    if (!innerDropdown.matches(':hover') && !updatetic.matches(':hover')) {
                        innerDropdown.style.display = 'none';
                    }
                }, 50); // Add slight delay to handle mouse transitions smoothly
            });
        }
    });

    $(document).ready(function() {
        var trickid = $('#trickid').val();

        $('#examp1').DataTable({});

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

        $('#examp1').on("click", ".viewtic", function() {
            var id = $(this).data('id');
            $('#id').val(id);
            $('#HPERN').hide();
            $('#COMPOFF').hide();
            $.ajax({
                url: '<?= base_url() . '/leave-edit/' ?>' + id,
                type: 'GET',
                success: function(response) {
                    $('#LeaveEmpName').html(response.data.EmployeeName);
                    $('#Leavetype').html(response.data.Name);
                    let dateStr = response.data.Date;
                    let dateObj = new Date(dateStr);
                    let formattedDate = dateObj.toISOString().split('T')[0];
                    $('#leaveRais').html(formattedDate);
                    if(response.data.TypeIDFK == 6){
                        $('#HPERN').show();
                        $('#ST').html(response.data.Start_time);
                        $('#ET').html(response.data.End_time);
                    }
                    if(response.data.TypeIDFK == 4){
                        $('#COMPOFF').show();
                        $('#CO').html(response.data.CompDate);
                    }
                    $('#LeaveReason').html(response.data.Reason);
                    if (response.data.Status == 0) {
                        $('#inlineRadio0').attr('checked', 'checked');
                    } else if (response.data.Status == 1) {
                        $('#inlineRadio1').attr('checked', 'checked');
                    } else if (response.data.Status == 2) {
                        $('#inlineRadio2').attr('checked', 'checked');
                    }
                    $('#TicketViewModel').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log('Failed to update:', error);
                    alert('Failed to update! (Please check person\'s salary details!)');
                }
            });
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
        window.location.href = 'leave?trickid=<?= $trickid ?>&fdate=' + fromdateid + '&todate=' + todateid;
    }
</script>

<?= $this->endSection() ?>