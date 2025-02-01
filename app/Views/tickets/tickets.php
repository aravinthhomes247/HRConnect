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
        left: -75%;
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
            <a href="<?= site_url('/tickets?trickid=1&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 1) ? 'active' : '' ?>">All - <?= $All ?></a>
            <a href="<?= site_url('/tickets?trickid=2&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 2) ? 'active' : '' ?>">Pending - <?= $Pending ?></a>
            <a href="<?= site_url('/tickets?trickid=3&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 3) ? 'active' : '' ?>">In Progress - <?= $In_Progress ?></a>
            <a href="<?= site_url('/tickets?trickid=4&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 4) ? 'active' : '' ?>">Resolved - <?= $Resolved ?></a>
            <a href="<?= site_url('/tickets?trickid=5&fdate=' . $fdate . '&todate=' . $todate) ?>" class="btn <?= ($trickid == 5) ? 'active' : '' ?>">Escalated - <?= $Escalated ?></a>
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
                    <td>Priority</td>
                    <td>Employee Name</td>
                    <td>Ticket Type</td>
                    <td>Description</td>
                    <td>Status</td>
                    <td>Raised On</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if ($tickets): ?>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <?php
                            if ($ticket['Priority'] == 0) {
                                $color = "#029008";
                                $text = "Low";
                            } else if ($ticket['Priority'] == 1) {
                                $color = "#DB9600";
                                $text = "Medium";
                            } else if ($ticket['Priority'] == 2) {
                                $color = "#F06400";
                                $text = "High";
                            } else if ($ticket['Priority'] == 3) {
                                $color = "#F94343";
                                $text = "Critical";
                            }
                            ?>
                            <td style="color:<?= $color ?>;"><?= $text ?></td>
                            <td><?= $ticket['EmployeeName'] ?></td>
                            <td><?= $ticket['Name'] ?></td>
                            <td><?= $ticket['Subject'] ?></td>
                            <?php
                            if ($ticket['Status'] == 0) {
                                $color = '#F06400';
                                $text = 'Pending';
                            } else if ($ticket['Status'] == 1) {
                                $color = '#017BB8';
                                $text = 'In Progress';
                            } else if ($ticket['Status'] == 2) {
                                $color = '#029008';
                                $text = 'Resolved';
                            } else if ($ticket['Status'] == 3) {
                                $color = '#F94343';
                                $text = 'Escalated';
                            }
                            ?>
                            <td style="color:<?= $color ?>;"><?= $text ?></td>
                            <td><?= date('d/m/y, h:mA', strtotime($ticket['Raised_On'])) ?></td>
                            <td>
                                <a href="javascript:void(0);" class="menu-trigger">
                                    <img src="<?php echo base_url('../public/images/img/Group.png') ?>" alt="menu" id="menu-icon">
                                </a>
                                <div class="dropdown" style="display: none;">
                                    <a href="javascript:void(0);" data-id="<?= $ticket['IDPK'] ?>" class="viewtic"><i class="fa-regular fa-eye"></i> View Details</a>
                                    <a href="javascript:void(0);" class="updatetic"><i class="fa-solid fa-angle-left"></i> Update Status</a>
                                    <div class="inner-dropdown" style="display: none;">
                                        <a href="<?= base_url('tickets-update-status/' . $ticket['IDPK'] . '/1') ?>" style="color:#017BB8">In Progress</a>
                                        <a href="<?= base_url('tickets-update-status/' . $ticket['IDPK'] . '/2') ?>" style="color:#029008">Resolved</a>
                                        <a href="<?= base_url('tickets-update-status/' . $ticket['IDPK'] . '/3') ?>" style="color:#F94343">Escalate</a>
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
                                <?php foreach ($issuetypes as $type): ?>
                                    <option value="<?= $type['IDPK'] ?>"><?= $type['Name'] ?></option>
                                <?php endforeach; ?>
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
                <h5 class="modal-title">Ticket Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <h6>Employee Name</h6>
                        <span id="TicEmpName"></span>
                    </div>
                    <div class="col-3">
                        <h6>Ticket Subject</h6>
                        <span id="TicSub"></span>
                    </div>
                    <div class="col-3">
                        <h6>Priority</h6>
                        <span id="TicPer"></span>
                    </div>
                    <div class="col-3">
                        <h6>Raised On</h6>
                        <span id="TicRais"></span>
                    </div>
                    <div class="col-12 mt-2">
                        <h6>Description</h6>
                        <span id="TicDesc"></span>
                    </div>
                    <form action="<?= base_url('ticket-update-status') ?>" method="post">
                        <input type="hidden" id="Ticid" name="Ticid">
                        <div class="col-12 mt-2">
                            <h6>Status Of Ticket</h6>
                            <div class="form-check form-check-inline orange">
                                <input class="form-check-input" type="radio" name="Status" id="inlineRadio0" value="0">
                                <label class="form-check-label" for="inlineRadio0">Pending</label>
                            </div>
                            <div class="form-check form-check-inline blue">
                                <input class="form-check-input" type="radio" name="Status" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">In Progress</label>
                            </div>
                            <div class="form-check form-check-inline green">
                                <input class="form-check-input" type="radio" name="Status" id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">Resolved</label>
                            </div>
                            <div class="form-check form-check-inline red">
                                <input class="form-check-input" type="radio" name="Status" id="inlineRadio3" value="3">
                                <label class="form-check-label" for="inlineRadio3">Escalate</label>
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
        var filename;
        if (trickid == 1) {
            filename = 'Logdata';
        } else if (trickid == 2) {
            filename = 'LateEntry';
        }

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
            $('#Ticid').val(id);
            $.ajax({
                url: '<?= base_url() . '/ticket-edit/' ?>' + id,
                type: 'GET',
                success: function(response) {
                    $('#TicEmpName').html(response.data.EmployeeName);
                    $('#TicSub').html(response.data.Subject);
                    let dateStr = response.data.Raised_On;
                    let dateObj = new Date(dateStr);
                    let options = {
                        year: '2-digit',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    };
                    let formattedDate = dateObj.toLocaleString('en-US', options);
                    $('#TicRais').html(formattedDate);
                    $('#TicDesc').html(response.data.Description);
                    if (response.data.Priority == 0) {
                        $('#TicPer').html(`Low`);
                        $('#TicPer').attr('style', 'color:#029008');
                    } else if (response.data.Priority == 1) {
                        $('#TicPer').html(`Medium`);
                        $('#TicPer').attr('style', 'color:#DB9600');
                    } else if (response.data.Priority == 2) {
                        $('#TicPer').html(`High`);
                        $('#TicPer').attr('style', 'color:#F06400');
                    } else if (response.data.Priority == 3) {
                        $('#TicPer').html(`Critical`);
                        $('#TicPer').attr('style', 'color:#F94343');
                    }
                    if (response.data.Status == 0) {
                        $('#inlineRadio0').attr('checked', 'checked');
                    } else if (response.data.Status == 1) {
                        $('#inlineRadio1').attr('checked', 'checked');
                    } else if (response.data.Status == 2) {
                        $('#inlineRadio2').attr('checked', 'checked');
                    } else if (response.data.Status == 3) {
                        $('#inlineRadio3').attr('checked', 'checked');
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
        window.location.href = 'tickets?trickid=<?= $trickid ?>&fdate=' + fromdateid + '&todate=' + todateid;
    }
</script>

<?= $this->endSection() ?>