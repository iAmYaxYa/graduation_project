<!-- insert modal  -->
<div class="modal fade" id="AddInvoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <label for="">Invoice Type</label>
                        <select name="invoice" class="form-control" id="invoice" required>
                            <option value="" disabled selected>select invoice Type</option>
                            <?php foreach (ReadAll('invoice_category') as $invoiceCategory) : ?>
                                <option value="<?= $invoiceCategory['ID']; ?>"><?= $invoiceCategory['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group d-none" id="student">
                        <label for="">Student</label>
                        <select name="student" class="form-control">
                            <option value="" disabled selected>select Student</option>
                            <?php foreach (ReadAll('students') as $student) : ?>
                                <option value="<?= $student['ID']; ?>"><?= $student['FullName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Account Type</label>
                        <select name="account" class="form-control" required>
                            <option value="" disabled selected>select Account</option>
                            <?php foreach (ReadAll('bank') as $account) : ?>
                                <option value="<?= $account['ID']; ?>"><?= $account['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Month</label>
                        <select name="month" class="form-control" required>
                            <option value="" disabled selected>select month</option>
                            <?php
                            $months = array();
                            for ($m = 1; $m <= 12; $m++) {
                                array_push($months, ['ID' => date('m', mktime(0, 0, 0, $m, 1, date('Y'))), 'Name' => date('F', mktime(0, 0, 0, $m, 1, date('Y')))]);
                            }
                            ?>
                            <?php foreach ($months as $month) : ?>
                                <option value="<?= $month['ID']; ?>"><?= $month['Name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" id="method" name="method">
                        <input type="hidden" id="price" name="price">
                        <?php foreach (ReadBolean('seasons', 'Status', 1) as $season) : ?>
                            <input type="hidden" name="season" class="form-control" value="<?= $season['ID']; ?>">
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="Add-invoice">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- paid modal  -->
<div class="modal fade" id="paidInvoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pay Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo Escape($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $_SESSION['csrf']; ?>" name="csrf">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" readonly name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" class="form-control" name="phone" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="paid-invoice">Pay</button>
                </div>
            </form>
        </div>
    </div>
</div>