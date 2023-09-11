<?php
include '../includes/InitLogin/InitLogin.php';
if (isset($_SESSION['islogged']) && $_SESSION['islogged'] === true) {
    $user = ReadSingle($_SESSION['table'], $_SESSION['username'], 'UserName');
    if ($user) {
        if ($user[0]['Privileges'] == '') {
            logOut();
            redirect('Login.php');
        }
        $page = getPrivilages('links', 'link', $user[0]['Privileges']);
        redirect("$page.php");
    }
}
$username = '';
$password = '';
$message = array();
if (isset($_POST['login'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $username = str_replace(' ', '', Escape($_POST['username']));
        $password = Escape($_POST['password']);

        // request tables
        $user = ReadSingle('user', Escape($username), 'UserName');
        $teacher = ReadSingle('teachers', Escape($username), 'UserName');
        $student = ReadSingle('students', Escape($username), 'UserName');
        $parent = ReadSingle('parent', Escape($username), 'UserName');

        // if user is true 
        if ($user) {
            if (password_verify($password, $user[0]['Password'])) {
                $_SESSION['islogged'] = true;
                $_SESSION['id'] = $user[0]['ID'];
                $_SESSION['username'] = $user[0]['UserName'];
                $_SESSION['table'] = 'user';
                if ($user[0]['Privileges'] == '') {
                    logOut();
                    redirect('Login.php');
                } else {
                    $page = getPrivilages('links', 'link', $user[0]['Privileges']);
                    redirect("$page.php");
                }
            } else {
                $message['error'] = 'Password is not correct';
            }
            // else if teacher is true
        } else if ($teacher) {
            if ($password === $teacher[0]['Password']) {
                $_SESSION['islogged'] = true;
                $_SESSION['id'] = $teacher[0]['ID'];
                $_SESSION['username'] = $teacher[0]['UserName'];
                $_SESSION['table'] = 'teachers';
                if ($teacher[0]['Privileges'] == '') {
                    logOut();
                    redirect('Login.php');
                } else {
                    $page = getPrivilages('links', 'link', $teacher[0]['Privileges']);
                    redirect("$page.php");
                }
            } else {
                $message['error'] = 'Password is not correct';
            }
            // else if student is true
        } else if ($student) {
            if ($password === $student[0]['Password']) {
                $_SESSION['islogged'] = true;
                $_SESSION['id'] = $student[0]['ID'];
                $_SESSION['username'] = $student[0]['UserName'];
                $_SESSION['table'] = 'students';
                if ($student[0]['Privileges'] == '') {
                    logOut();
                    redirect('Login.php');
                } else {
                    $page = getPrivilages('links', 'link', $student[0]['Privileges']);
                    redirect("$page.php");
                }
            } else {
                $message['error'] = 'Password is not correct';
            }
            // else if parent is true
        } else if ($parent) {
            if ($password === $parent[0]['Password']) {
                $_SESSION['islogged'] = true;
                $_SESSION['id'] = $parent[0]['ID'];
                $_SESSION['username'] = $parent[0]['UserName'];
                $_SESSION['table'] = 'parent';
                if ($parent[0]['Privileges'] == '') {
                    logOut();
                    redirect('Login.php');
                } else {
                    $page = getPrivilages('links', 'link', $parent[0]['Privileges']);
                    redirect("$page.php");
                }
            } else {
                $message['error'] = 'Password is not correct';
            }
            // else all is not true
        } else {
            $message['error'] = 'user name and password incorect';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Data tables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- bootstrap link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- css link  -->
    <link rel="stylesheet" href="style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="login container-fluid min-vh-100 w-100 d-flex">
        <div class="row d-flex w-100 justify-content-between">
            <div class="col-md-6">
                <img src="Images/undraw_secure_login_pdn4.png" class="img-fluid" alt="">
            </div>
            <div class="col-md-6">
                <h1>Welcome Back!</h1>
                <p>Login to continue</p>
                <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <?php if (isset($message['error'])) : ?>
                        <div class="alert alert-danger fade show" style="width:86%;">
                            <i class='bx bx-error-circle'></i>
                            <strong class="ml-2"><?= $message['error']; ?></strong>
                        </div>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-white" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                        </div>
                        <input type="text" class="border-left-0 input" value="<?= $username ?>" required placeholder="User Name" name="username">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend ">
                            <span class="input-group-text bg-white" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                        </div>
                        <input type="password" class="border-left-0 input password border-right-0" value="<?= $password ?>" required placeholder="Password" name="password">
                        <div class="input-group-prepend">
                            <span class="input-group-text eye bg-white border-left-0" id="basic-addon1"><i class="fa-solid fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <input type="submit" name="login" class="btn text-white mt-3" value="Login">
                </form>
            </div>
        </div>
    </div>



    <script>
        var eye = document.querySelector('.eye');
        var password = document.querySelector('.password');

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
</body>

</html>