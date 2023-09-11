<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';

$studentid = $_SESSION['id'];
$checkStudent = ReadSingle('students', $studentid, 'ID');
if (isset($_SESSION['id']) && $checkStudent) {
    $latestStudentExamResults = array();
    $studentInformation = ReadSingle('students', $studentid, 'ID');
    $studentInvoices = ReadSingle('invoices', $studentid, 'Student');
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
    <div class="row px-4">
        <div class="info-pages mb-3">
            <h3 class="text-capitalize">student dashboard</h3>
            <p class="text-capitalize h6">home /<span> student</span></p>
        </div>
    </div>
    <div class="bg-white my-4 rounded border px-4 py-3">
        <h4>About Me</h4>
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
                </ul>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="box d-flex align-items-center justify-content-between my-2 w-100">
            <div class="cards">
                <a href="studentExam.php" class="d-flex w-100 align-items-center decoraion-none">
                    <div class="icon stud">
                        <i class='bx bx-notepad'></i>
                    </div>
                    <div class="desc text-right w-100 text-md-center">
                        <h5 class="text-capitalize">Exams</h5>
                        <h6 class="text-muted text-capitalize">examination Information</h6>
                    </div>
                </a>
            </div>
            <div class="cards">
                <a href="studentFinance.php" class="d-flex w-100 align-items-center decoraion-none">
                    <div class="icon teach">
                        <i class='bx bxl-bitcoin'></i>
                    </div>
                    <div class="desc text-right w-100 text-md-center">
                        <h5 class="text-capitalize">Finance</h5>
                        <h6 class="text-muted text-capitalize">Finance statements</h6>
                    </div>
                </a>
            </div>
            <div class="cards">
                <a href="studentAttendance.php" class="d-flex w-100 align-items-center decoraion-none">
                    <div class="icon pare">
                        <i class='bx bx-list-ul'></i>
                    </div>
                    <div class="desc text-right w-100 text-md-center">
                        <h5 class="text-capitalize">attendance</h5>
                        <h6 class="text-muted text-capitalize">attendance Information</h6>
                    </div>
                </a>
            </div>
            <div class="cards">
                <a href="studentSchedule.php" class="d-flex w-100 align-items-center decoraion-none">
                    <div class="icon earn">
                        <i class='bx bxs-time-five'></i>
                    </div>
                    <div class="desc text-right w-100 text-md-center">
                        <h5 class="text-capitalize">schedule</h5>
                        <h6 class="text-muted text-capitalize">academic Information</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-between my-4">
        <div class="studen shadow-lg bg-white p-4 rounded">
            <h4 class="text-capitalize mb-3">Attendance</h4>
            <div class="w-100 d-flex justify-content-center">
                <div style="width: 350px;">
                    <canvas id="studentAttendance"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>
<script>
    const ctx = document.getElementById('studentAttendance');


    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Presents',
                'Absenets',
            ],
            datasets: [{
                label: 'Days',
                data: [<?php echo json_encode(count(reportOfAttendance(1, 'true', getColumn('students', 'Class', 1)))); ?>, <?php echo json_encode(count(reportOfAttendance(1, 'false', getColumn('students', 'Class', 1)))); ?>],
                backgroundColor: [
                    'rgb(6, 244, 97)',
                    'rgb(255, 5, 5)',
                ],
                hoverOffset: 4
            }]
        }
    });
</script>