<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php'; ?>
<?php include '../includes/Modals/Class.php';
// checkUserPrivileges 
checkUserPrivileges();
// insert 
if (isset($_POST['add-class'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $section = filter_var($_POST['section'], FILTER_SANITIZE_SPECIAL_CHARS);
        $shift = filter_var($_POST['shift'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'Name' => $name,
                'Section' => $section,
                'Shift' => $shift,
            ];
            $user = Insert('classes', $data);
            if ($user) {
                $message['sucess'] = 'Thanks For Successfully Added';
            }
        }
    }
}
// update 
if (isset($_POST['update-class'])) {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        echo "<script>location.href = '" . '404' . '.php' . "'</script>";
    } else {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $section = filter_var($_POST['section'], FILTER_SANITIZE_SPECIAL_CHARS);
        $shift = filter_var($_POST['shift'], FILTER_SANITIZE_SPECIAL_CHARS);

        if ($name == '') {
            $message[] = 'name is required';
        } else {
            $data = [
                'ID' => $id,
                'Name' => $name,
                'Section' => $section,
                'Shift' => $shift,
            ];
            $user = Update('classes', $data);
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
            <h3 class="text-capitalize">Classes</h3>
            <p class="text-capitalize h6">home /<span> Class</span></p>
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
            <h4>All Classes</h4>
        </div>
        <div class="col-md-6 text-left text-md-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddClass">Add Class</button>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table id="example" class="table my-4 table-hover table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Shift</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (ReadAll('classes') as $class) : ?>
                    <tr>
                        <td><?= Escape($class['ID']); ?></td>
                        <td><?= Escape(Capitalize($class['Name'])); ?></td>
                        <td><?= Escape(Capitalize(getColumn('section', 'Name', $class['Section']))); ?></td>
                        <td><?= Escape(Capitalize(getColumn('shifts', 'Name', $class['Shift']))); ?></td>
                        <td>
                            <i class="fa fa-pencil btn btn-primary" data-toggle="modal" data-target="#updateClass" onclick="update('<?= Escape($class['ID']); ?>','<?= Escape($class['Section']); ?>','<?= Escape($class['Shift']); ?>')" title="edit"></i>
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
    const sections = document.querySelectorAll('.section');
    const shifts = document.querySelectorAll('.shift');
    // update function 
    function update(id, sectionid, shiftid) {
        $.ajax({
            type: 'POST',
            url: '../includes/config/Api.php',
            data: {
                table: 'classes',
                id: id,
                action: 'update'
            },
            success: ((response) => {
                const clas = JSON.parse(response);
                $('#id').val(clas[0].ID);
                $('#name').val(clas[0].Name);
                sections.forEach((section) => {
                    section.value == sectionid ? section.selected = true : section.selected = false;
                })
                shifts.forEach((shift) => {
                    shift.value == shiftid ? shift.selected = true : shift.selected = false;
                })
            })
        })
    }
</script>