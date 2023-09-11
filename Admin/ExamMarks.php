<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/ExamMark.php';
// checkUserPrivileges 
checkUserPrivileges();

$_SESSION['class'] = $_SESSION['class']  ?? 0;
$_SESSION['course'] = $_SESSION['course']  ?? 0;
$_SESSION['examNo'] = $_SESSION['examNo']  ?? 0;
// insert 
if (isset($_POST['Add-ExamMarks'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $exam = filter_var($_POST['exam'], FILTER_SANITIZE_SPECIAL_CHARS);
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $course = filter_var($_POST['course'], FILTER_SANITIZE_SPECIAL_CHARS);
        $season = filter_var($_POST['season'], FILTER_SANITIZE_SPECIAL_CHARS);
        $examNo = strtotime(date('Y-m-d h:i:s'));
        if ($class == '') {
            $message['error'] = 'Class is required!';
        } else if ($course == '') {
            $message['error'] = 'Course is required!';
        } else {
            $student = filterData('students', 'true', 'Status', 'Class', $class);
            if ($student) {
                foreach ($student as $std) {
                    $data = [
                        'Student' => $std['ID'],
                        'ExamNo' => $examNo,
                        'Teacher' => 2,
                        'Exam' => $exam,
                        'Course' => $course,
                        'Class' => $class,
                        'Season' => $season
                    ];
                    $result = Insert('exam_marks', $data);
                }
                if ($result) {
                    $message['sucess'] = 'Thanks For Addin Exam Marks';
                    $_SESSION['class'] = $class;
                    $_SESSION['course'] = $course;
                    $_SESSION['examNo'] = $examNo;
                }
            }
        }
    }
}
// take attendance 
if (isset($_POST['examNo'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $examNo = filter_var($_POST['examNo'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($examNo == '') {
            $message['error'] = 'Attendance Number is required!';
        } else {
            $result = updateWithOutID('exam_marks', 'Submited', 'ExamNo', $examNo);
            if ($result) {
                $message['sucess'] = 'Thanks For Sumbited Exam Marks';
                $_SESSION['class'] = null;
                $_SESSION['course'] = null;
                $_SESSION['examNo'] = null;
            }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Exam Marks</h3>
            <p class="text-capitalize h6">home /<span> Exam Marks</span></p>
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
            <h4>All Exam Marks</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <?php if ($_SESSION['examNo']) : ?>
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input type="hidden" value="<?= $_SESSION['examNo'] ?>" name="examNo">
                    <button type="submit" class="btn btn-success" name="takeAttendance">Submit Marks</button>
                </form>
            <?php endif; ?>
            <?php if (!$_SESSION['examNo']) : ?>
                <button class="btn btn-primary" data-toggle="modal" data-target="#AddExamMarks">Add Exam Marks</button>
            <?php endif; ?>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Exam</th>
                    <th>Class</th>
                    <th>Course</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['examNo']) && isset($_SESSION['course'])) :
                    foreach (filterData('exam_marks', $_SESSION['examNo'], 'ExamNo', 'Course', $_SESSION['course']) as $examMark) :
                ?>
                        <tr>
                            <td><?= Escape($examMark['ID']); ?></td>
                            <td><?= Escape(Capitalize(getColumn('students', 'FullName', $examMark['Student']))); ?></td>
                            <td><?= Escape(Capitalize(getColumn('exams', 'Name', $examMark['Exam']))); ?></td>
                            <td><?= Escape(Capitalize(getColumn('classes', 'Name', $examMark['Class']))); ?></td>
                            <td><?= Escape(Capitalize(getColumn('courses', 'Name', $examMark['Course']))); ?></td>
                            <td><input type="number" class="border border-secondary rounded px-2" value="<?= Escape($examMark['Marks']); ?>" max="100" min="0" style="height: 40px; width:100px; outline:none; background:transparent;" onchange="updateMarks(<?= Escape($examMark['ID']); ?>,this)"></td>
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
    let clas = document.querySelector('#class');
    let courses = document.querySelector('#courses');
    // update status function 
    function updateMarks(id, event) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'exam_marks',
                value2: id,
                ID: 'ID',
                mark: 'Marks',
                value1: Number(event.value),
                action: 'updateWithOutID'
            },
            success: ((response) => {})
        })
    }
    clas.addEventListener('change', () => {
        updateCourse(clas.value);
    })
    // update courses function 
    function updateCourse(id) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'courses',
                column: 'Class',
                id: id,
                action: 'select'
            },
            success: ((response) => {
                const course = JSON.parse(response);
                courses.innerHTML = '<option value="" selected>Select Course</option>';
                for (let index = 0; index < course.length; index++) {
                    courses.innerHTML += `
                    <option value="${course[index]['ID']}">${course[index]['Name']}</option>
                    `;
                }
            })
        })
    }
</script>