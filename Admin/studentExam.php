<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';

$studentid = $_SESSION['id'];
$checkStudent = ReadSingle('students', $studentid, 'ID');
if (isset($_SESSION['id']) && $checkStudent) {
    $allExams = array();
    $class = $checkStudent[0]['Class'];
    $activeSeason = 0;
    // echo '<br>';
    // echo '<br>';
    // echo '<br>';
    // echo '<br>';
    // echo '<br>';
    // echo '<br>';
    foreach (ReadBolean('seasons', 'Status', 1) as $season) {
        $activeSeason = $season['ID'];
    }
    $classes = selectDistinictClass('exam_marks', 'Class', 'Student', $studentid);
    for ($i = 0; $i < count($classes); $i++) {
        $allExams[] = selectStudentMarks($classes[$i]['Class'], $studentid);
    }
    // echo '<pre>';
    // print_r($allExams);
} else {
    redirect('404.php');
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-4">
        <div class="info-pages mb-3">
            <h3 class="text-capitalize">student dashboard</h3>
            <p class="text-capitalize h6">home /<span> student Exams</span></p>
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
        <h4>Exams</h4>
        <div class="row">
            <?php
            for ($j = 0; $j < count($classes); $j++) :
            ?>
                <div class="col-md-6 p-2">
                    <div class="card">
                        <div class="card-header bg-primary" id="headingOne">
                            <h2 class="mb-0 h5 cursor-pointer text-white">
                                <?= Capitalize(getColumn('classes', 'Name', $classes[$j]['Class'])); ?>
                            </h2>
                        </div>
                        <div class="card-body">
                            <table class="table text-nowrap my-4 table-hover table-striped table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Course</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < count($allExams[$j]); $i++) :
                                    ?>
                                        <tr>
                                            <td><?= $i + 1; ?></td>
                                            <td><?= getColumn('courses', 'Name', $allExams[$j][$i]['Course']); ?> </td>
                                            <td><?= Escape($allExams[$j][$i]['Total']); ?> </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                                <tfoot>
                                    <?php
                                    $subTotal = 0;
                                    for ($i = 0; $i < count($allExams[$j]); $i++) {
                                        $subTotal += $allExams[$j][$i]['Total'];
                                    }
                                    $yourGrade = '';
                                    $average =  $subTotal / count($allExams[$j]);
                                    $grades = ReadAll('exam_grade');
                                    if ($grades) {
                                        for ($i = 0; $i < count($grades); $i++) {
                                            if ($average >= $grades[$i]['percentageFrom'] && $average <= $grades[$i]['percentageUpto']) {
                                                $yourGrade = $grades[$i]['Name'];
                                            }
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2">TOTAL</td>
                                        <td><?= $subTotal; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Grade</td>
                                        <td><?= $yourGrade; ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endfor;
            ?>
        </div>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>