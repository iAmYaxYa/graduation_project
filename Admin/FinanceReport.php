<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';
// checkUserPrivileges
checkUserPrivileges();


$FinanceReport = $FinanceReport ?? array();
// insert
if (isset($_POST['generateFinance'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        redirect('404.php');
    } else {
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
        $season = filter_var($_POST['season'], FILTER_SANITIZE_SPECIAL_CHARS);
        if ($class == '') {
            $message['error'] = 'Class is required!';
        } else {
            $student = generateReportInovie('invoices', Escape($class), Escape($season));
            if ($student) {
                $FinanceReport = $student;
            } else {
                $FinanceReport = array();
            }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Reports</h3>
            <p class="text-capitalize h6">Report /<span> Finance Report</span></p>
        </div>
    </div>
    <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="row my-4">
            <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
            <div class="col-lg-8 col-md-6">
                <select name="class" class="form-control" required>
                    <option value="" selected>Select Class</option>
                    <?php foreach (ReadAll('classes') as $class) : ?>
                        <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php foreach (ReadBolean('seasons', 'Status', 1) as $season) : ?>
                    <input type="hidden" name="season" class="form-control" value="<?= $season['ID']; ?>">
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4 mt-3 mt-0 mt-lg-0 col-md-6 text-left text-md-right">
                <button type="submit" class="btn btn-primary w-100" name="generateFinance">Generate Report</button>
            </div>
        </div>
    </form>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Invoice</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($FinanceReport)) :
                    foreach ($FinanceReport as $Finance) :
                ?>
                        <tr>
                            <td><?= Escape($Finance['ID']); ?></td>
                            <td><?= Escape(Capitalize(getColumn('students', 'FullName', $Finance['Student']))); ?></td>
                            <td><?= Escape(Capitalize(getColumn('invoice_category', 'Name', $Finance['Invoice']))); ?></td>
                            <td><?= Escape(Capitalize(getPrice($Finance['Amount']))); ?></td>
                            <td><?= Escape(filterDate('F-Y-d', $Finance['Date'])); ?></td>
                            <td> <?= getStatusAndExpire(Escape($Finance['Status']), 'Paid', 'UN Paid', 'success', 'danger'); ?></td>
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