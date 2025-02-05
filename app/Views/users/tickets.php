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
        left: -60%;
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

<div class="container mt-3">
    <div class="row">
        <div class="col text-start"><h4>Tickets</h4></div>
        <div class="col text-end"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TicketAddModel"><i class="fa-solid fa-plus"></i> Raise a Ticket</button></div>
    </div>
</div>
<div class="container mt-3">
    <table class="table table-hover" id="examp1">
        <thead class="table-secondary">
            <tr>
                <th>S.No</th>
                <th>Ticket Name</th>
                <th>Issue Type</th>
                <th>Priority Level</th>
                <th>Raised On</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if ($tickets): ?>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $ticket['Subject'] ?></td>
                        <td><?= $ticket['Name'] ?></td>
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
                        <td><?= date('d/m/y, h:mA', strtotime($ticket['Raised_On'])) ?></td>
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
                        <td>
                            <a href="javascript:void(0);" class="menu-trigger">
                                <img src="<?php echo base_url('../public/images/img/Group.png') ?>" alt="menu" id="menu-icon">
                            </a>
                            <div class="dropdown" style="display: none;">
                                <a href="javascript:void(0);" data-id="<?= $ticket['IDPK'] ?>" class="viewtic"><i class="fa-regular fa-eye"></i> View Details</a>
                                <?php if ($ticket['Status'] == 0): ?>
                                    <a href="javascript:void(0);" class="updatetic"><i class="fa-solid fa-angle-left"></i> Update Status</a>
                                    <div class="inner-dropdown" style="display: none;">
                                        <a href="<?= base_url('tickets-update-status/' . $ticket['IDPK'] . '/3') ?>" style="color:#F94343">Escalate</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
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
                    <input type="hidden" name="EmployeeIDFK" value="<?= $EmpId ?>">
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

        $('#examp1').DataTable({});

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
</script>

<?= $this->endSection() ?>