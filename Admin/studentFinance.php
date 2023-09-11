<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';

$studentid = $_SESSION['id'];
$checkStudent = ReadSingle('students', $studentid, 'ID');
if (isset($_SESSION['id']) && $checkStudent) {
    $studentInvoices = ReadSingle('invoices', $studentid, 'Student');
    $balance = 0;
    foreach ($studentInvoices as $invoice) {
        $balance = $invoice['Status'] == 1 ? $balance = 0 : $balance += $invoice['Amount'];
    }
} else {
    redirect('404.php');
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row">
        <div class="info-pages mb-3">
            <h3 class="text-capitalize">student dashboard</h3>
            <p class="text-capitalize h6">dashboard /<span> Finance</span></p>
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
        <h4>Finance</h4>
        <div class="row">
            <div class="table-responsive mb-4 text-nowrap">
                <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Invoice Type</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($studentInvoices as $studentinvoice) : ?>
                            <tr>
                                <td><?= Escape($studentinvoice['ID']); ?></td>
                                <td><?= Escape(Capitalize(getColumn('invoice_category', 'Name', $studentinvoice['Invoice']))); ?></td>
                                <td><?= Escape(Capitalize(filterDate('Y-m-d', $studentinvoice['Date']))); ?></td>
                                <td><?= Escape(getPrice($studentinvoice['Amount'])); ?></td>
                                <td><?= getStatusAndExpire(Escape($studentinvoice['Status']), 'Paid', 'Un Paid', 'success', 'danger'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Balance</td>
                            <td><?= $balance > 0 ? '- ' . getPrice($balance) : getPrice($balance); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>