<!-- insert modal  -->
<div class="modal fade" id="AddEmployee">
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
                    <div class="form-group">
                        <input required type="text" class="form-control" placeholder="JobTitle" name="job_title">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add-employee">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update modal  -->
<div class="modal fade" id="EditProfile">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="row w-100 d-flex justify-content-between">
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="update-image edit-profile">
                                    <div class="overlay">
                                        <i class="fa-solid fa-camera h3 text-white"></i>
                                        <span class="text-white">Change Photo</span>
                                    </div>
                                    <img src="" class="user-profile-image shadow-lg" id="emp-img" alt="">
                                </div>
                                <input type="hidden" id="image" name="image">
                                <input type="file" name="photo" id="photo-user">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex mb-3 align-items-center justify-content-between">
                                <h4>Account Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="id" name="id">
                                <input type="text" class="form-control" required placeholder="User Name" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="New Password *" name="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save-profile">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>