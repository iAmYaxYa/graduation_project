<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Invoice.php';
// checkUserPrivileges 
checkUserPrivileges();

// insert 
if (isset($_POST['Add-invoice'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $invoice = filter_var($_POST['invoice'], FILTER_SANITIZE_SPECIAL_CHARS);
        $method = filter_var($_POST['method'], FILTER_SANITIZE_SPECIAL_CHARS);
        $account = filter_var($_POST['account'], FILTER_SANITIZE_SPECIAL_CHARS);
        $month = filter_var($_POST['month'], FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_var($_POST['price'], FILTER_SANITIZE_SPECIAL_CHARS);
        $season = filter_var($_POST['season'], FILTER_SANITIZE_SPECIAL_CHARS);
        $invoiceNo = strtotime(date('Y-m-d h:i:s'));
        if ($invoice == '') {
            $message['error'] = 'inv$invoice is required!';
        } else if ($method == 1) {
            $student = filter_var($_POST['student'], FILTER_SANITIZE_SPECIAL_CHARS);
            $class = getColumn('students', 'Class', $student);
            $data = [
                'Student' => $student,
                'Class' => $class,
                'InvoiceNo' => $invoiceNo,
                'Invoice' => $invoice,
                'Amount' => $price,
                'Account' => $account,
                'Month' => date('Y') . '-' . $month . '-' . date('d'),
                'Season' => $season,
                'User' => $_SESSION['id']
            ];
            $result = Insert('invoices', $data);
            if ($result) {
                $message['sucess'] = 'Thanks For Addin Exam Marks';
            }
        } else {
            $student = ReadAll('students');
            if ($student) {
                foreach ($student as $std) {
                    $data = [
                        'Student' => $std['ID'],
                        'Class' => $std['Class'],
                        'InvoiceNo' => $invoiceNo,
                        'Invoice' => $invoice,
                        'Amount' => $price,
                        'Account' => $account,
                        'Month' => date('Y') . '-' . $month . '-' . date('d'),
                        'Season' => $season,
                        'User' => $_SESSION['id']
                    ];
                    $result = Insert('invoices', $data);
                }
                if ($result) {
                    $message['sucess'] = 'Thanks For Addin Exam Marks';
                }
            }
        }
    }
}
// take attendance 
if (isset($_POST['paid-invoice'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        if ($phone == '') {
            $message['error'] = 'Phone Number is required!';
        } else {
            $data = [
                'ID' => $id,
                'Status' => 1,
                'Phone' => $phone,
                'Date' => date('Y-m-d')
            ];
            $result = update('invoices', $data);
            if ($result) {
                $message['sucess'] = 'Thanks For Succesfully Paid';
            }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Invoices</h3>
            <p class="text-capitalize h6">home /<span> Invoice</span></p>
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
            <h4>All Invoices</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddInvoice">Create Invoice</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Invoice</th>
                    <th>Class</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('invoices') as $invoice) : ?>
                    <tr>
                        <td><?= Escape($invoice['ID']); ?></td>
                        <td><?= Escape(Capitalize(getColumn('students', 'FullName', $invoice['Student']))); ?></td>
                        <td><?= Escape(Capitalize(getColumn('invoice_category', 'Name', $invoice['Invoice']))); ?></td>
                        <td><?= Escape(Capitalize(getColumn('classes', 'Name', $invoice['Class']))); ?></td>
                        <td><?= Escape(getPrice($invoice['Amount'])); ?></td>
                        <td><?= Escape(filterDate('F', $invoice['Month'])); ?></td>
                        <td> <?= getStatusAndExpire(Escape($invoice['Status']), 'Paid', 'Un Paid', 'success', 'danger'); ?></td>
                        <?php if ($invoice['Status'] !== 1) : ?>
                            <td>
                                <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#paidInvoice" onclick="update('<?= Escape($invoice['ID']); ?>','<?= getColumn('students', 'FullName', $invoice['Student']); ?>')" title="edit"></i>
                            </td>
                        <?php endif; ?>
                        <?php if ($invoice['Status'] === 1) : ?>
                            <td>
                                ...
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>

<script>
    let invoice = document.querySelector('#invoice');
    let student = document.querySelector('#student');
    // update function 
    function update(id, name) {
        $('#id').val(id);
        $('#name').val(name);
        // $.ajax({
        //     type: 'POST',
        //     url: '../includes/config/Api.php',
        //     data: {
        //         table: 'invoices',
        //         id: id,
        //         action: 'update'
        //     },
        //     success: ((response) => {
        //         const invoice = JSON.parse(response);

        //     })
        // })
    }
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
    invoice.addEventListener('change', () => {
        checkInoiceMethod(invoice.value)
    })
    // // update courses function 
    function checkInoiceMethod(id) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'invoice_category',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const invoce = JSON.parse(response);
                $('#method').val(invoce[0].Method);
                $('#price').val(invoce[0].Price);
                if (invoce[0].Method == 1) {
                    student.classList.add('d-block');
                } else {
                    student.classList.remove('d-block');
                }
            })
        })
    }
</script>