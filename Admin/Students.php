<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Student.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-student'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        redirect('404.php');
    } else {

        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
        $dob = filter_var($_POST['dob'], FILTER_SANITIZE_SPECIAL_CHARS);
        $parent = filter_var($_POST['parent'], FILTER_SANITIZE_SPECIAL_CHARS);
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);

        $username = 'S' . mt_rand(10000, 99999);
        $password = mt_rand(100000, 999999);

        // uploading image 
        // $targetDir = 'Images/Parent/';
        // $photo = $_FILES['photo'];
        // $fileTemp = $photo['tmp_name'];
        // $imageType = strtolower(pathinfo($fileTemp, PATHINFO_EXTENSION));
        // $randomName = rand();
        // $extension = '.jpg';


        if ($name == '') {
            $message['error'] = 'name is required';
        } else {
            $data = [
                'FullName' => $name,
                'Address' => $address,
                'Phone' => $phone,
                'Parent' => $parent,
                'Gender' => $gender,
                'DOB' => $dob,
                'UserName' => $username,
                'Password' => $password,
                'Class' => $class,
                'Photo' => ''
            ];
            $result = Insert('students', $data);
            if ($result) {
                // move_uploaded_file($fileTemp, $targetDir . $randomName . $extension);
                $message['sucess'] = 'Thanks For Successfully Added';
            } else {
                $message['error'] = 'Added failed';
            }
        }
    }
}
// update 
if (isset($_POST['update-student'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
        $dob = filter_var($_POST['dob'], FILTER_SANITIZE_SPECIAL_CHARS);
        $parent = filter_var($_POST['parent'], FILTER_SANITIZE_SPECIAL_CHARS);
        $class = filter_var($_POST['class'], FILTER_SANITIZE_SPECIAL_CHARS);
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
        } else {
            $data = [
                'ID' => $id,
                'FullName' => $name,
                'Address' => $address,
                'Phone' => $phone,
                'Parent' => $parent,
                'Gender' => $gender,
                'DOB' => $dob,
                'Class' => $class,
                'UserName' => $username,
                'Password' => $password,
                'Photo' => ''
            ];
            $sql = Update('students', $data);
            if ($sql) {
                $message['sucess'] = 'Thanks For Student Updated';
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
            <h3 class="text-capitalize">Students</h3>
            <p class="text-capitalize h6">home /<span> Student</span></p>
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddStudent">Add New Student</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Class</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('students') as $student) : ?>
                    <tr>
                        <td><?= Escape($student['ID']); ?></td>
                        <td><?= Escape(Capitalize($student['FullName'])); ?></td>
                        <td><?= Escape(Capitalize($student['Address'])); ?></td>
                        <td><?= Escape(Capitalize(getColumn('classes', 'Name', $student['Class']))); ?></td>
                        <td><?= '+252 ' . Escape($student['Phone']); ?></td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" id="status" <?= Escape($student['Status'] ? 'checked' : ''); ?> onclick="updateStatus(<?= Escape($student['ID']); ?>,this)">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <a href="StudentDetails.php?studentid=<?php echo $student['ID']; ?>"><i class="fa-solid fa-eye" title="view"></i></a>
                        </td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateStudent" onclick="update('<?= Escape($student['ID']); ?>','<?= Escape($student['Parent']); ?>','<?= Escape($student['Class']); ?>')" title="edit"></i>
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
    const parents = document.querySelectorAll('.parent');
    const classes = document.querySelectorAll('.class');
    // update function 
    function update(id, parentid, clasid) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'students',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const student = JSON.parse(response);
                $('#id').val(student[0].ID);
                $('#name').val(student[0].FullName);
                $('#address').val(student[0].Address);
                $('#phone').val(student[0].Phone);
                $('#dob').val(student[0].DOB);
                $('#username').val(student[0].UserName);
                $('#password').val(student[0].Password);
                student[0].Gender == 'male' ? $('#gender input#maleupdate')[0].checked = true : $('#gender input#femaleupdate')[0].checked = true;

                parents.forEach((parent) => {
                    parent.value == parentid ? parent.selected = true : parent.selected = false;
                })
                classes.forEach((clas) => {
                    clas.value == clasid ? clas.selected = true : clas.selected = false;
                })
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
                    table: 'students',
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
                    table: 'students',
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