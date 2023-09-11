<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Course.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-course'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'Name' => $name,
                'Class' => $class,
            ];
            $user = Insert('courses', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            }
        }
    }
}
// update 
if (isset($_POST['update-course'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'ID' => $id,
                'Name' => $name,
                'Class' => $class,
            ];
            $user = Update('courses', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            }
        }
    }
}

?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Courses</h3>
            <p class="text-capitalize h6">home /<span> Course</span></p>
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
            <h4>All Course</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddCourse">Add Course</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('courses') as $course) : ?>
                    <tr>
                        <td><?= Escape($course['ID']); ?></td>
                        <td><?= Escape(Capitalize($course['Name'])); ?></td>
                        <td><?= Escape(Capitalize(getColumn('classes', 'Name', $course['Class']))); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateCourse" onclick="update('<?= Escape($course['ID']); ?>','<?= Escape($course['Class']); ?>')" title="edit"></i>
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
    const clas = document.querySelectorAll('.class');
    // update function 
    function update(id, classid) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'courses',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const course = JSON.parse(response);
                $('#id').val(course[0].ID);
                $('#name').val(course[0].Name);
                clas.forEach((cls) => {
                    cls.value == classid ? cls.selected = true : cls.selected = false;
                })
            })
        })
    }
</script>