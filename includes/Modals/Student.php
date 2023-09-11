<!-- insert modal  -->
<div class="modal fade" id="AddStudent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Full Name" pattern="[A-Za-z ]{5,50}" title="letters only" name="name">
                    </div>
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Address" pattern="[A-Za-z ][A-Za-z0-9 ]{4,50}" title="letters and numbers" name="address">
                    </div>
                    <div class="form-group">
                        <label>+252</label>
                        <input required type="number" class="form-control" placeholder="Phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="date" class="form-control" placeholder="DOB" name="dob">
                    </div>
                    <div class="form-group">
                        <label>Parent</label>
                        <select name="parent" class="form-control" required>
                            <option value="" selected>Parent</option>
                            <?php foreach (ReadAll('parent') as $parent) : ?>
                                <option value="<?= $parent['ID']; ?>"><?= $parent['FullName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <select name="class" class="form-control" required>
                            <option value="" selected>Class</option>
                            <?php foreach (ReadAll('classes') as $class) : ?>
                                <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gender:</label><br>
                        <input required type="radio" id="male" value="male" class="" name="gender">
                        <label for="male">Male</label>
                        <input required type="radio" id="female" value="female" class="" name="gender">
                        <label for="female">Female</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add-student">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update modal  -->
<div class="modal fade" id="updateStudent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Student</h5>
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
                        <input required type="text" class="form-control" placeholder="Address" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label>+252</label>
                        <input required type="number" class="form-control" placeholder="Phone" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="date" class="form-control" placeholder="DOB" name="dob" id="dob">
                    </div>
                    <div class="form-group">
                        <label>Parent</label>
                        <select name="parent" class="form-control" required>
                            <?php foreach (ReadAll('parent') as $parent) : ?>
                                <option value="<?= $parent['ID']; ?>" class="parent"><?= $parent['FullName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <select name="class" class="form-control" required>
                            <?php foreach (ReadAll('classes') as $class) : ?>
                                <option value="<?= $class['ID']; ?>" class="class"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                    <button type="submit" class="btn btn-primary" name="update-student">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>