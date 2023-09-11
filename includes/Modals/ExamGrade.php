<!-- insert modal  -->
<div class="modal fade" id="AddExamGrade">
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
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Grade Point</label>
                        <select class="form-control" name="gradePoint">
                            <option value="" selected disabled>Please Select</option>
                            <option value="4.00">4.00</option>
                            <option value="3.65">3.65</option>
                            <option value="3.50">3.50</option>
                            <option value="3.00">3.00</option>
                            <option value="2.50">2.50</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Percentage From</label>
                        <input type="number" class="form-control" name="percentageFrom">
                    </div>
                    <div class="form-group">
                        <label for="">Percentage Upto</label>
                        <input type="number" class="form-control" name="percentageUpto">
                    </div>
                    <div class="form-group">
                        <label for="">Comments</label>
                        <input type="text" class="form-control" name="comment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add-exam-grade">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- update modal  -->
<div class="modal fade" id="updateExamGrade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Exam Grade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="">Grade Point</label>
                        <select class="form-control" name="gradePoint">
                            <option value="" selected disabled>Please Select</option>
                            <option value="4.00" class="point">4.00</option>
                            <option value="3.65" class="point">3.65</option>
                            <option value="3.50" class="point">3.50</option>
                            <option value="3.00" class="point">3.00</option>
                            <option value="2.50" class="point">2.50</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Percentage From</label>
                        <input type="number" class="form-control" name="percentageFrom" id="percentageFrom">
                    </div>
                    <div class="form-group">
                        <label for="">Percentage Upto</label>
                        <input type="number" class="form-control" name="percentageUpto" id="percentageUpto">
                    </div>
                    <div class="form-group">
                        <label for="">Comments</label>
                        <input type="text" class="form-control" name="comment" id="comment">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update-exam-grade">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>