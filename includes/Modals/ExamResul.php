<!-- insert modal  -->
<div class="modal fade" id="AddExamResult">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Select Class</h5>
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
                            foreach (read_teacher_clasess('classes', 'ID', getColumn('teachers', 'Classes', 2)) as $class) :
                            ?>
                                <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="season" class="form-control" required>
                            <option value="" disabled selected>select Season</option>
                            <?php foreach (ReadAll('seasons') as $season) : ?>
                                <option value="<?= $season['ID']; ?>"><?= $season['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="Add-ExamResult">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>