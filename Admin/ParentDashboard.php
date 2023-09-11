<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';

$parentid = $_SESSION['id'];
$checkParent = ReadSingle('students', $parentid, 'Parent');
if (isset($_SESSION['id']) && $checkParent) {
    $studentInformation = ReadSingle('students', $parentid, 'Parent');
    $studentInvoices = array();
    $allStudentAttendance = array();
    $latestStudentAttendanceDay = end($allStudentAttendance);
    for ($i = 0; $i < count($studentInformation); $i++) {
        $studentInvoices[] = ReadSingle('invoices', $studentInformation[$i]['ID'], 'Student');
        $allStudentAttendance[] = ReadSingle('attendance', $studentInformation[$i]['ID'], 'Student');
    }
    $balance = 0;
    for ($j = 0; $j < count($studentInvoices); $j++) {

        for ($i = 0; $i < count($studentInvoices[$j]); $i++) {
            if ($studentInvoices[$j][$i]['Status'] === 0) {
                $balance += $studentInvoices[$j][$i]['Amount'];
            }
        }
    }
} else {
    redirect('404.php');
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Parents</h3>
            <p class="text-capitalize h6">home /<span> Dashboard</span></p>
        </div>
    </div>
    <div class="my-4 px-4 py-3">
        <h4>My Childrens</h4>
        <div class="row">
            <?php for ($j = 0; $j < count($studentInformation); $j++) : ?>
                <?php


                ?>

                <div class="col-md-6 p-2">
                    <a href="myChildrensDetails.php?csrf=<?php echo $_SESSION['csrf']; ?>&id=<?php echo $studentInformation[$j]['ID']; ?>" class="decoraion-none">
                        <div class="bg-white my-4 rounded border p-4">
                            <div class="row">
                                <div class="col-3 p-2">
                                    <img src="images/<?= $studentInformation[$j]['Gender'] == 'male' ? 'boy.jpg' : 'girl.avif' ?>" class="img-fluid cursor-pointer" alt="">
                                </div>
                                <div class="col-12 p-2">
                                    <h4><?= $studentInformation[$j]['FullName']; ?></h4>
                                    <ul class="mt-4">
                                        <li class="d-flex align-items-center justify-content-between">
                                            <span class="text-muted w-50 text-capitalize h6">Status:</span>
                                            <span class="h6"><?= getStatusAndExpire($studentInformation[$j]['Status'], 'Active', 'In Active', 'success', 'danger'); ?></span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between">
                                            <span class="text-muted w-50 text-capitalize h6">Last day of attendance:</span>
                                            <span class="h6"><?= end($allStudentAttendance[$j]) ? getStatusAndExpire(end($allStudentAttendance[$j])['Status'], 'Present', 'Absent', 'success', 'danger') : 'new student'; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <h4 class="mt-3">Finance</h4>
    <div class="table-responsive mb-4 text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Invoice Type</th>
                    <th>FullName</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($j = 0; $j < count($studentInvoices); $j++) :
                    for ($i = 0; $i < count($studentInvoices[$j]); $i++) :
                ?>
                        <tr>
                            <td><?= Escape($studentInvoices[$j][$i]['ID']); ?></td>
                            <td><?= Escape(Capitalize(getColumn('invoice_category', 'Name', $studentInvoices[$j][$i]['Invoice']))); ?></td>
                            <td><?= Escape(Capitalize(getColumn('students', 'FullName', $studentInvoices[$j][$i]['Student']))); ?></td>
                            <td><?= Escape(getPrice($studentInvoices[$j][$i]['Amount'])); ?></td>
                            <td><?= Escape($studentInvoices[$j][$i]['Status'] === 1 ? $studentInvoices[$j][$i]['Date'] : filterDate('F-Y', $studentInvoices[$j][$i]['Month'])); ?></td>
                            <td><?= getStatusAndExpire(Escape($studentInvoices[$j][$i]['Status']), 'Paid', 'Un Paid', 'success', 'danger'); ?></td>
                        </tr>
                <?php
                    endfor;
                endfor;
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Balance</td>
                    <td class="text-danger" colspan="3"><?= $balance > 0 ? '- ' . getPrice($balance) : getPrice($balance); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>
<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>