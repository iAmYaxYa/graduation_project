<!-- insert modal  -->
<div class="modal fade" id="AddParent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add New Parent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Full Name" name="name">
                    </div>
                    <!-- <div class="form-group">
                        <div class="update-image">
                            <div class="icon">
                                <i class='bx bxs-image'></i>
                            </div>
                        </div>
                        <input type="file" name="photo" id="photo">
                    </div> -->
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="Address" name="address">
                    </div>
                    <div class="form-group">
                        <label>+252</label>
                        <input required type="number" class="form-control" placeholder="Phone" name="phone">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Occubation</label>
                        <input type="text" class="form-control" placeholder="Occubation" name="occubation">
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
                    <button type="submit" class="btn btn-primary" name="add-parent">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update modal  -->
<div class="modal fade" id="updateParent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Parent</h5>
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
                        <input required type="email" class="form-control" placeholder="Email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Occubation</label>
                        <input type="text" class="form-control" placeholder="Occubation" name="occubation" id="occubation">
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
                    <button type="submit" class="btn btn-primary" name="update-parent">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>