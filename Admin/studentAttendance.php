<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';

$studentid = $_SESSION['id'];
$checkStudent = ReadSingle('students', $studentid, 'ID');
if (isset($_SESSION['id']) && $checkStudent) {
    $latestStudentExamResults = array();
    $studentInformation = ReadSingle('students', $studentid, 'ID');
    $allStudentAttendance = ReadSingle('attendance', $studentid, 'Student');
    $latestStudentAttendanceDay = end($allStudentAttendance);
} else {
    redirect('404.php');
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row">
        <div class="info-pages mb-3">
            <h3 class="text-capitalize">student dashboard</h3>
            <p class="text-capitalize h6">Dashboard /<span> student</span></p>
        </div>
        <div class="col-12">
            <div class="mt-3">
                <a href="StudentDashboard.php" class="text-dark decoraion-none h5 d-flex">
                    <div class="">Back</div>
                    <i class='bx bx-left-arrow-alt h4 ml-2'></i>
                </a>
            </div>
        </div>
    </div>
    <div class="bg-white my-4 rounded border px-4 py-3">
        <h4>Attendance</h4>
        <div class="row px-4">
            <div class="col-md-6 p-2">
                <h6 class="text-capitalize mb-3">Rate of absents and presents</h6>
                <div class="w-100 d-flex justify-content-center">
                    <div style="width: 350px;">
                        <canvas id="studentAttendance"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-2">
                <h4 class="mb-3">Attendance Rate</h4>
                <p>Review Your Attendance by Chart</p>
                <ul class="mt-4">
                    <li class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center text-warning h6">
                            <i class='bx bx-book-bookmark h6 text-warning'></i>
                            <span class="text-muted text-capitalize h6 ml-3">Total Periods</span>
                        </div>
                        <div class="w-25 h6"><?= count(reportOfAttendance(1, 'true', getColumn('students', 'Class', 1))) + count(reportOfAttendance(1, 'false', getColumn('students', 'Class', 1))); ?></div>
                    </li>
                    <li class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center text-warning h6">
                            <i class='bx bxs-check-square h6 text-success'></i>
                            <span class="text-muted text-capitalize h6 ml-3">present Periods</span>
                        </div>
                        <div class="w-25 h6"><?= count(reportOfAttendance(1, 'true', getColumn('students', 'Class', 1))); ?></div>
                    </li>
                    <li class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center text-warning h6">
                            <i class='bx bx-x-circle text-danger h6'></i>
                            <span class="text-muted text-capitalize h6 ml-3">Absent Periods</span>
                        </div>
                        <div class="w-25 h6"><?= count(reportOfAttendance(1, 'false', getColumn('students', 'Class', 1))); ?></div>
                    </li>
                </ul>
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