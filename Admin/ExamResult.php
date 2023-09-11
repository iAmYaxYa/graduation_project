<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';
// checkUserPrivileges 
checkUserPrivileges();

// insert 
if (isset($_POST['Add-ExamResult'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        redirect('404.php');
    } else {
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $season = filter_var($_POST['season'], FILTER_SANITIZE_SPECIAL_CHARS);
        if ($class == '') {
            $message['error'] = 'Class is required!';
        } else {
            $examMarks = selectStudentMarks($class, $season);
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<pre>';
            print_r($examMarks);
            echo $class;
            // if ($student) {
            //     foreach ($student as $std) {
            //         $data = [
            //             'Student' => $std['ID'],
            //             'ExamNo' => $examNo,
            //             'Teacher' => 2,
            //             'Exam' => $exam,
            //             'Course' => $course,
            //             'Class' => $class,
            //             'Season' => $season
            //         ];
            //         echo '<br>';
            //         echo '<br>';
            //         echo '<br>';
            //         echo '<br>';
            //         echo '<br>';
            //         echo '<pre>';
            //         print_r($data);
            //         $result = Insert('exam_marks', $data);
            //     }
            //     if ($result) {
            //         $message['sucess'] = 'Thanks For Addin Exam Marks';
            //         $_SESSION['Class'] = $class;
            //         $_SESSION['course'] = $course;
            //         $_SESSION['examNo'] = $examNo;
            //     }
            // }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <i class="bx bxs-bar-char-alt-2"></i>
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Exam Results</h3>
            <p class="text-capitalize h6">home /<span> Exam Results</span></p>
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
    </div>
    <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="row my-4">
            <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
            <div class="col-lg-8 col-md-6">
                <select name="class" class="form-control" required="required">
                    <option value="" selected>Select Class</option>
                    <?php foreach (ReadAll('classes') as $class) : ?>
                        <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php foreach (ReadBolean('seasons', 'Status', 1) as $season) : ?>
                    <input type="hidden" name="season" class="form-control" value="<?= $season['ID']; ?>">
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4 mt-3 mt-0 mt-md-0 col-md-6 text-left text-md-right">
                <button type="submit" class="btn btn-primary w-100" name="Add-ExamResult">Make Exam Result</button>
            </div>
        </div>
    </form>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>