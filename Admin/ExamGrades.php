<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/ExamGrade.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-exam-grade'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gradepoint = filter_var($_POST['gradePoint'], FILTER_SANITIZE_SPECIAL_CHARS);
        $percentageFrom = filter_var($_POST['percentageFrom'], FILTER_SANITIZE_SPECIAL_CHARS);
        $percentageEnd = filter_var($_POST['percentageUpto'], FILTER_SANITIZE_SPECIAL_CHARS);
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'Name' => $name,
                'GradePoint' => $gradepoint,
                'percentageFrom' => $percentageFrom,
                'percentageUpto' => $percentageEnd,
                'comment' => $comment
            ];
            $result = Insert('exam_grade', $data);
            if ($result) {
                $message['sucess'] = 'Thanks For Successfully Added';
            } else {
                $message['error'] = 'Added Failed';
            }
        }
    }
}
// update 
if (isset($_POST['update-exam-grade'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gradepoint = filter_var($_POST['gradePoint'], FILTER_SANITIZE_SPECIAL_CHARS);
        $percentageFrom = filter_var($_POST['percentageFrom'], FILTER_SANITIZE_SPECIAL_CHARS);
        $percentageEnd = filter_var($_POST['percentageUpto'], FILTER_SANITIZE_SPECIAL_CHARS);
        $comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'ID' => $id,
                'Name' => $name,
                'GradePoint' => $gradepoint,
                'percentageFrom' => $percentageFrom,
                'percentageUpto' => $percentageEnd,
                'comment' => $comment
            ];
            $result = Update('exam_grade', $data);
            if ($result) {
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
            <p class="text-capitalize h6">home /<span> Exam Grade</span></p>
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
            <h4>All Exam Grades</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddExamGrade">Add Exam Grade</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Grade Point</th>
                    <th>percentage From</th>
                    <th>percentage Upto</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('exam_grade') as $examGrade) : ?>
                    <tr>
                        <td><?= Escape($examGrade['ID']); ?></td>
                        <td><?= Escape(Capitalize($examGrade['Name'])); ?></td>
                        <td><?= Escape(Capitalize($examGrade['GradePoint'])); ?></td>
                        <td><?= Escape(Capitalize($examGrade['percentageFrom'])) . '%'; ?></td>
                        <td><?= Escape(Capitalize($examGrade['percentageUpto'])) . '%'; ?></td>
                        <td><?= Escape(Capitalize($examGrade['Comment'])); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateExamGrade" onclick="update('<?= Escape($examGrade['ID']); ?>','<?= Escape($examGrade['GradePoint']); ?>')" title="edit"></i>
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
    const points = document.querySelectorAll('.point');
    // update function 
    function update(id, pointid) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'exam_grade',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const examGrade = JSON.parse(response);
                $('#id').val(examGrade[0].ID);
                $('#name').val(examGrade[0].Name);
                $('#percentageFrom').val(examGrade[0].percentageFrom);
                $('#percentageUpto').val(examGrade[0].percentageUpto);
                $('#comment').val(examGrade[0].Comment);
                points.forEach((point) => {
                    if (point.value == pointid) {
                        console.log('yes');
                    }
                    point.value == pointid ? point.selected = true : point.selected = false;
                })
            })
        })
    }
</script>