<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';

$studentid = 1;
$checkStudent = ReadSingle('students', $studentid, 'ID');
// if (isset($_GET['studentid']) && $_GET['studentid'] !== '' && $checkStudent) {
$allSchedule = array();
$class = $checkStudent[0]['Class'];
$activeSeason = 0;
foreach (ReadBolean('seasons', 'Status', 1) as $season) {
    $activeSeason = $season['ID'];
}
$days = selectDistinict('class_schedule', 'Day', 'Class', 'Season', $class, $activeSeason);
for ($i = 0; $i < count($days); $i++) {
    $allSchedule[] = selectScheduleCourses('class_schedule', 'Class', 'Season',  'Day', $class, $activeSeason, $days[$i]['Day']);
}
// echo '<pre>';
// print_r($allSchedule);
// } else {
//     redirect('404.php');
// }
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-4">
        <div class="info-pages mb-3">
            <h3 class="text-capitalize">student dashboard</h3>
            <p class="text-capitalize h6">home /<span> student schedule</span></p>
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
        <h4>Schedule</h4>
        <div class="row">
            <div class="accordion w-100 px-3" id="accordionExample">
                <?php
                for ($j = 0; $j < count($days); $j++) :
                ?>
                    <div class="card">
                        <div class="card-header bg-white" id="headingOne">
                            <h2 class="mb-0 h5 cursor-pointer">
                                <span class="btn-block text-left" data-toggle="collapse" data-target="#<?= Capitalize($days[$j]['Day']); ?>" aria-expanded="true" aria-controls="collapseOne">
                                    <?= Capitalize($days[$j]['Day']); ?>
                                </span>
                            </h2>
                        </div>
                        <div id="<?= Capitalize($days[$j]['Day']); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table text-nowrap my-4 table-hover table-striped table-hover w-100">
                                    <tr>
                                        <th>No.</th>
                                        <th>Course</th>
                                        <th>TimeStart</th>
                                        <th>TimeEnd</th>
                                    </tr>
                                    <?php
                                    for ($i = 0; $i < count($allSchedule[$j]); $i++) :
                                    ?>
                                        <tr>
                                            <td><?= $i + 1; ?></td>
                                            <td><?= getColumn('courses', 'Name', $allSchedule[$j][$i]['Course']); ?> </td>
                                            <td><?= filterDate('h:i:s a', $allSchedule[$j][$i]['TimeStart']); ?> </td>
                                            <td><?= filterDate('h:i:s a', $allSchedule[$j][$i]['TimeEnd']); ?> </td>
                                        </tr>
                                    <?php endfor; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>