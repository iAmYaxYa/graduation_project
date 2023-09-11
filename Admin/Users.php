<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/User.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-user'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $links = array();
        $courses = array();
        $classes = array();
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
        $employee = filter_var($_POST['employee'], FILTER_SANITIZE_SPECIAL_CHARS);


        foreach (ReadAll('links') as $link) {
            if (isset($_POST[spaceOut($link['text'])])) {
                $links[] = Escape($link['ID']);
            }
        }
        $username = str_replace(' ', '', Escape($_POST['username']));
        $user = ReadSingle('user', $username, 'UserName');


        if ($user) {
            $message['error'] = 'User Has All Ready Registred';
        } else {
            if ($username == '') {
                $message['error'] = 'username is required';
            } else if (!$links && $username) {
                $message['warning'] = 'This User Has No Privileges!';
                $previleges = implode(',', $links);
                $data = [
                    'ID' => $employee,
                    'UserName' => $username,
                    'Password' => password_hash($password, PASSWORD_DEFAULT),
                    'Privileges' => $previleges,
                ];
                $user = Insert('User', $data);
                if ($user) {
                    $message['sucess'] = 'Thanks For Successfully Added';
                }
            } else if ($username && $links) {
                $previleges = implode(',', $links);
                $data = [
                    'ID' => $employee,
                    'UserName' => $username,
                    'Password' => password_hash($password, PASSWORD_DEFAULT),
                    'Privileges' => $previleges,
                ];
                $user = Insert('User', $data);
                if ($user) {
                    $message['sucess'] = 'Thanks For Successfully Added';
                }
            }
        }
    }
}
// update 
if (isset($_POST['update-user'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $links = array();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        foreach (ReadAll('links') as $link) {
            if (isset($_POST[spaceOut($link['text'])])) {
                $links[] = Escape($link['ID']);
            }
        }
        if (!$links) {
            $message['warning'] = 'This User Has No Privileges!';
            $previleges = implode(',', $links);
            $data = [
                'ID' => $id,
                'Privileges' => $previleges,
            ];
            $sql = Update('user', $data);
            if ($sql) {
                $message['sucess'] = 'User Privilages Was Updated';
            } else {
                $message['error'] = 'User Update Was Failed';
            }
        }
        if ($links) {
            $previleges = implode(',', $links);
            $data = [
                'ID' => $id,
                'Privileges' => $previleges,
            ];
            $sql = Update('user', $data);
            if ($sql) {
                $message['sucess'] = 'User Privilage Was Updated';
            } else {
                $message['danger'] = 'Delete Failed';
            }
        }
    }
}
// delete 
if (isset($_POST['delete-user'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = Delete('user', $id);
        if ($sql) {
            $message['sucess'] = 'Thanks For User Deleted';
        } else {
            $message['danger'] = 'Delete Failed';
        }
    }
}

?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">users</h3>
            <p class="text-capitalize h6">home /<span> Users</span></p>
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
            <h4>All Users</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddUser">Add User</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Pervileges</th>
                    <th>More</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('User') as $key => $user) : ?>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= Escape($user['ID']); ?></td>
                        <td><?= Escape(Capitalize($user['UserName'])); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateUser" onclick="Update('<?= Escape($user['ID']); ?>','<?= Escape($user['Privileges']); ?>')"></i>
                        </td>
                        <td>
                            <i class="fa fa-trash btn btn-danger" data-toggle="modal" data-target="#deleteUser" onclick="Delete(<?= Escape($user['ID']); ?>)" title="delete"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Previleges</th>
                    <th>More</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>

<script>
    let checkboxes = document.querySelectorAll('.checkboxes');
    // update function 
    function Update(id, privileges) {
        checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
        })
        if (privileges == '') {
            privileges = 200;
        }
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'links',
                id: privileges,
                action: 'getlinks'
            },
            success: ((response) => {
                const links = JSON.parse(response);
                $('#updateUser #updateid').val(id);
                for (let i = 0; i < checkboxes.length; i++) {
                    for (let j = 0; j < links.length; j++) {
                        if (checkboxes[i].value == links[j].ID) {
                            checkboxes[i].checked = true;
                        }
                    }
                }
            })
        })
    }
    // update function 
    function Delete(id) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'user',
                id: id,
                action: 'delete'
            },
            success: ((response) => {
                const user = JSON.parse(response);
                $('#deleteid').val(user[0].ID);
                $('#deleteUser #name')[0].innerText = user[0].UserName;
            })
        })
    }
</script>