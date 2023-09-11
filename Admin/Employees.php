<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Employee.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-employee'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        redirect('404.php');
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
        $jobTitle = filter_var($_POST['job_title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);

        // uploading image 
        $targetDir = 'Images/Employee/';
        $photo = $_FILES['photo'];
        $fileTemp = $photo['tmp_name'];
        $imageType = strtolower(pathinfo($fileTemp, PATHINFO_EXTENSION));
        $randomName = rand();
        $extension = '.jpg';

        if ($name == '') {
            $message[] = 'name is required';
        } else if ($gender == '') {
            $message[] = 'gender is required';
        } else if ($email == '') {
            $message[] = 'email is required';
        } else {
            $data = [
                'FullName' => $name,
                'Address' => $address,
                'Phone' => $phone,
                'Email' => $email,
                'Gender' => $gender,
                'JobTitle' => $jobTitle,
                'Photo' => $randomName . $extension
            ];
            $user = Insert('employee', $data);
            if ($user) {
                move_uploaded_file($fileTemp, $targetDir . $randomName . $extension);
                $message['sucess'] = 'Thanks For Successfully Added';
            } else {
                $message['error'] = 'Added failed';
            }
        }
    }
}
// update 
if (isset($_POST['update-employee'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
        $jobTitle = filter_var($_POST['job_title'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
        $image = filter_var($_POST['image'], FILTER_SANITIZE_SPECIAL_CHARS);

        // uploading image 
        $targetDir = 'Images/Employee/';
        $photo = $_FILES['photo'];
        $fileTemp = $photo['tmp_name'];
        $imageType = strtolower(pathinfo($fileTemp, PATHINFO_EXTENSION));
        $randomName = rand();
        $extension = '.jpg';

        $newImage = $_FILES['photo']['tmp_name'] ? $randomName . $extension : $image;
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
                'JobTitle' => $jobTitle,
                'Photo' => $newImage
            ];
            $sql = Update('employee', $data);
            if ($sql) {
                move_uploaded_file($fileTemp, $targetDir . $newImage);
                $message['sucess'] = 'Thanks For Employee Updated';
                if ($newImage !== $image) {
                    unlink('Images/Employee/' . $image);
                }
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
            <h3 class="text-capitalize">Employees</h3>
            <p class="text-capitalize h6">home /<span> Employees</span></p>
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddEmployee">Add New Employee</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>User</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Jobtitle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('employee') as $key => $employee) : ?>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td><?= Escape($employee['ID']); ?></td>
                        <td><?= Escape(Capitalize($employee['FullName'])); ?></td>
                        <td><?= Escape(checkUser($employee['User'])); ?></td>
                        <td><img src="Images/Employee/<?= $employee['Photo']; ?>" class="emp-img" alt="<?= $employee['FullName']; ?>"></td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" id="status" <?= Escape($employee['Status'] ? 'checked' : ''); ?> onclick="updateStatus(<?= Escape($employee['ID']); ?>,this)">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td><?= Escape($employee['Address']); ?></td>
                        <td><?= "+252 " . Escape($employee['Phone']); ?></td>
                        <td><?= Escape($employee['Email']); ?></td>
                        <td><?= Escape(Capitalize($employee['Gender'])); ?></td>
                        <td><?= Escape($employee['JobTitle']); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateEmployee" onclick="update('<?= Escape($employee['ID']); ?>','<?= Escape($employee['Photo']); ?>')" title="edit"></i>
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
    function update(id, photo) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'employee',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const employee = JSON.parse(response);
                $('#id').val(employee[0].ID);
                $('#emp-img').attr('src', 'Images/Employee/' + photo);
                $('#image').val(photo);
                $('#name').val(employee[0].FullName);
                $('#address').val(employee[0].Address);
                $('#phone').val(employee[0].Phone);
                $('#email').val(employee[0].Email);
                employee[0].Gender == 'male' ? $('#gender input#maleupdate')[0].checked = true : $('#gender input#femaleupdate')[0].checked = true;
                $('#jobtitle').val(employee[0].JobTitle);
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
                    table: 'employee',
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
                    table: 'employee',
                    id: id,
                    action: 'inactivestatus'
                },
                success: ((response) => {})
            })
        }
    }
</script>