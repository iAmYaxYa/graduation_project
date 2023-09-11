<!-- insert modal  -->
<div class="modal fade" id="AddTeacher">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <div class="update-image">
                            <div class="icon">
                                <i class='bx bxs-image'></i>
                            </div>
                        </div>
                        <input type="file" name="photo" id="photo">
                    </div>
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Address" name="address">
                    </div>
                    <div class="form-group">
                        <label>+252</label>
                        <input required type="number" class="form-control" placeholder="Phone" name="phone">
                    </div>
                    <div class="form-group">
                        <input required type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Gender:</label><br>
                        <input required type="radio" id="male" value="male" class="" name="gender">
                        <label for="male">Male</label>
                        <input required type="radio" id="female" value="female" class="" name="gender">
                        <label for="female">Female</label>
                    </div>
                    <h5>Classes</h5>
                    <div class="row d-flex justify-content-between">
                        <?php foreach (ReadAll('classes') as $class) : ?>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" value="<?= Escape($class['ID']); ?>" class="form-check-input" name="<?= spaceOut(Escape($class['Name'])); ?>" id="insert<?= Escape($class['Name']); ?>">
                                    <label class="form-check-label" for="insert<?= Escape($class['Name']); ?>"><?= Escape(Capitalize($class['Name'])); ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <h5 class="mt-2">Courses</h5>
                    <div class="row d-flex justify-content-between">
                        <?php foreach (ReadAll('courses') as $course) : ?>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" value="<?= Escape($course['ID']); ?>" class="form-check-input" name="<?= spaceOut(Escape($course['Name'])); ?>" id="insert<?= Escape($course['Name']); ?>">
                                    <label class="form-check-label" for="insert<?= Escape($course['Name']); ?>"><?= Escape(Capitalize($course['Name'])); ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <h5 class="mt-2">Privileges</h5>
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
                    <button type="submit" class="btn btn-primary" name="add-teacher">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update teacher  -->
<div class="modal fade" id="updateTeacher">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input required type="hidden" id="id" name="id">
                    <input required type="hidden" id="oldusername" name="oldusername">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Name" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <div class="update-image">
                            <img src="" id="emp-img" alt="">
                        </div>
                        <input type="hidden" id="image" name="image">
                        <input type="file" name="photo" id="photo">
                    </div>
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Address" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label>+252</label>
                        <input required type="number" class="form-control" placeholder="Phone" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <input required type="email" class="form-control" placeholder="Email" id="email" name="email">
                    </div>
                    <div class="form-group" id="gender">
                        <label>Gender:</label><br>
                        <input required type="radio" id="maleupdate" value="male" class="" name="gender">
                        <label for="maleupdate">Male</label>
                        <input required type="radio" id="femaleupdate" value="female" class="" name="gender">
                        <label for="femaleupdate">Female</label>
                    </div>
                    <h4>Account Information</h4>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" readonly placeholder="UserName" name="username" id="username">
                    </div>
                    <label for="">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" maxlength="6" required placeholder="Password" id="password" name="password">
                        <div class="input-group-prepend">
                            <span class="input-group-text eye bg-white border-left-0" id="basic-addon1"><i class="fa-solid fa-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-teacher">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update classes -->
<div class="modal fade" id="updateClasses">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Classes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input required type="hidden" id="updateid" name="id">
                    <h5 class="mt-2">Classes</h5>
                    <div class="row d-flex justify-content-between">
                        <?php foreach (ReadAll('classes') as $class) : ?>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" value="<?= Escape($class['ID']); ?>" class="form-check-input classcheckboxes" name="<?= spaceOut(Escape($class['Name'])); ?>" id="update<?= Escape($class['Name']); ?>">
                                    <label class="form-check-label" for="update<?= Escape($class['Name']); ?>"><?= Escape(Capitalize($class['Name'])); ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-classes">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update courses -->
<div class="modal fade" id="updateCourses">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Courses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input required type="hidden" id="updateid" name="id">
                    <h5 class="mt-2">Courses</h5>
                    <div class="row d-flex justify-content-between">
                        <?php foreach (ReadAll('courses') as $course) : ?>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" value="<?= Escape($course['ID']); ?>" class="form-check-input coursecheckboxes" name="<?= spaceOut(Escape($course['Name'])); ?>" id="update<?= Escape($course['Name']); ?>">
                                    <label class="form-check-label" for="update<?= Escape($course['Name']); ?>"><?= Escape(Capitalize($course['Name'])); ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-courses">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update privileges -->
<div class="modal fade" id="updatePrivileges">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Classes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input required type="hidden" id="updateid" name="id">
                    <h5 class="mt-2">Privileges</h5>
                    <div class="row d-flex justify-content-between">
                        <?php foreach (ReadSingle('links', 'users', 'Role') as $class) : ?>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" value="<?= Escape($class['ID']); ?>" class="form-check-input privilegeCheckboxes" name="<?= spaceOut(Escape($class['text'])); ?>" id="update<?= Escape($class['text']); ?>">
                                    <label class="form-check-label" for="update<?= Escape($class['text']); ?>"><?= Escape(Capitalize($class['text'])); ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-privileges">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>