<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';

$studentid = Escape($_GET['studentid']) ?? null;
$checkStudent = ReadSingle('students', $studentid, 'ID');
if (isset($_GET['studentid']) && $_GET['studentid'] !== '' && $checkStudent) {
    $latestStudentExamResults = array();
    $studentInformation = ReadSingle('students', $studentid, 'ID');
    $studentInvoices = ReadSingle('invoices', $studentid, 'Student');
    $allStudentExams = ReadSingle('exam_marks', $studentid, 'Student');
    $latestStudentExamResults[] = end($allStudentExams);
    $allStudentAttendance = ReadSingle('attendance', $studentid, 'Student');
    $latestStudentAttendanceDay = end($allStudentAttendance);
    $balance = 0;
    foreach ($studentInvoices as $invoice) {
        $balance = $invoice['Status'] == 1 ? $balance = 0 : $balance += $invoice['Amount'];
    }
} else {
    redirect('404.php');
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Students</h3>
            <p class="text-capitalize h6">home /<span> Student details</span></p>
        </div>
    </div>
    <div class="bg-white my-4 rounded border px-4 py-3">
        <div class="row">
            <div class="col-md-4 p-2">
                <img src="images/<?= $studentInformation[0]['Gender'] == 'male' ? 'boy.jpg' : 'girl.avif' ?>" class="img-fluid" alt="">
            </div>
            <div class="col-md-8 p-2">
                <h4 class="mb-3"><?= $studentInformation[0]['FullName']; ?></h4>
                <p>Aliquam erat volutpat. Curabiene natis massa sedde lacu stiquen sodale word moun taiery.Aliquam erat volutpaturabiene natis massa sedde sodale word moun taiery.</p>
                <ul class="mt-4">
                    <h4>Student Information</h4>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">name:</span>
                        <span class="w-25 h6"> <?= $studentInformation[0]['FullName']; ?></span>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">address:</span>
                        <span class="w-25 h6"><?= $studentInformation[0]['Address']; ?></span>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">Gender:</span>
                        <span class="w-25 h6"><?= $studentInformation[0]['Gender']; ?></span>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">Parent:</span>
                        <span class="w-25 h6"><?= Capitalize(getColumn('parent', 'FullName', $studentInformation[0]['Parent'])); ?></span>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">Status:</span>
                        <span class="w-25 h6"><?= getStatusAndExpire($studentInformation[0]['Status'], 'Active', 'In Active', 'success', 'danger'); ?></span>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">Last day of attendance:</span>
                        <span class="w-25 h6"><?= $latestStudentAttendanceDay ? getStatusAndExpire($latestStudentAttendanceDay['Status'], 'Present', 'Absent', 'success', 'danger') : 'new student'; ?></span>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">Balance:</span>
                        <span class="w-25 text-danger h6"><?= $balance > 0 ? '- ' . getPrice($balance) : getPrice($balance); ?></span>
                    </li>
                    <h4 class="mt-3">Account Information</h4>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">user name:</span>
                        <span class="w-25 h6"> <?= $studentInformation[0]['UserName']; ?></span>
                    </li>
                    <li class="d-flex align-items-center">
                        <span class="text-muted w-50 text-capitalize h6">Password:</span>
                        <span class="w-25 h6"> <?= $studentInformation[0]['Password']; ?></span>
                    </li>
                </ul>
            </div>
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($studentInvoices as $studentinvoice) : ?>
                    <tr>
                        <td><?= Escape($studentinvoice['ID']); ?></td>
                        <td><?= Escape(Capitalize(getColumn('invoice_category', 'Name', $studentinvoice['Invoice']))); ?></td>
                        <td><?= Escape(Capitalize(getColumn('students', 'FullName', $studentinvoice['Student']))); ?></td>
                        <td><?= Escape(getPrice($studentinvoice['Amount'])); ?></td>
                        <td><?= getStatusAndExpire(Escape($studentinvoice['Status']), 'Paid', 'Un Paid', 'success', 'danger'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <h4 class="mt-3">Exams</h4>
    <div class="table-responsive text-nowrap">
        <table id="example2" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Exam Type</th>
                    <th>Marks</th>
                    <th>Season</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($latestStudentAttendanceDay) :
                    foreach ($latestStudentExamResults as $studentexam) : ?>
                        <tr>
                            <td><?= Escape($studentexam['ID']); ?></td>
                            <td><?= Escape(Capitalize(getColumn('courses', 'Name', $studentexam['Course']))); ?></td>
                            <td><?= Escape(Capitalize(getColumn('exams', 'Name', $studentexam['Exam']))); ?></td>
                            <td><?= Escape(getPrice($studentexam['Marks'])); ?></td>
                            <td><?= Escape(Capitalize(getColumn('seasons', 'Name', $studentexam['Season']))); ?></td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
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