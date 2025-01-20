<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $EmployeeCode.'-'.date('F-Y', strtotime($Updated_on)) ?></title>
</head>
<style>
    .heading {
        text-align: center;
        margin-top: 5%;
    }

    .details {
        margin-left: 10%;
        display: inline-block;
        vertical-align: top;
    }

    .details2 {
        margin-left: 18%;
        display: inline-block;
        vertical-align: top;
    }

    th,
    td {
        padding: 5px;
    }

    .salary {
        margin-left: 10%;
    }

    .salary table {
        width: 95%;
        border-style: solid;
        border-color: black;
        border-width: 2px;
    }

    .salary table,
    .salary td,
    .salary th {
        border: 1px solid black;
        border-collapse: collapse;
    }

    img {
        width: 10%;
    }
</style>

<body>
    <div class="heading">
        <div class="image" style="margin-left: 10%;">
            <h4>VSNAP TECHNOLOGY SOLUTIONS PRIVATE LIMITED <img src="<?php echo base_url('../public/images/img/payslipicon.png') ?>" alt="Homes247.in"> </h4>
        </div>
        <h4>58, 5th Floor, East Wing, HM Towers, Brigade Road, Bengaluru-560001</h4>
        <h4>Wage Slip for the month of Apr/2024</h4>
    </div>
    
    <div class="details">
        <table>
            <tbody>
                <tr>
                    <td>Emp ID</td>
                    <td><?= $EmployeeCode ?></td>
                </tr>
                <tr>
                    <td>PF No.</td>
                    <td><?= $PF_NO ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>NOD</td>
                    <td><?= $NOD ?></td>
                </tr>
                <tr>
                    <td>Designation</td>
                    <td><?= $designations ?></td>
                </tr>
                <tr>
                    <td>A/c No.</td>
                    <td><?= $AccountNo ?></td>
                </tr>
                <tr>
                    <td>Mode of Pay</td>
                    <td><?= ($MOP == 1)? 'Account':'Cash' ?></td>
                </tr>
                <tr>
                    <td>LOP Days</td>
                    <td><?= $Absent_Days ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="details2">
        <table>
            <tbody>
                <tr>
                    <td>Employee Name:</td>
                    <td><?= $EmployeeName ?></td>
                </tr>
                <tr>
                    <td>ESI No.</td>
                    <td><?= $ESI_NO ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>DOJ</td>
                    <td><?= date('d-m-Y', strtotime($DOJ)) ?></td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td><?= $deptName ?></td>
                </tr>
                <tr>
                    <td>PAN</td>
                    <td><?= $PAN_No ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>UAN No.</td>
                    <td><?= $UAN_No ?? 'NA' ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="salary">
        <table>
            <thead>
                <tr>
                    <th>Earnings</th>
                    <th>Amount</th>
                    <th>Deductions</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;">BASIC</td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"><?= number_format($BasicSalary, 2) ?></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;">PF</td>
                    <td style="text-align:right;border-bottom: hidden;"><?= number_format($PF,2) ?></td>
                </tr>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;">HRA</td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"><?= number_format($HRA,2) ?></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;">PT</td>
                    <td style="text-align:right;border-bottom: hidden;"><?= number_format($PT,2) ?></td>
                </tr>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;">FBP</td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"><?= number_format($FBP,2) ?></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;">PFVOL</td>
                    <td style="text-align:right;border-bottom: hidden;"><?= number_format($PF_VOL,2) ?></td>
                </tr>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;"></td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;">Spl. Ded</td>
                    <td style="text-align:right;border-bottom: hidden;"><?= number_format($Spl_Ded,2) ?></td>
                </tr>
                <tr>
                    <td style="padding-top: 10%;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align:left">Total</th>
                    <?php $TOT = $BasicSalary+$HRA+$FBP; ?>
                    <th style="text-align:right;padding-right:5%;"><?= number_format($TOT,2) ?></th>
                    <th style="text-align:left;padding-left:8%;">Total</th>
                    <?php $TOT = $PF+$PT+$PF_VOL+$Spl_Ded; ?>
                    <th style="text-align:right"><?= number_format($TOT,2) ?></th>
                </tr>
                <tr style="border-bottom: hidden;">
                    <th style="text-align:left;border-right: hidden;">Net Pay</th>
                    <th style="border-right: hidden;"><?= number_format($Credited_Salary,2) ?></th>
                    <th style="border-right: hidden;"></th>
                    <th></th>
                </tr>
                <tr style="border-bottom: hidden;">
                    <?php 
                        function numberToWords($number) {
                            $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                            return strtoupper($f->format($number));
                        }
                    ?>
                    <th style="text-align:left" colspan="4">In Words <span style="padding-left:4%;"><?= numberToWords($Credited_Salary) ?></span></th>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top: 10%;"></td>
                </tr>
                <tr style="border-top: hidden;">
                    <th style="text-align:right;padding-right:5%;" colspan="4">Authorised Signatory</th>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>