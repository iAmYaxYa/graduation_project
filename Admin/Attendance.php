<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Attendanc.php';
// checkUserPrivileges 
checkUserPrivileges();

$_SESSION['class'] = $_SESSION['class']  ?? 0;
$_SESSION['attendanceNo'] = $_SESSION['attendanceNo']  ?? 0;
// insert 
if (isset($_POST['makeAttendance'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        redirect('404.php');
    } else {
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $season = filter_var($_POST['season'], FILTER_SANITIZE_SPECIAL_CHARS);
        $attendanceNo = strtotime(date('Y-m-d h:i:s'));
        if ($class == '') {
            $message['error'] = 'Class is required!';
        } else {
            $student = filterData('students', 'true', 'Status', 'Class', $class);
            if ($student) {
                foreach ($student as $std) {
                    $data = [
                        'Student' => $std['ID'],
                        'AttendanceNo' => $attendanceNo,
                        'Teacher' => 2,
                        'Class' => $class,
                        'Season' => $season
                    ];
                    $result = Insert('attendance', $data);
                }
                if ($result) {
                    $message['sucess'] = 'Thanks For Making Attendance';
                    $_SESSION['class'] = $class;
                    $_SESSION['attendanceNo'] = $attendanceNo;
                }
            }
        }
    }
}
// take attendance 
if (isset($_POST['takeAttendance'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $attendanceNo = filter_var($_POST['attendanceNo'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($attendanceNo == '') {
            $message['error'] = 'Attendance Number is required!';
        } else {
            $result = updateWithOutID('attendance', 'Taked', 'AttendanceNo', $attendanceNo);
            if ($result) {
                $message['sucess'] = 'Thanks For Taking Attendance';
                $_SESSION['class'] = null;
                $_SESSION['attendanceNo'] = null;
            }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Attendance</h3>
            <p class="text-capitalize h6">home /<span> Attendance</span></p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <?php if (isset($message['sucess'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="far fa-check-circle"></i>
                    <strong class="ml-2"><?= $message['sucess']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (isset($message['warning'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class='bx bx-error'></i>
                    <strong class="ml-2 h6"><?= $message['warning']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (isset($message['error'])) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class='bx bx-error-circle'></i>
                    <strong class="ml-2"><?= $message['error']; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h4>All Users</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <?php if ($_SESSION['attendanceNo']) : ?>
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input type="hidden" value="<?= $_SESSION['attendanceNo'] ?>" name="attendanceNo">
                    <button type="submit" class="btn btn-primary" name="takeAttendance">Take Attendance</button>
                </form>
            <?php endif; ?>
            <?php if (!$_SESSION['attendanceNo']) : ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#makeAttendance">Make Attendance</button>
            <?php endif; ?>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Class</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['attendanceNo'])) :
                    foreach (ReadSingle('attendance', $_SESSION['attendanceNo'], 'AttendanceNo') as $attendance) :
                ?>
                        <tr>
                            <td><?= Escape($attendance['ID']); ?></td>
                            <td><?= Escape(Capitalize(getColumn('students', 'FullName', $attendance['Student']))); ?></td>
                            <td><?= Escape(Capitalize(getColumn('classes', 'Name', $attendance['Class']))); ?></td>
                            <td><input type="checkbox" style="width: 30px; height:30px; cursor:pointer;" <?= Escape($attendance['Status'] ? 'checked' : ''); ?> onclick="updateStatus(<?= Escape($attendance['ID']); ?>,this)"></td>
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

<script>
    // update status function 
    function updateStatus(id, event) {
        if (event.checked) {
            $.ajax({
                type: 'POST',
                url: '../includes/config/Api.php',
                data: {
                    table: 'attendance',
                    id: id,
                    action: 'activestatus'
                },
                success: ((response) => {})
            })
        }
        if (!event.checked) {
            $.ajax({
                type: 'POST',
                url: '../includes/config/Api.php',
                data: {
                    table: 'attendance',
                    id: id,
                    action: 'inactivestatus'
                },
                success: ((response) => {})
            })
        }
    }
</script>