<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/ExamSchedul.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-exam-schedule'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $timeStart = filter_var($_POST['timeStart'], FILTER_SANITIZE_SPECIAL_CHARS);
        $timeEnd = filter_var($_POST['timeEnd'], FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS);
        $exam = filter_var($_POST['exam'], FILTER_SANITIZE_SPECIAL_CHARS);
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $course = filter_var($_POST['course'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($exam == '') {
            $message[] = 'exam is required';
        } else if ($date == '') {
            $message[] = 'date is required';
        } else {
            $data = [
                'Exam' => $exam,
                'TimeStart' => $timeStart,
                'TimeEnd' => $timeEnd,
                'Date' => $date,
                'Class' => $class,
                'Course' => $course
            ];
            $user = Insert('exam_schedule', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            } else {
                $message['error'] = 'Update Failed';
            }
        }
    }
}
// update 
if (isset($_POST['update-exam-schedule'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $timeStart = filter_var($_POST['timeStart'], FILTER_SANITIZE_SPECIAL_CHARS);
        $timeEnd = filter_var($_POST['timeEnd'], FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS);
        $exam = filter_var($_POST['exam'], FILTER_SANITIZE_SPECIAL_CHARS);
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $course = filter_var($_POST['course'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($exam == '') {
            $message[] = 'exam is required';
        } else if ($date == '') {
            $message[] = 'date is required';
        } else {
            $data = [
                'ID' => $id,
                'Exam' => $exam,
                'TimeStart' => $timeStart,
                'TimeEnd' => $timeEnd,
                'Date' => $date,
                'Class' => $class,
                'Course' => $course
            ];
            $user = Update('exam_schedule', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Updated';
            } else {
                $message['error'] = 'Update Failed';
            }
        }
    }
}

?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Exam</h3>
            <p class="text-capitalize h6">home /<span> Exam Schedule</span></p>
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
            <h4>All Exam Schedule</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddExamSchedule">Add Exam Schedule</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Exam</th>
                    <th>Class</th>
                    <th>Course</th>
                    <th>Date</th>
                    <th>Time Start</th>
                    <th>Time End</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('exam_schedule') as $examSchedule) : ?>
                    <tr>
                        <td><?= Escape($examSchedule['ID']); ?></td>
                        <td><?= Escape(Capitalize(getColumn('exams', 'Name', $examSchedule['Exam']))); ?></td>
                        <td><?= Escape(Capitalize(getColumn('classes', 'Name', $examSchedule['Class']))); ?></td>
                        <td><?= Escape(Capitalize(getColumn('courses', 'Name', $examSchedule['Course']))); ?></td>
                        <td><?= Escape(Capitalize($examSchedule['Date'])); ?></td>
                        <td><?= Escape(filterDate('h:i a', $examSchedule['TimeStart'])); ?></td>
                        <td><?= Escape(filterDate('h:i a', $examSchedule['TimeEnd'])); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateexamSchedule" onclick="update('<?= Escape($examSchedule['ID']); ?>','<?= Escape($examSchedule['Exam']); ?>','<?= Escape($examSchedule['Class']); ?>','<?= Escape($examSchedule['Course']); ?>')" title="edit"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>

<script>
    const exam = document.querySelectorAll('.exam');
    const clases = document.querySelectorAll('.class');
    const courses = document.querySelectorAll('.course');
    // update function 
    function update(id, examid, clasid, courseid) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'exam_schedule',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const examSchedule = JSON.parse(response);
                $('#id').val(examSchedule[0].ID);
                $('#date').val(examSchedule[0].Date);
                $('#timeStart').val(examSchedule[0].TimeStart);
                $('#timeEnd').val(examSchedule[0].TimeEnd);

                exam.forEach((exam) => {
                    exam.value == examid ? exam.selected = true : exam.selected = false;
                })
                clases.forEach((clas) => {
                    clas.value == clasid ? clas.selected = true : clas.selected = false;
                })
                courses.forEach((course) => {
                    course.value == courseid ? course.selected = true : course.selected = false;
                })
            })
        })
    }
</script>