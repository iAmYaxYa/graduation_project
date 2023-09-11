<!-- insert modal  -->
<div class="modal fade" id="AddUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <select name="employee" class="form-control" required>
                            <option value="" disabled selected>select employee</option>
                            <?php foreach (getEmployee('employee', 'User') as $key => $emp) : ?>
                                <option value="<?= $emp['ID']; ?>"><?= $emp['FullName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" required placeholder="User Name" name="username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" required placeholder="Password" name="password">
                    </div>
                    <h5>Previleges</h5>
                    <div class="row d-flex justify-content-between">
                        <?php foreach (ReadSingle('links', 'users', 'Role') as $link) : ?>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" value="<?= Escape($link['ID']); ?>" class="form-check-input" name="<?= spaceOut(Escape($link['text'])); ?>" id="insert<?= Escape($link['text']); ?>">
                                    <label class="form-check-label" for="insert<?= Escape($link['text']); ?>"><?= Escape(Capitalize($link['text'])); ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add-user">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- update modal  -->
<div class="modal fade" id="updateUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input type="hidden" id="updateid" name="id">
                    <h5>Previleges</h5>
                    <div class="row d-flex justify-content-between">
                        <?php foreach (ReadSingle('links', 'users', 'Role') as $link) : ?>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" value="<?= Escape($link['ID']); ?>" class="checkboxes form-check-input" name="<?= spaceOut(Escape($link['text'])); ?>" id="update<?= Escape($link['text']); ?>">
                                    <label class="form-check-label" for="update<?= Escape($link['text']); ?>"><?= Escape(Capitalize($link['text'])); ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-user">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete modal  -->
<div class="modal fade" id="deleteUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <input type="hidden" id="deleteid" name="id">
                        <h4>Did You Agree <strong id="name"></strong> ?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" name="delete-user">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>