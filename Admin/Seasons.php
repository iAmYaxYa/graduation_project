<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Season.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-season'])) {
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
            $user = Insert('seasons', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            }
        }
    }
}
// update 
if (isset($_POST['update-season'])) {
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
                'Name' => $name,
            ];
            $user = Update('seasons', $data);
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
            <h3 class="text-capitalize">Season</h3>
            <p class="text-capitalize h6">home /<span> Season</span></p>
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
            <h4>All Season</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddSeason">Add Season</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('seasons') as $season) : ?>
                    <tr>
                        <td><?= Escape($season['ID']); ?></td>
                        <td><?= Escape(Capitalize($season['Name'])); ?></td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" id="status" <?= Escape($season['Status'] ? 'checked' : ''); ?> onclick="updateStatus(<?= Escape($season['ID']); ?>,this)">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateSeason" onclick="update(<?= Escape($season['ID']); ?>)" title="edit"></i>
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
                table: 'seasons',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const section = JSON.parse(response);
                $('#id').val(section[0].ID);
                $('#name').val(section[0].Name);
            })
        })
    }
    // update status function 
    function updateStatus(id, event) {
        if (event.checked) {
            $.ajax({
                type: 'POST',
                url: '../includes/config/Api.php',
                data: {
                    table: 'seasons',
                    id: id,
                    action: 'activestatus'
                },
                success: ((response) => {})
            })
        }
        if (!event.checked) {
            $.ajax({
                type: 'POST',
                url: '../includes/config/Api.php',
                data: {
                    table: 'seasons',
                    id: id,
                    action: 'inactivestatus'
                },
                success: ((response) => {})
            })
        }
    }
</script>