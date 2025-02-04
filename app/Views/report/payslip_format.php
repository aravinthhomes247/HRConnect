<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $EmpID.'-'.date('F-Y', strtotime($Date)) ?></title>
</head>
<style>
    *{
        font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    }
    .heading {
        text-align: center;
        margin-top: 5%;
    }

    .details {
        margin-left: 9%;
        display: inline-block;
        vertical-align: top;
        max-width: 35%;
    }

    .details2 {
        margin-left: 10%;
        display: inline-block;
        vertical-align: top;
        max-width: 40%;
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
        width: 15%;
    }

    .sign{
        /* width: 15%;
        height:auto; */
    }
</style>

<body>
    <?php
        $timestamp = strtotime($Date);
        $formattedDate = date('M/Y', $timestamp);
    ?>
    <div class="heading">
        <div class="image" style="margin-left: 10%;">
            <h4>VSNAP TECHNOLOGY SOLUTIONS PRIVATE LIMITED <img src="<?php echo base_url('../public/images/img/payslipicon.png') ?>" alt="Homes247.in"> </h4>
        </div>
        <h4>58, 5th Floor, East Wing, HM Towers, Brigade Road, Bengaluru-560001</h4>
        <h4>Wage Slip for the month of <?= $formattedDate ?></h4>
    </div>
    
    <div class="details">
        <table>
            <tbody>
                <tr>
                    <td>Emp ID</td>
                    <td><?= $EmpID ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>PF Number</td>
                    <td><?= $PFNo ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>NOD</td>
                    <td><?= $NOD ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>Designation</td>
                    <td><?= $Designation ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>A/c Number</td>
                    <td><?= $AcNo ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>Mode of Pay</td>
                    <td><?= ($ModeofPay == 1)? 'Bank Transaction':'Cash' ?></td>
                </tr>
                <tr>
                    <td>LOP Days</td>
                    <td><?= $LOP ?? 0 ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="details2">
        <table>
            <tbody>
                <tr>
                    <td>Employee Name</td>
                    <td><?= $EmployeeName ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>ESI Number</td>
                    <td><?= $ESINo ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>DOJ</td>
                    <td><?= date('d-m-Y', strtotime($DOJ)) ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td><?= $Department ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>PAN</td>
                    <td><?= $PAN ?? 'NA' ?></td>
                </tr>
                <tr>
                    <td>UAN Number</td>
                    <td><?= $UANNo ?? 'NA' ?></td>
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
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"><?= number_format($BASIC, 2) ?? '0.00' ?></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;">PF</td>
                    <td style="text-align:right;border-bottom: hidden;"><?= number_format($PF,2) ?? '0.00' ?></td>
                </tr>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;">HRA</td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"><?= number_format($HRA,2) ?? '0.00' ?></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;">PT</td>
                    <td style="text-align:right;border-bottom: hidden;"><?= number_format($PT,2) ?? '0.00' ?></td>
                </tr>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;">FBP</td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"><?= number_format($FBP,2) ?? '0.00' ?></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;">PF Voluntary</td>
                    <td style="text-align:right;border-bottom: hidden;"><?= number_format($PFVoluntary,2) ?? '0.00' ?></td>
                </tr>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;"><?= ($SpecialEarnings != 0.00) ? 'Spl. Earnings':''?></td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"><?= ($SpecialEarnings != 0.00) ? (number_format($SpecialEarnings,2) ?? '0.00') : '' ?></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;"><?= ($SpecialDeductions != 0.00)? 'Spl. Deductions':'' ?></td>
                    <td style="text-align:right;border-bottom: hidden;"><?= ($SpecialDeductions != 0.00)? (number_format($SpecialDeductions,2) ?? '0.00') : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;"></td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;"><?= ($Insurance != 0)? 'Insurance':'' ?></td>
                    <td style="text-align:right;border-bottom: hidden;"><?= ($Insurance != 0)? (number_format($Insurance,2) ?? '0.00') : '' ?></td>
                </tr>
                <tr>
                    <td style="text-align:left;border-bottom: hidden;"></td>
                    <td style="text-align:right;padding-right:5%;border-bottom: hidden;"></td>
                    <td style="text-align:left;padding-left:8%;border-bottom: hidden;"><?= ($TDS != 0)? 'TDS':'' ?></td>
                    <td style="text-align:right;border-bottom: hidden;"><?= ($TDS != 0)? (number_format($TDS,2) ?? '0.00') : '' ?></td>
                </tr>
                <tr>
                    <td style="padding-top: 10%;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th style="text-align:left">Total</th>
                    <?php $TOT1 = $BASIC+$HRA+$FBP+$SpecialEarnings; ?>
                    <th style="text-align:right;padding-right:5%;"><?= number_format($TOT1,2) ?? '0.00' ?></th>
                    <th style="text-align:left;padding-left:8%;">Total</th>
                    <?php $TOT2 = $PF+$PT+$PFVoluntary+$TDS+$Insurance+$SpecialDeductions; ?>
                    <th style="text-align:right"><?= number_format($TOT2,2) ?? '0.00' ?></th>
                </tr>
                <tr style="border-bottom: hidden;">
                    <th style="text-align:left;" colspan="4">Net Pay <span style="padding-left:6%;"><?= number_format($Credited_Salary,2) ?? '0.00' ?></span></th>
                </tr>
                <tr style="border-bottom: hidden;">
                    <?php 
                        function numberToWords($number) {
                            $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                            return strtoupper($f->format($number));
                        }
                    ?>
                    <th style="text-align:left" colspan="4">In Words <span style="padding-left:4%;font-size:x-small;font-weight:400;"><?= numberToWords($Credited_Salary) ?></span></th>
                </tr>
                <tr style="border-bottom: hidden;">
                    <td colspan="4" style="padding-top: 10%;"></td>
                </tr>
                <tr>
                    <th style="text-align:right;padding-right:10%;" colspan="4"> <img src="<?php echo base_url('../public/Uploads/sign/sign.svg') ?>" alt="No Signature"> </th>
                </tr>
                <tr style="border-top: hidden;">
                    <th style="text-align:right;padding-right:5%;" colspan="4">Authorised Signatory</th>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>