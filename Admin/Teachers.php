<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Teacher.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-teacher'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        redirect('404.php');
    } else {
        $links = array();
        $courses = array();
        $classes = array();

        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);

        // uploading image 
        $targetDir = 'Images/Teacher/';
        $photo = $_FILES['photo'];
        $fileTemp = $photo['tmp_name'];
        $imageType = strtolower(pathinfo($fileTemp, PATHINFO_EXTENSION));
        $randomName = rand();
        $extension = '.jpg';

        // check username
        $username = 'T' . mt_rand(10000, 99999);
        $password = mt_rand(100000, 999999);

        // read links 
        foreach (ReadAll('links') as $link) {
            if (isset($_POST[spaceOut($link['text'])])) {
                $links[] = Escape($link['ID']);
            }
        }
        // read courses
        foreach (ReadAll('courses') as $course) {
            if (isset($_POST[spaceOut($course['Name'])])) {
                $courses[] = $course['ID'];
            }
        }
        // read classes
        foreach (ReadAll('classes') as $class) {
            if (isset($_POST[spaceOut($class['Name'])])) {
                $classes[] = Escape($class['ID']);
            }
        }
        if ($name == '') {
            $message['error'] = 'name is required';
        } else {
            $previleges = implode(',', $links);
            $allClasses = implode(',', $classes);
            $allCourses = implode(',', $courses);
            $data = [
                'FullName' => $name,
                'Address' => $address,
                'Phone' => $phone,
                'Email' => $email,
                'Gender' => $gender,
                'UserName' => $username,
                'Password' => $password,
                'Courses' => $allCourses,
                'Classes' => $allClasses,
                'Privileges' => $previleges,
                'Photo' => $randomName . $extension
            ];
            $result = Insert('teachers', $data);
            if ($result) {
                move_uploaded_file($fileTemp, $targetDir . $randomName . $extension);
                $message['sucess'] = 'Thanks For Successfully Added';
            } else {
                $message['error'] = 'Added failed';
            }
        }
    }
}
// update 
if (isset($_POST['update-teacher'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
        $image = filter_var($_POST['image'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
        $oldusername = filter_var($_POST['oldusername'], FILTER_SANITIZE_SPECIAL_CHARS);

        // uploading image 
        $targetDir = 'Images/Employee/';
        $photo = $_FILES['photo'];
        $fileTemp = $photo['tmp_name'];
        $imageType = strtolower(pathinfo($fileTemp, PATHINFO_EXTENSION));
        $randomName = rand();
        $extension = '.jpg';

        $newImage = $_FILES['photo']['tmp_name'] ? $randomName . $extension : $image;


        // check username
        $userName = spaceOut($username);
        $user = ReadSingle('teachers', $userName, 'UserName');
        if ($user && $username !== $oldusername) {
            $message['error'] = 'User Name Has All Ready Taken';
        } else {
            if ($name == '') {
                $message['error'] = 'name is required';
            } else if ($gender == '') {
                $message[] = 'gender is required';
            } else if ($email == '') {
                $message[] = 'email is required';
            } else if (!$password == '') {
                $data = [
                    'ID' => $id,
                    'FullName' => $name,
                    'Address' => $address,
                    'Phone' => $phone,
                    'Email' => $email,
                    'Gender' => $gender,
                    'UserName' => $userName,
                    'Password' => $password,
                    'Photo' => $newImage
                ];
                $sql = Update('teachers', $data);
                if ($sql) {
                    move_uploaded_file($fileTemp, $targetDir . $newImage);
                    $message['sucess'] = 'Thanks For Teacher Updated';
                    if ($newImage !== $image) {
                        unlink('Images/Teacher/' . $image);
                    }
                } else {
                    $message['error'] = 'Update Failed';
                }
            } else {
                $data = [
                    'ID' => $id,
                    'FullName' => $name,
                    'Address' => $address,
                    'Phone' => $phone,
                    'Email' => $email,
                    'Gender' => $gender,
                    'UserName' => $userName,
                    'Photo' => $newImage
                ];
                $sql = Update('teachers', $data);
                if ($sql) {
                    move_uploaded_file($fileTemp, $targetDir . $newImage);
                    $message['sucess'] = 'Thanks For Teacher Updated';
                    if ($newImage !== $image) {
                        unlink('Images/Teacher/' . $image);
                    }
                } else {
                    $message['error'] = 'Update Failed';
                }
            }
        }
    }
}
// update classes 
if (isset($_POST['update-classes'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $classes = array();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);

        foreach (ReadAll('classes') as $link) {
            if (isset($_POST[spaceOut($link['Name'])])) {
                $classes[] = Escape($link['ID']);
            }
        }
        if ($classes) {
            $allClasses = implode(',', $classes);
            $data = [
                'ID' => $id,
                'Classes' => $allClasses,
            ];
            $sql = Update('teachers', $data);
            if ($sql) {
                $message['sucess'] = 'Teacher Classes Was Updated';
            } else {
                $message['error'] = 'Teacher Update Was Failed';
            }
        } else {
            $message['warning'] = 'This Teacher Has No Classes!';
            $allClasses = implode(',', $classes);
            $data = [
                'ID' => $id,
                'Classes' => $allClasses,
            ];
            $sql = Update('teachers', $data);
            if ($sql) {
                $message['sucess'] = 'Teacher Classes Was Updated';
            } else {
                $message['error'] = 'Teacher Update Was Failed';
            }
        }
    }
}
// update Courses 
if (isset($_POST['update-courses'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $courses = array();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);

        foreach (ReadAll('courses') as $course) {
            if (isset($_POST[spaceOut($course['Name'])])) {
                $courses[] = Escape($course['ID']);
            }
        }
        if ($courses) {
            $allcourses = implode(',', $courses);
            $data = [
                'ID' => $id,
                'Courses' => $allcourses,
            ];
            $sql = Update('teachers', $data);
            if ($sql) {
                $message['sucess'] = 'Teacher courses Was Updated';
            } else {
                $message['error'] = 'Teacher Update Was Failed';
            }
        } else {
            $message['warning'] = 'This Teacher Has No courses!';
            $message['warning'] = 'This Teacher Has No courses!';
            $allCourses = implode(',', $courses);
            $data = [
                'ID' => $id,
                'Courses' => $allCourses,
            ];
            $sql = Update('teachers', $data);
            if ($sql) {
                $message['sucess'] = 'Teacher Courses Was Updated';
            } else {
                $message['error'] = 'Teacher Update Was Failed';
            }
        }
    }
}
// update Privileges 
if (isset($_POST['update-privileges'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $privileges = array();
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);

        foreach (ReadAll('links') as $link) {
            if (isset($_POST[spaceOut($link['text'])])) {
                $privileges[] = Escape($link['ID']);
            }
        }
        if ($privileges) {
            $allprivileges = implode(',', $privileges);
            $data = [
                'ID' => $id,
                'Privileges' => $allprivileges,
            ];
            $sql = Update('teachers', $data);
            if ($sql) {
                $message['sucess'] = 'Teacher Privileges Was Updated';
            } else {
                $message['error'] = 'Teacher Update Was Failed';
            }
        } else {
            $message['warning'] = 'This Teacher Has No Privileges!';
            $allprivileges = implode(',', $privileges);
            $data = [
                'ID' => $id,
                'Privileges' => $allprivileges,
            ];
            $sql = Update('teachers', $data);
            if ($sql) {
                $message['sucess'] = 'Teacher Privileges Was Updated';
            } else {
                $message['error'] = 'Teacher Update Was Failed';
            }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-3">
        <div class="info-pages">
            <h3 class="text-capitalize">Teachers</h3>
            <p class="text-capitalize h6">home /<span> Teacher</span></p>
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
            <?php if (isset($message['warning'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class='bx bx-error'></i>
                    <strong class="ml-2 h6"><?= $message['warning']; ?></strong>
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
            <h4>All Teachers</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddTeacher">Add New Teacher</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Classes</th>
                    <th>Courses</th>
                    <th>Privileges</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('teachers') as $teacher) : ?>
                    <tr>
                        <td><?= Escape($teacher['ID']); ?></td>
                        <td><?= Escape(Capitalize($teacher['FullName'])); ?></td>
                        <td><img src="Images/Teacher/<?= $teacher['Photo']; ?>" class="emp-img" alt="<?= $teacher['FullName']; ?>"></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateClasses" onclick="updateClasses('<?= Escape($teacher['ID']); ?>','<?= Escape($teacher['Classes']); ?>')" title="edit"></i>
                        </td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateCourses" onclick="updateCourses('<?= Escape($teacher['ID']); ?>','<?= Escape($teacher['Courses']); ?>')" title="edit"></i>
                        </td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updatePrivileges" onclick="updatePrivileges('<?= Escape($teacher['ID']); ?>','<?= Escape($teacher['Privileges']); ?>')" title="edit"></i>
                        </td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" id="status" <?= Escape($teacher['Status'] ? 'checked' : ''); ?> onclick="updateStatus(<?= Escape($teacher['ID']); ?>,this)">
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateTeacher" onclick="update('<?= Escape($teacher['ID']); ?>','<?= Escape($teacher['Photo']); ?>','<?= Escape($teacher['UserName']); ?>')" title="edit"></i>
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
    function update(id, photo, oldusername) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'teachers',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const teacher = JSON.parse(response);
                $('#oldusername').val(oldusername);
                $('#id').val(teacher[0].ID);
                $('#emp-img').attr('src', 'Images/Teacher/' + photo);
                $('#image').val(photo);
                $('#name').val(teacher[0].FullName);
                $('#address').val(teacher[0].Address);
                $('#phone').val(teacher[0].Phone);
                $('#email').val(teacher[0].Email);
                $('#username').val(teacher[0].UserName);
                $('#password').val(teacher[0].Password);
                teacher[0].Gender == 'male' ? $('#gender input#maleupdate')[0].checked = true : $('#gender input#femaleupdate')[0].checked = true;
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
                    table: 'teachers',
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
                    table: 'teachers',
                    id: id,
                    action: 'inactivestatus'
                },
                success: ((response) => {})
            })
        }
    }
    // update Classes function 
    function updateClasses(id, classes) {
        let checkboxes = document.querySelectorAll('.classcheckboxes');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
        })
        if (classes == '') {
            classes = 200;
        }
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'classes',
                id: classes,
                action: 'getlinks'
            },
            success: ((response) => {
                const links = JSON.parse(response);
                $('#updateClasses #updateid').val(id);
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
    // update Courses function 
    function updateCourses(id, courses) {
        let checkboxes = document.querySelectorAll('.coursecheckboxes');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = false;
        })
        if (courses == '') {
            courses = 200;
        }
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'courses',
                id: courses,
                action: 'getlinks'
            },
            success: ((response) => {
                const links = JSON.parse(response);
                $('#updateCourses #updateid').val(id);
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
    // update Privileges function 
    function updatePrivileges(id, privileges) {
        let checkboxes = document.querySelectorAll('.privilegeCheckboxes');
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
                console.log(response);
                const links = JSON.parse(response);
                $('#updatePrivileges #updateid').val(id);
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