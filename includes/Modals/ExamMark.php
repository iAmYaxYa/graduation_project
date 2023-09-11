<!-- insert modal  -->
<div class="modal fade" id="AddExamMarks">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Exam Marks</h5>
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
                        <select name="course" id="courses" class="form-control" required>
                            <option value="" disabled selected>select course</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php foreach (ReadBolean('seasons', 'Status', 1) as $season) : ?>
                            <input type="hidden" name="season" class="form-control" value="<?= $season['ID']; ?>">
                        <?php endforeach; ?>
                        <select name="exam" class="form-control" required>
                            <option value="" disabled selected>select Exam</option>
                            <?php foreach (ReadAll('exams') as $exam) : ?>
                                <option value="<?= $exam['ID']; ?>"><?= $exam['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="Add-ExamMarks">Make</button>
                </div>
            </form>
        </div>
    </div>
</div>