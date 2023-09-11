<!-- insert modal  -->
<div class="modal fade" id="AddPromotion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Student Promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <label for="">Current Session</label>
                        <select name="currentSeason" required class="form-control">
                            <option value="" selected>Please Select</option>
                            <?php foreach (ReadAll('seasons') as $season) : ?>
                                <option value="<?= $season['ID']; ?>"><?= $season['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Promotion Session</label>
                        <select name="promotionSeason" required class="form-control">
                            <option value="" selected>Please Select</option>
                            <?php foreach (ReadAll('seasons') as $season) : ?>
                                <option value="<?= $season['ID']; ?>"><?= $season['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Promotion From Class</label>
                        <select name="classFrom" required class="form-control">
                            <option value="" selected disabled>Please Select</option>
                            <?php foreach (ReadAll('classes') as $class) : ?>
                                <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Promotion To Class</label>
                        <select name="classTo" required class="form-control">
                            <option value="" selected disabled>Please Select</option>
                            <?php foreach (ReadAll('classes') as $class) : ?>
                                <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add-promotion">promote</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- update modal  -->
<div class="modal fade" id="updateClass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <select name="section" id="section" required class="form-control">
                            <?php foreach (ReadAll('section') as $section) : ?>
                                <option value="<?= $section['ID']; ?>" class="section"><?= $section['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="shift" id="shift" required class="form-control">
                            <?php foreach (ReadAll('shifts') as $shift) : ?>
                                <option value="<?= $shift['ID']; ?>" class="shift"><?= $shift['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-class">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>