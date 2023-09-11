<!-- insert modal  -->
<div class="modal fade" id="AddExamSchedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <select class="form-control" name="exam">
                            <option value="" selected disabled>Select Exam</option>
                            <?php foreach (ReadAll('exams') as $exam) : ?>
                                <option value="<?= $exam['ID']; ?>"><?= $exam['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="class">
                            <option value="" selected disabled>Select Class</option>
                            <?php foreach (ReadAll('classes') as $class) : ?>
                                <option value="<?= $class['ID']; ?>"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="course">
                            <option value="" selected disabled>Select Course</option>
                            <?php foreach (ReadAll('courses') as $course) : ?>
                                <option value="<?= $course['ID']; ?>"><?= $course['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="date">
                    </div>
                    <div class="form-group">
                        <label for="">Time Start</label>
                        <input type="time" class="form-control" name="timeStart">
                    </div>
                    <div class="form-group">
                        <label for="">Time End</label>
                        <input type="time" class="form-control" name="timeEnd">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add-exam-schedule">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- update modal  -->
<div class="modal fade" id="updateexamSchedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Exam Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <select class="form-control" name="exam">
                            <option value="" selected disabled>Select Exam</option>
                            <?php foreach (ReadAll('exams') as $exam) : ?>
                                <option value="<?= $exam['ID']; ?>" class="exam"><?= $exam['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="class">
                            <option value="" selected disabled>Select Class</option>
                            <?php foreach (ReadAll('classes') as $class) : ?>
                                <option value="<?= $class['ID']; ?>" class="class"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="course">
                            <option value="" selected disabled>Select Course</option>
                            <?php foreach (ReadAll('courses') as $course) : ?>
                                <option value="<?= $course['ID']; ?>" class="course"><?= $course['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="date" id="date">
                    </div>
                    <div class="form-group">
                        <label for="">Time Start</label>
                        <input type="time" class="form-control" name="timeStart" id="timeStart">
                    </div>
                    <div class="form-group">
                        <label for="">Time End</label>
                        <input type="time" class="form-control" name="timeEnd" id="timeEnd">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-exam-schedule">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>