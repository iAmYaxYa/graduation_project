<div class="navbar fixed-top">
    <a href="#" class="navbar-brand d-flex align-items-center">
        <i class="fa-solid fa-graduation-cap mr-0 h3 mr-md-2"></i>
        <span class="h3">Al Furaat</span>
    </a>
    <div class="actions mr-auto">
        <span><i class='bx bx-menu menu mr-3' id="menu"></i></span>
    </div>
    <div class="user">
        <span class="mr-2">
            <i class='bx bx-bell notice-icon'>
                <div class="badge-icon bg-primary">4</div>
            </i>
        </span>
        <span class="mr-2">
            <i class='bx bx-message-rounded-detail message-icon'>
                <div class="badge-icon bg-success">3</div>
            </i>
        </span>
        <img src="Images/Employee/<?php echo $_SESSION['table'] === 'user' ? Escape(getColumn('employee', 'Photo', $_SESSION['id'])) : 'unknown.jpg'; ?>" class="ml-3 rounded-circle img-fluid user-img" alt="">
        <div class="username ml-2 d-none d-md-block">
            <span class="h5"><?= Escape(Capitalize($_SESSION['username'])); ?></span>
            <i class="fas fa-chevron-down"></i>
        </div>
        <!-- notice -->
        <div class="notice rounded">
            <ul class="list-group">
                <li class="list-group-item d-flex align-items-center border-top-0">
                    <div>
                        <small class="text-muted">You have 4 new notifications</small>
                        <small class="text-white bg-primary py-1 px-2 ml-3 view-all">view all</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-3"><span><i class='bx bx-error-circle text-warning'></i></span></div>
                    <div>
                        <h6 class="text-dark">Lorem, ipsum.</h6>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small> <br>
                        <small class="text-muted">1 min. ago</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-3"><span><i class='bx bx-x-circle text-danger'></i></span></div>
                    <div>
                        <h6 class="text-capitalize text-dark">Lorem, ipsum.</h6>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small> <br>
                        <small class="text-muted">2 hr. ago</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-3"><span><i class='bx bx-check-circle text-success'></i></span></div>
                    <div>
                        <h6 class="text-dark text-capitalize">Lorem, ipsum.</h6>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small> <br>
                        <small class="text-muted">5 min. ago</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-3"><span><i class='bx bx-error-circle text-primary'></i></span></div>
                    <div>
                        <h6 class="text-capitalize text-dark">Lorem, ipsum.</h6>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small> <br>
                        <small class="text-muted">30 min. ago</small>
                    </div>
                </li>
            </ul>
        </div>
        <i class="fa-solid fa-timer"></i>
        <!-- messages  -->
        <div class="messages rounded">
            <ul class="list-group">
                <li class="list-group-item d-flex align-items-center border-top-0">
                    <div>
                        <small class="text-muted">You have 3 new Messages</small>
                        <small class="text-white bg-primary py-1 px-2 ml-3 view-all">view all</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-3"><span><i class='bx bxs-user-circle text-warning display-1'></i></span></div>
                    <div>
                        <h6 class="text-dark">Daadir Ali</h6>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small> <br>
                        <small class="text-muted">1 min. ago</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-3"><span><i class='bx bxs-user-circle text-danger display-1'></i></span></div>
                    <div>
                        <h6 class="text-capitalize text-dark">aweys nuux</h6>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small> <br>
                        <small class="text-muted">2 hr. ago</small>
                    </div>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <div class="mr-3"><span><i class='bx bxs-user-circle text-success display-1'></i></span></div>
                    <div>
                        <h6 class="text-dark text-capitalize">xaliimo dahir</h6>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small> <br>
                        <small class="text-muted">5 min. ago</small>
                    </div>
                </li>
            </ul>
        </div>
        <div class="profile rounded">
            <div class="user-info">
                <span><img src="img/photo-1566753323558-f4e0952af115.jpeg" class="mr-2 rounded-circle img-fluid" alt=""></span>
                <div class="user-name">
                    <h5 class="mb-0"><?php echo $_SESSION['table'] === 'user' ? Capitalize(getColumn('employee', 'FullName', $_SESSION['id'])) : Capitalize(getColumn($_SESSION['table'], 'FullName', $_SESSION['id'])); ?></h5>
                    <small class="text-muted h6">@<?php echo Capitalize($_SESSION['username']) ?? null; ?></small>
                </div>
            </div>
            <ul class="list-group">
                <li class="list-group-item border-top text-muted">
                    <a href="Profile.php" class="text-muted">
                        <span class="mr-3"><i class='bx bx-user'></i></span>
                        <span>My Profile</span>
                    </a>
                </li>
                <li class="list-group-item border-top text-muted">
                    <span class="mr-3"><i class='bx bx-cog'></i></span>
                    <span>Account Setting</span>
                </li>
                <li class="list-group-item border-top text-muted">
                    <span class="mr-3"><i class='bx bx-help-circle'></i></span>
                    <span>Need Help</span>
                </li>
                <li class="list-group-item border-top text-muted">
                    <a href="SignOut.php?csrf=<?php echo $_SESSION['csrf']; ?>" class="text-muted">
                        <span class="mr-3"><i class='bx bx-log-in'></i></span>
                        <span>Sing Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>