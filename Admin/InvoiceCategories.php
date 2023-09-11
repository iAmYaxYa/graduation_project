<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/InvoiceCategory.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-InvoiceCategory'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $method = filter_var($_POST['method'], FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_var($_POST['price'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'Name' => $name,
                'Method' => $method,
                'Price' => $price,
            ];
            $user = Insert('invoice_category', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            }
        }
    }
}
// update 
if (isset($_POST['update-InvoiceCategory'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $method = filter_var($_POST['method'], FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_var($_POST['price'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'ID' => $id,
                'Name' => $name,
                'Method' => $method,
                'Price' => $price,
            ];
            $user = Update('invoice_category', $data);
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
            <h3 class="text-capitalize">Invoice Categories</h3>
            <p class="text-capitalize h6">home /<span> Invoice Category</span></p>
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
            <h4>All Invoice Categories</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddInvoiceCategory">Add Invoice Categories</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('invoice_category') as $InvoiceCategory) : ?>
                    <tr>
                        <td><?= Escape($InvoiceCategory['ID']); ?></td>
                        <td><?= Escape(Capitalize($InvoiceCategory['Name'])); ?></td>
                        <td><?= Escape(getPrice($InvoiceCategory['Price'])); ?></td>
                        <td><?= Escape(Capitalize(getStatus($InvoiceCategory['Method'], 1, 'individual', 'All Students'))); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateInvoiceCategory" onclick="update('<?= Escape($InvoiceCategory['ID']); ?>','<?= Escape($InvoiceCategory['Method']); ?>')" title="edit"></i>
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
    const methods = document.querySelectorAll('.method');
    // update function 
    function update(id, methodid) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'invoice_category',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const clas = JSON.parse(response);
                $('#id').val(clas[0].ID);
                $('#name').val(clas[0].Name);
                $('#price').val(clas[0].Price);
                methods.forEach((method) => {
                    method.value == methodid ? method.selected = true : method.selected = false;
                })
            })
        })
    }
</script>