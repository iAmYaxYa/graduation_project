<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/ExamType.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-exam'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'Name' => $name
            ];
            $user = Insert('exams', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            } else {
                $message['error'] = 'Added Failed';
            }
        }
    }
}
// update 
if (isset($_POST['update-exam'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'ID' => $id,
                'Name' => $name
            ];
            $user = Update('exams', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            } else {
                $message['error'] = 'Updated Failed';
            }
        }
    }
}

?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Exam</h3>
            <p class="text-capitalize h6">home /<span> Create Exam</span></p>
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
            <h4>All Exams</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddExam">Add Exam</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('exams') as $exam) : ?>
                    <tr>
                        <td><?= Escape($exam['ID']); ?></td>
                        <td><?= Escape(Capitalize($exam['Name'])); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateExam" onclick="update(<?= Escape($exam['ID']); ?>)" title="edit"></i>
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
    // update function 
    function update(id) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'exams',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const exam = JSON.parse(response);
                $('#id').val(exam[0].ID);
                $('#name').val(exam[0].Name);
            })
        })
    }
</script>