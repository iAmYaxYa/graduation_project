<!-- insert modal  -->
<div class="modal fade" id="AddClass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" name="name" required>
                    </div>
                    <div class="form-group">
                        <select name="section" required class="form-control">
                            <option value="" selected>Select Section</option>
                            <?php foreach (ReadAll('section') as $section) : ?>
                                <option value="<?= $section['ID']; ?>"><?= $section['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="shift" required class="form-control">
                            <option value="" selected>Select Shift</option>
                            <?php foreach (ReadAll('shifts') as $shift) : ?>
                                <option value="<?= $shift['ID']; ?>"><?= $shift['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add-class">Add</button>
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