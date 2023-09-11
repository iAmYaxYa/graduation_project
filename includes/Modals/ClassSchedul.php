<!-- insert modal  -->
<div class="modal fade" id="MakeClass">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Make Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <select name="class" required class="form-control" id="class">
                            <option value="" selected disabled>Select Class</option>
                            <?php foreach (ReadAll('classes') as $class) : ?>
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
                        <select name="day" class="form-control" required>
                            <option value="" disabled selected>select Day</option>
                            <?php
                            $days = ['sabti', 'axad', 'isniin', 'talaado', 'arbaco', 'khamiis', 'jimco'];
                            for ($i = 0; $i < count($days); $i++) : ?>
                                <option value="<?= $days[$i]; ?>"><?= Capitalize($days[$i]); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="time" name="timeStart" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <?php foreach (ReadBolean('seasons', 'Status', 1) as $season) : ?>
                            <input type="hidden" name="season" class="form-control" value="<?= $season['ID']; ?>">
                        <?php endforeach; ?>
                        <input type="time" name="timeEnd" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="make-class">Make</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update modal  -->
<div class="modal fade" id="updateClassSchedule">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Class Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <select name="class" required class="form-control class">
                            <option value="" selected disabled>Select Class</option>
                            <?php foreach (ReadAll('classes') as $class) : ?>
                                <option value="<?= $class['ID']; ?>" class="classes"><?= $class['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="course" class="form-control" required>
                            <option value="" disabled selected>select course</option>
                            <?php foreach (ReadAll('courses') as $course) : ?>
                                <option value="<?= $course['ID']; ?>" class="courses"><?= $course['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="day" class="form-control" required>
                            <option value="" disabled selected>select Day</option>
                            <?php
                            $days = ['sabti', 'axad', 'isniin', 'talaado', 'arbaco', 'khamiis', 'jimco'];
                            for ($i = 0; $i < count($days); $i++) : ?>
                                <option value="<?= $days[$i]; ?>" class="day"><?= Capitalize($days[$i]); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="time" name="timeStart" id="timeStart" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="time" name="timeEnd" class="form-control" id="timeEnd" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-class">Make</button>
                </div>
            </form>
        </div>
    </div>
</div>