<!-- insert modal  -->
<div class="modal fade" id="makeAttendance">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Make Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <select name="class" class="form-control" required id="class">
                            <option value="" disabled selected>select class</option>
                            <?php
                            foreach (ReadAll('classes') as $class) :
                            ?>
                                <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php foreach (ReadBolean('seasons', 'Status', 1) as $season) : ?>
                            <input type="hidden" name="season" class="form-control" value="<?= $season['ID']; ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="makeAttendance">Make</button>
                </div>
            </form>
        </div>
    </div>
</div>