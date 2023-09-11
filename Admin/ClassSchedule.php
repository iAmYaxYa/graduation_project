<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/ClassSchedul.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['make-class'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $course = filter_var($_POST['course'], FILTER_SANITIZE_SPECIAL_CHARS);
        $timeStart = filter_var($_POST['timeStart'], FILTER_SANITIZE_SPECIAL_CHARS);
        $timeEnd = filter_var($_POST['timeEnd'], FILTER_SANITIZE_SPECIAL_CHARS);
        $day = filter_var($_POST['day'], FILTER_SANITIZE_SPECIAL_CHARS);
        $season = filter_var($_POST['season'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($class == '') {
            $message[] = 'Class is required';
        } else {
            $data = [
                'Class' => $class,
                'Day' => $day,
                'TimeStart' => $timeStart,
                'TimeEnd' => $timeEnd,
                'Season' => $season,
                'Course' => $course,
            ];
            $result = Insert('class_schedule', $data);
            if ($result) {
                $message['sucess'] = 'Thanks For Successfully Added';
            }
        }
    }
}
// update 
if (isset($_POST['update-class'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $course = filter_var($_POST['course'], FILTER_SANITIZE_SPECIAL_CHARS);
        $timeStart = filter_var($_POST['timeStart'], FILTER_SANITIZE_SPECIAL_CHARS);
        $timeEnd = filter_var($_POST['timeEnd'], FILTER_SANITIZE_SPECIAL_CHARS);
        $day = filter_var($_POST['day'], FILTER_SANITIZE_SPECIAL_CHARS);
        $season = filter_var($_POST['season'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($class == '') {
            $message[] = 'class is required';
        } else {
            $data = [
                'ID' => $id,
                'Class' => $class,
                'Day' => $day,
                'TimeStart' => $timeStart,
                'TimeEnd' => $timeEnd,
                'Course' => $course,
            ];
            $result = Update('class_schedule', $data);
            if ($result) {
                $message['sucess'] = 'Thanks For Successfully Updated';
            }
        }
    }
}

?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Classes</h3>
            <p class="text-capitalize h6">home /<span> Class schedule</span></p>
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
            <h4>All Classes</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#MakeClass">Make Class Schedule</button>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example" class="table text-nowrap my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Class</th>
                    <th>Day</th>
                    <th>Course</th>
                    <th>TimeStart</th>
                    <th>TimeEnd</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('class_schedule') as $class) : ?>
                    <tr>
                        <td><?= Escape($class['ID']); ?></td>
                        <td><?= Escape(Capitalize(getColumn('classes', 'Name', $class['Class']))); ?></td>
                        <td><?= Escape(Capitalize($class['Day'])); ?></td>
                        <td><?= Escape(Capitalize(getColumn('courses', 'Name', $class['Course']))); ?></td>
                        <td><?= Escape(filterDate('h:i:s a', $class['TimeStart'])); ?></td>
                        <td><?= Escape(filterDate('h:i:s a', $class['TimeEnd'])); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateClassSchedule" onclick="update('<?= Escape($class['ID']); ?>','<?= Escape($class['Class']); ?>','<?= Escape($class['Day']); ?>')" title="edit"></i>
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
    let clas = document.querySelector('#class');
    let courses = document.querySelector('#courses');
    const allClasses = document.querySelectorAll('.classes');
    const allCourses = document.querySelectorAll('.courses');
    const allDays = document.querySelectorAll('.day');
    // update function 
    function update(id, classid, dayid) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'class_schedule',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const clasSchedule = JSON.parse(response);
                $('#id').val(clasSchedule[0].ID);
                $('#timeStart').val(clasSchedule[0].TimeStart);
                $('#timeEnd').val(clasSchedule[0].TimeEnd);
                allClasses.forEach((clase) => {
                    clase.value == classid ? clase.selected = true : clase.selected = false;
                })
                allDays.forEach((day) => {
                    day.value == dayid ? day.selected = true : day.selected = false;
                })
                allCourses.forEach((course) => {
                    course.value == clasSchedule[0].Course ? course.selected = true : course.selected = false;
                })
            })
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