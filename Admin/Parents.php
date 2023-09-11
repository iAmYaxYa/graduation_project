<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Parent.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-parent'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        redirect('404.php');
    } else {

        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
        $occubation = filter_var($_POST['occubation'], FILTER_SANITIZE_SPECIAL_CHARS);

        $username = 'P' . mt_rand(10000, 99999);
        $password = mt_rand(100000, 999999);




        if ($name == '') {
            $message['error'] = 'name is required';
        } else {
            $data = [
                'FullName' => $name,
                'Address' => $address,
                'Phone' => $phone,
                'Email' => $email,
                'Gender' => $gender,
                'UserName' => $username,
                'Password' => $password,
                'Occubation' => $occubation,
                'Photo' => ''
            ];
            $result = Insert('parent', $data);
            if ($result) {
                $message['sucess'] = 'Thanks For Successfully Added';
            } else {
                $message['error'] = 'Added failed';
            }
        }
    }
}
// update 
if (isset($_POST['update-parent'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
        $occubation = filter_var($_POST['occubation'], FILTER_SANITIZE_SPECIAL_CHARS);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

        // uploading image 
        // $targetDir = 'Images/Employee/';
        // $photo = $_FILES['photo'];
        // $fileTemp = $photo['tmp_name'];
        // $imageType = strtolower(pathinfo($fileTemp, PATHINFO_EXTENSION));
        // $randomName = rand();
        // $extension = '.jpg';

        // $newImage = $_FILES['photo']['tmp_name'] ? $randomName . $extension : $image;


        if ($name == '') {
            $message['error'] = 'name is required';
        } else if ($gender == '') {
            $message[] = 'gender is required';
        } else if ($email == '') {
            $message[] = 'email is required';
        } else {
            $data = [
                'ID' => $id,
                'FullName' => $name,
                'Address' => $address,
                'Phone' => $phone,
                'Email' => $email,
                'Gender' => $gender,
                'UserName' => $username,
                'Password' => $password,
                'Occubation' => $occubation,
                'Photo' => ''
            ];
            $sql = Update('parent', $data);
            if ($sql) {
                $message['sucess'] = 'Thanks For Parent Updated';
            } else {
                $message['error'] = 'Update Failed';
            }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Parents</h3>
            <p class="text-capitalize h6">home /<span> Parent</span></p>
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
        </div>
        <div class="col-12">
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
            <h4>All Parents</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddParent">Add New Parent</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('parent') as $parent) : ?>
                    <tr>
                        <td><?= Escape($parent['ID']); ?></td>
                        <td><?= Escape(Capitalize($parent['FullName'])); ?></td>
                        <td><?= Escape(Capitalize($parent['Address'])); ?></td>
                        <td><?= '+252 ' . Escape($parent['Phone']); ?></td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" id="status" <?= Escape($parent['Status'] ? 'checked' : ''); ?> onclick="updateStatus(<?= Escape($parent['ID']); ?>,this)">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateParent" onclick="update('<?= Escape($parent['ID']); ?>')" title="edit"></i>
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
                table: 'parent',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const parent = JSON.parse(response);
                $('#id').val(parent[0].ID);
                // $('#emp-img').attr('src', 'Images/parent/' + photo);
                // $('#image').val(photo);
                $('#name').val(parent[0].FullName);
                $('#address').val(parent[0].Address);
                $('#phone').val(parent[0].Phone);
                $('#email').val(parent[0].Email);
                $('#occubation').val(parent[0].Occubation);
                $('#username').val(parent[0].UserName);
                $('#password').val(parent[0].Password);
                parent[0].Gender == 'male' ? $('#gender input#maleupdate')[0].checked = true : $('#gender input#femaleupdate')[0].checked = true;
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
                    table: 'parent',
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
                    table: 'parent',
                    id: id,
                    action: 'inactivestatus'
                },
                success: ((response) => {})
            })
        }
    }
</script>
<!-- show password  -->
<script>
    var eye = document.querySelector('.eye');
    var password = document.querySelector('#password');

    eye.addEventListener('click', () => {
        if (password.type == 'password') {
            password.type = 'text';
            eye.innerHTML = '<i class="fa-solid fa-eye">';
        } else {
            password.type = 'password';
            eye.innerHTML = '<i class="fa-solid fa-eye-slash">';
        }
    })
</script>