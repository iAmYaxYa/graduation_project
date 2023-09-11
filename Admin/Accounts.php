<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Account.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-account'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $account_no = filter_var($_POST['account-no'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else if ($account_no == '') {
            $message[] = 'account number is required';
        } else {
            $data = [
                'Name' => $name,
                'Acc_No' => $account_no,
            ];
            $user = Insert('bank', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            }
        }
    }
}
// update 
if (isset($_POST['update-account'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $account_no = filter_var($_POST['account-no'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else if ($account_no == '') {
            $message[] = 'account number is required';
        } else {
            $data = [
                'ID' => $id,
                'Name' => $name,
                'Acc_No' => $account_no,
            ];
            $user = Update('bank', $data);
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
            <h3 class="text-capitalize">accounts</h3>
            <p class="text-capitalize h6">home /<span> Accounts</span></p>
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
            <h4>All Users</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddAccount">Add Account</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Account No.</th>
                    <th>Balance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('bank') as $key => $bank) : ?>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= Escape($bank['ID']); ?></td>
                        <td><?= Escape(Capitalize($bank['Name'])); ?></td>
                        <td><?= Escape(Capitalize($bank['Acc_No'])); ?></td>
                        <td><?= Escape(getPrice($bank['Balance'])); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateAccount" onclick="update(<?= Escape($bank['ID']); ?>)" title="edit"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Account No.</th>
                    <th>Balance</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
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
                table: 'bank',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const accoun = JSON.parse(response);
                $('#id').val(accoun[0].ID);
                $('#name').val(accoun[0].Name);
                $('#accoun-no').val(accoun[0].Acc_No);
            })
        })
    }
</script>