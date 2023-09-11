<!-- ========================= Init Admin ========================= -->
<?php include '../includes/InitAdmin/InitAdmin.php';
// checkUserPrivileges 
checkUserPrivileges();
?>
<!-- ============================== Admin dashboard ============================== -->
<div class="container-fluid pt-5">
    <div class="row">
        <div class="info-pages">
            <h3 class="text-capitalize">admin dashboard</h3>
            <p class="text-capitalize h6">home /<span> admin</span></p>
        </div>
    </div>
    <div class="row my-1">
        <div class="box d-flex align-items-center justify-content-between my-2 w-100">
            <div class="cards">
                <div class="icon stud">
                    <i class="fa-solid fa-person"></i>
                </div>
                <div class="desc">
                    <h6 class="text-muted text-capitalize">Students</h6>
                    <h5 class="text-capitalize"><?php echo reportAllRows('students');
                                                ?></h5>
                </div>
            </div>
            <div class="cards">
                <div class="icon teach">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="desc">
                    <h6 class="text-muted text-capitalize">teachers</h6>
                    <h5 class="text-capitalize"><?php echo reportAllRows('teachers');
                                                ?></h5>
                </div>
            </div>
            <div class="cards">
                <div class="icon pare">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="desc">
                    <h6 class="text-muted text-capitalize">parents</h6>
                    <h5 class="text-capitalize"><?php echo reportAllRows('parent');
                                                ?></h5>
                </div>
            </div>
            <div class="cards">
                <div class="icon earn">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
                <div class="desc">
                    <h6 class="text-muted text-capitalize">earnings</h6>
                    <h5 class="text-capitalize">$<?php echo number_format(getTotal('bank', 'Balance'), 2);
                                                    ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-between my-4">
        <div class="studen shadow-lg bg-white p-4 rounded">
            <h4 class="text-capitalize mb-3">Students</h4>
            <div class="w-100 d-flex justify-content-center">
                <div style="width: 350px;">
                    <canvas id="ticketavailable"></canvas>
                </div>
            </div>
        </div>
        <div class="website-traf notification shadow-lg bg-white p-4 rounded">
            <h4 class="text-capitalize mb-3">notifications</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="text-white bg-success p-2 my-3">16 june, 2022</span>
                    <h6 class="mt-3">Great School manag mene esom tus eleifend lectus sed maximus mi faucibusnting.</h6>
                    <small class="text-muted">Jennyfar Lopez / 5 min ago</small>
                </li>
                <li class="list-group-item">
                    <span class="text-white bg-success p-2 my-3">16 june, 2022</span>
                    <h6 class="mt-3">Great School manag mene esom tus eleifend lectus sed maximus mi faucibusnting.</h6>
                    <small class="text-muted">Jennyfar Lopez / 5 min ago</small>
                </li>
                <li class="list-group-item">
                    <span class="text-white bg-success p-2 my-3">16 june, 2022</span>
                    <h6 class="mt-3">Great School manag mene esom tus eleifend lectus sed maximus mi faucibusnting.</h6>
                    <small class="text-muted">Jennyfar Lopez / 5 min ago</small>
                </li>
                <li class="list-group-item">
                    <span class="text-white bg-success p-2 my-3">16 june, 2022</span>
                    <h6 class="mt-3">Great School manag mene esom tus eleifend lectus sed maximus mi faucibusnting.</h6>
                    <small class="text-muted">Jennyfar Lopez / 5 min ago</small>
                </li>
                <li class="list-group-item">
                    <span class="text-white bg-success p-2 my-3">16 june, 2022</span>
                    <h6 class="mt-3">Great School manag mene esom tus eleifend lectus sed maximus mi faucibusnting.</h6>
                    <small class="text-muted">Jennyfar Lopez / 5 min ago</small>
                </li>
                <li class="list-group-item">
                    <span class="text-white bg-success p-2 my-3">16 june, 2022</span>
                    <h6 class="mt-3">Great School manag mene esom tus eleifend lectus sed maximus mi faucibusnting.</h6>
                    <small class="text-muted">Jennyfar Lopez / 5 min ago</small>
                </li>
            </ul>
        </div>
    </div>
    <div class="row my-3">
        <div class="col text-center px-0">
            <div class="icons d-flex jutify-content-between">
                <div class="cards face">
                    <div class="icon">
                        <i class='bx bxl-facebook'></i>
                    </div>
                    <div class="desc">
                        <h6 class="text-capitalize">like us on facebook</h6>
                        <h5 class="text-capitalize">300,000</h5>
                    </div>
                </div>
                <div class="cards twitt">
                    <div class="icon">
                        <i class='bx bxl-twitter'></i>
                    </div>
                    <div class="desc">
                        <h6 class="text-capitalize">flow us on twitter</h6>
                        <h5 class="text-capitalize">5,000,000</h5>
                    </div>
                </div>
                <div class="cards instag">
                    <div class="icon">
                        <i class='bx bxl-instagram'></i>
                    </div>
                    <div class="desc">
                        <h6 class="text-capitalize">flow us on instagram</h6>
                        <h5 class="text-capitalize">1,11,000</h5>
                    </div>
                </div>
                <div class="cards linked">
                    <div class="icon">
                        <i class='bx bxl-linkedin'></i>
                    </div>
                    <div class="desc">
                        <h6 class="text-capitalize">flow us on linkedin</h6>
                        <h5 class="text-capitalize">500,000</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ======================== Footer ======================== -->
<?php include '../includes/Footer/Footer.php'; ?>

<script>
    const ctx = document.getElementById('ticketavailable');


    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'male',
                'female',
            ],
            datasets: [{
                label: 'Tickets',
                data: [<?php echo json_encode(count(ReadBolean('students', 'Gender', 'male'))); ?>, <?php echo json_encode(count(ReadBolean('students', 'Gender', 'female'))); ?>],
                backgroundColor: [
                    'rgb(6, 244, 97)',
                    'rgb(255, 5, 5)',
                ],
                hoverOffset: 4
            }]
        }
    });
</script>