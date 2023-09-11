<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/EditProfile.php';

checkUserPrivileges();
// insert 
if (isset($_POST['add-employee'])) {
    if (!isset($_GET['csrf']) || $_GET['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
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
                'Name' => $name,
                'Address' => $address,
                'Phone' => $phone,
                'Email' => $email,
                'Gender' => $gender,
                'Job_Title' => $jobTitle,
                'Photo' => $randomName . $extension
            ];
            $user = Insert('employee', $data);
            if ($user) {
                move_uploaded_file($fileTemp, $targetDir . $randomName . $extension);
                $message['sucess'] = 'Thanks For Successfully Added';
            }
        }
    }
}
// update 
if (isset($_POST['save-profile'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
        $image = filter_var($_POST['image'], FILTER_SANITIZE_SPECIAL_CHARS);

        // uploading image 
        $targetDir = 'Images/Employee/';
        $photo = $_FILES['photo'];
        $fileTemp = $photo['tmp_name'];
        $imageType = strtolower(pathinfo($fileTemp, PATHINFO_EXTENSION));
        $randomName = rand();
        $extension = '.jpg';

        $newImage = $_FILES['photo']['tmp_name'] ? $randomName . $extension : $image;

        $username = str_replace(' ', '', Escape($_POST['username']));
        $user = ReadSingle('user', $username, 'UserName');

        if ($user && $username !== $_SESSION['username']) {
            $message['error'] = 'User Has All Ready Registred';
        } else if ($username == '') {
            $message['error'] = 'username is required';
        } else if ($password == '') {
            $user = [
                'ID' => $id,
                'UserName' => $username,
            ];
            $emp = [
                'ID' => $id,
                'Photo' => $newImage
            ];
            $sqlEmp = Update('employee', $emp);
            $sqlUser = Update('user', $user);
            if ($sqlEmp) {
                $_SESSION['username'] = $username;
                move_uploaded_file($fileTemp, $targetDir . $newImage);
                $message['sucess'] = 'Your Profile Was Updated';
                if ($newImage !== $image) {
                    unlink('Images/Employee/' . $image);
                }
            } else {
                $message['danger'] = 'Update Failed';
            }
        } else if ($username && $password) {
            $user = [
                'ID' => $id,
                'UserName' => $username,
                'Password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            $emp = [
                'ID' => $id,
                'Photo' => $newImage
            ];
            $sqlEmp = Update('employee', $emp);
            $sqlUser = Update('user', $user);
            if ($sqlEmp) {
                $_SESSION['username'] = $username;
                move_uploaded_file($fileTemp, $targetDir . $newImage);
                $message['sucess'] = 'Your Profile Was Updated';
                if ($newImage !== $image) {
                    unlink('Images/Employee/' . $image);
                }
            } else {
                $message['danger'] = 'Update Failed';
            }
        }
    }
}
?>
<div class="container-fluid pt-5 px-0">
    <div class="row px-4">
        <div class="info-pages">
            <h3 class="text-capitalize">Profile</h3>
            <p class="text-capitalize h6">home /<span> Profile</span></p>
        </div>
    </div>
    <div class="row mt-4 px-4">
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
        <?php $result = $_SESSION['table'] === 'user' ? ReadSingle('employee', $_SESSION['id'], 'ID') : ReadSingle($_SESSION['table'], $_SESSION['id'], 'ID');
        ?>
    </div>
    <div class="row d-flex justify-content-between px-4">
        <div class="col-md-4 px-2 text-center">
            <div class="bg-white pt-4 shadow-sm rounded-xl">
                <div class="px-4 w-100">
                    <img src="Images/Employee/<?= $_SESSION['table'] === 'user' ? $result[0]['Photo'] : 'unknown.jpg'; ?>" class="user-profile-image shadow-lg" alt="">
                    <h5 class="text-center mt-4 mb-3"><?= Capitalize($result[0]['FullName']); ?></h5>
                    <?php if ($_SESSION['table'] === 'user') : ?>
                        <button data-toggle="modal" data-target="#EditProfile" onclick="update('<?= $_SESSION['id']; ?>','<?= $employee[0]['Photo']; ?>')" class="btn btn-primary mb-5 rounded-pill shadow-lg">Edit Profile</button>
                    <?php endif; ?>
                </div>
                <ul class="px-4 mb-0 pb-4 bg-light w-100 text-center">
                    <li class="d-flex align-items-center pt-2">
                        <div><i class="fa-solid fa-location-dot"></i></div>
                        <div class="ml-2"><?= Escape(Capitalize($result[0]['Address'])); ?></div>
                    </li>
                    <li class="d-flex align-items-center pt-2">
                        <div><i class="fa-solid fa-envelope"></i></div>
                        <div class="ml-2"><?= $_SESSION['table'] === 'students' ? 'no email' : Escape($result[0]['Email']); ?></div>
                    </li>
                    <li class="d-flex align-items-center pt-2">
                        <div><i class="fa-solid fa-phone"></i></div>
                        <div class="ml-2"><?= Escape($result[0]['Phone']); ?></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8 mt-4 mt-md-0">
            <div class="row">
                <div class="col-12 mb-4 px-2" style="height: fit-content;">
                    <div class="bg-white shadow-sm pt-4 rounded-xl">
                        <h4 class="px-4">Account Details</h4>
                        <ul class="px-4 mb-0 pb-4 w-100 text-center">
                            <li class="d-flex align-items-center pt-2 justify-content-between">
                                <div>Full Name </div>
                                <div class="ml-2"><?= Escape(Capitalize($result[0]['FullName'])); ?></div>
                            </li>
                            <li class="d-flex align-items-center pt-2 justify-content-between">
                                <div>User Name </div>
                                <div class="ml-2">@<?= Escape(Capitalize($_SESSION['username'])); ?></div>
                            </li>
                            <li class="d-flex align-items-center pt-2 justify-content-between">
                                <div>Joined Date </div>
                                <div class="ml-2"><?= Escape($result[0]['Date']); ?></div>
                            </li>
                            <li class="d-flex align-items-center pt-2 justify-content-between">
                                <div>Gender</div>
                                <div class="ml-2"><?= Escape($result[0]['Gender']); ?></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 px-2" style="height: fit-content;">
                    <div class="bg-white shadow-sm pt-4 rounded-xl">
                        <h4 class="px-4">About</h4>
                        <p class="px-4 mb-0 pb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla, velit facilis aliquid ea quos tempore! Quas aut vitae rem voluptatem hic voluptate, doloribus aliquam suscipit optio facilis facere, accusantium architecto, consectetur officiis illo placeat? Hic saepe dolorem velit mollitia consectetur!</p>
                    </div>
                </div>
            </div>
        </div>
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
                table: 'user',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const user = JSON.parse(response);
                $('#id').val(user[0].ID);
                $('#emp-img').attr('src', 'Images/Employee/' + photo);
                $('#image').val(photo);
                $('#username').val(user[0].UserName);
            })
        })
    }
</script>