<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';
// checkUserPrivileges
checkUserPrivileges();


$AttendanceReport = $AttendanceReport ?? array();
// insert
if (isset($_POST['generateAttendance'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        redirect('404.php');
    } else {
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS);
        $season = filter_var($_POST['season'], FILTER_SANITIZE_SPECIAL_CHARS);
        if ($class == '') {
            $message['error'] = 'Class is required!';
        } else if ($date == '') {
            $message['error'] = 'date is required!';
        } else {
            $student = generateReport('attendance', Escape($class), Escape($season), $date);
            if ($student) {
                $AttendanceReport = $student;
            } else {
                $AttendanceReport = array();
            }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Reports</h3>
            <p class="text-capitalize h6">Report /<span> Attendance Report</span></p>
        </div>
    </div>
    <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="row my-4">
            <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
            <div class="col-lg-4 col-md-6">
                <select name="class" class="form-control" required>
                    <option value="" selected>Select Class</option>
                    <?php foreach (ReadAll('classes') as $class) : ?>
                        <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php foreach (ReadBolean('seasons', 'Status', 1) as $season) : ?>
                    <input type="hidden" name="season" class="form-control" value="<?= $season['ID']; ?>">
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4 mt-3 mt-0 mt-sm-0 col-md-6">
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-lg-4 mt-3 mt-0 mt-md-0 col-md-6 text-left text-md-right">
                <button type="submit" class="btn btn-primary w-100" name="generateAttendance">Generate Report</button>
            </div>
        </div>
    </form>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Class</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($AttendanceReport)) :
                    foreach ($AttendanceReport as $attendance) :
                ?>
                        <tr>
                            <td><?= Escape($attendance['ID']); ?></td>
                            <td><?= Escape(Capitalize(getColumn('students', 'FullName', $attendance['Student']))); ?></td>
                            <td><?= Escape(Capitalize(getColumn('classes', 'Name', $attendance['Class']))); ?></td>
                            <td><?= Escape(filterDate('F-Y-d', $attendance['Date'])); ?></td>
                            <td> <?= getStatusAndExpire(Escape($attendance['Status']), 'Present', 'Absent', 'success', 'danger'); ?></td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>