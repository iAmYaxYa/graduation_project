<?php
require_once 'Connection.php';

$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


// ReadAll
function ReadAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    $Data = $conn->query($query)->fetchAll();
    return $Data;
}
// ReadAll and order
function ReadAllOrder($table, $order = null)
{
    global $conn;
    $query = "SELECT * FROM $table ORDER BY Date $order";
    $Data = $conn->query($query)->fetchAll();
    return $Data;
}

// Read
function Read($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE ID = :id";
    $statement = $conn->prepare($query);
    $statement->execute(['id' => $id]);
    $Data = $statement->fetchAll();
    echo json_encode($Data);
}
// ReadCustom
function ReadCustom($table, $id, $column, $value)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE ID IN($id) && $column = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$value]);
    $Data = $statement->fetchAll();
    echo json_encode($Data);
}
// ReadCustom
function ReadBolean($table, $column, $value)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$value]);
    $Data = $statement->fetchAll();
    return $Data;
}
// Read
function ReadLinks($table, $id, $type = 'return')
{
    global $conn;
    if ($id == '') {
        $id = 0;
    }
    $query = "SELECT * FROM $table WHERE ID IN($id)";
    $statement = $conn->prepare($query);
    $statement->execute();
    $Data = $statement->fetchAll();
    if ($type == 'json') {
        echo json_encode($Data);
    } else {
        return $Data;
    }
}
function ReadLinksNotTrue($table, $column, $id)
{
    global $conn;
    if ($id == '') {
        $id = 0;
    }
    $query = "SELECT $column FROM $table WHERE ID NOT IN($id)";
    $statement = $conn->prepare($query);
    $statement->execute();
    $Data = $statement->fetchAll();
    return $Data;
}
// redirect 
function redirect($location)
{
    echo "<script>location.href = '" . $location . "'</script>";
}
function checkUserPrivileges()
{
    if (!isset($_SESSION['islogged'])) {
        redirect('Login.php');
    }
    $user = ReadSingle($_SESSION['table'], $_SESSION['username'], 'UserName');
    if ($user) {
        $userRedirectRealPage = false;
        $links = ReadLinksNotTrue('links', 'link', $user[0]['Privileges']);
        if ($links) {
            foreach ($links as $link) {
                if (basename($_SERVER['PHP_SELF']) == $link['link'] . '.php') {
                    $userRedirectRealPage = true;
                }
                if ($userRedirectRealPage === true) {
                    $page = getPrivilages('links', 'link', $user[0]['Privileges']);
                    redirect("$page.php");
                }
            }
        }
    } else {
        redirect('Login.php');
    }
}
function getPrivilages($table, $column, $privileges)
{
    global $conn;
    $id = explode(',', $privileges);
    $query = "SELECT $column FROM $table WHERE ID = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$id[0]]);
    $Data = $statement->fetchColumn();
    return $Data;
}
function logOut()
{
    $_SESSION = array();
    session_destroy();
}
// Read
function ReadSingle($table, $id, $column)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = :id";
    $statement = $conn->prepare($query);
    $statement->execute(['id' => $id]);
    $Data = $statement->fetchAll();
    return $Data;
}

function selectStudentMarks($class, $season)
{
    global $conn;
    $query = "SELECT Course, SUM(Marks) as Total FROM `exam_marks` WHERE Class = ? && Student = ? GROUP BY Course";
    $statement = $conn->prepare($query);
    $statement->execute([$class, $season]);
    $Data = $statement->fetchAll();
    return $Data;
}

// Read
function generateReport($table, $classid, $seasonid, $date)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE Class = ? && Season = ? && Date = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$classid, $seasonid, $date]);
    $Data = $statement->fetchAll();
    return $Data;
}
function generateReportInovie($table, $classid, $seasonid)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE Class = ? && Season = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$classid, $seasonid]);
    $Data = $statement->fetchAll();
    return $Data;
}

// Read
function getExpire($table, $id, $column, $column2 = 'Date')
{
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = $id order by $column2";
    $statement = $conn->prepare($query);
    $statement->execute();
    $Data = $statement->fetchAll();
    return $Data;
}
// Read
function filterData($table, $value1, $column, $column2, $value2)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = $value1 && $column2 = $value2";
    $statement = $conn->prepare($query);
    $statement->execute();
    $Data = $statement->fetchAll();
    return $Data;
}
// Report of match and seats
function report_Matches_Seats()
{
    global $conn;
    $query = "SELECT ID FROM matches WHERE expire = false order by Date limit 1";
    $statement = $conn->query($query);
    $matchid = $statement->fetchColumn();
    $unavailableseats = get_target_match_unavailable_seats($matchid);
    $stringseats = implode(',', array_column($unavailableseats, 'seat_no'));
    $longside = $shortside = $viphospitality = null;
    if ($stringseats !== '') {
        $longside = read_available_seats($stringseats, 1);
        $shortside = read_available_seats($stringseats, 2);
        $viphospitality = read_available_seats($stringseats, 3);
    } else {
        $stringseats = 0;
        $longside = read_available_seats($stringseats, 1);
        $shortside = read_available_seats($stringseats, 2);
        $viphospitality = read_available_seats($stringseats, 3);
    }
    $data = ['long' => count($longside), 'short' => count($shortside), 'vip' => count($viphospitality), 'unavailable' => count($unavailableseats)];
    return $data;
}
// Report of match and seats
function reportOfAttendance($student, $status, $class)
{
    global $conn;
    $query = "SELECT * FROM attendance WHERE Student = $student && Status = $status && Class = $class";
    $statement = $conn->query($query);
    $data = $statement->fetchAll();
    return $data;
}

// insert 
function Insert($table, $data)
{
    global $conn;

    $columns = implode(',', array_keys($data));
    $placeholders = ":" . implode(', :', array_keys($data));
    $query = "INSERT INTO $table($columns) VALUES($placeholders)";
    $statement = $conn->prepare($query);
    $statement->execute($data);
    $lastid = $conn->lastInsertId();
    return $statement ? $lastid : false;
}

// update 
function Update($table, $data)
{
    global $conn;

    $placeholders = array();
    foreach ($data as $key => $value) {
        $placeholders[] = $key . ' = :' . $key;
    }
    $columns = implode(', ', $placeholders);
    $query = "UPDATE $table SET $columns WHERE ID = :ID";
    $statement = $conn->prepare($query);
    $statement->execute($data);
    return $statement ? true : false;
}


// delete 
function Delete($table, $id)
{
    global $conn;
    $query = "DELETE FROM $table WHERE ID = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$id]);
    return $statement ? true : false;
}



// updateWithOutID 
function updateWithOutID($table, $column1, $column2, $id)
{
    global $conn;
    $query = "UPDATE $table SET $column1 = true WHERE $column2 = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$id]);
    return $statement ? true : false;
}
// updateWithOutID in Ajax
function updateWithOutIDAjax($table, $column1, $value1, $column2, $value2)
{
    global $conn;
    $query = "UPDATE $table SET $column1 = $value1 WHERE $column2 = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$value2]);
    echo  json_encode($statement ? true : false);
}


// capitalize 
function Capitalize($text)
{
    return ucwords($text);
}
// escape 
function Escape($input)
{
    return htmlspecialchars($input);
}
function reportAllRows($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    $statement = $conn->prepare($query);
    $statement->execute();
    $data = $statement->rowCount();
    return $data;
}
function selectDistinict($table, $column, $column2, $column3, $value2, $value3)
{
    global $conn;
    $query = " SELECT DISTINCT($column) FROM $table WHERE $column2 = ? && $column3 = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$value2, $value3]);
    $data = $statement->fetchAll();
    return $data;
}
function selectDistinictClass($table, $distinictColumn, $column, $value)
{
    global $conn;
    $query = " SELECT DISTINCT($distinictColumn) FROM $table WHERE $column = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$value]);
    $data = $statement->fetchAll();
    return $data;
}
function selectScheduleCourses($table, $column1, $column2, $colum3, $value1, $value2, $value3)
{
    global $conn;
    $query = " SELECT * FROM $table WHERE $column1 = ? && $column2 = ? && $colum3 = ? ";
    $statement = $conn->prepare($query);
    $statement->execute([$value1, $value2, $value3]);
    $data = $statement->fetchAll();
    return $data;
}
// get column 
function getColumn($table, $column, $id)
{
    global $conn;
    $query = "SELECT $column FROM $table WHERE ID = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$id]);
    $data = $statement->fetchColumn();
    return $data;
}
// read specific columns 
function readColumn($table, $column, $id)
{
    global $conn;
    $query = "SELECT $column FROM $table WHERE ID = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$id]);
    $data = $statement->fetchAll();
    return $data;
}

// get status get
function getStatusAndExpire($text, $trueText, $falseText, $color1, $color2)
{
    return $text ?
        "<div class='bg-$color1 d-flex align-items-center rounded-pill justify-content-center' style='width: 120px; cursor:pointer; height:25px;'>
        <span class='text-white'>$trueText</span>
        </div>"
        : "<div class='bg-$color2 d-flex align-items-center rounded-pill justify-content-center' style='width: 120px; height:25px;'>
        <span class='text-white'>$falseText</span>
        </div>";
}
// filter date 
function filterDate($format, $date)
{
    return date("$format", strtotime($date));
}
// space out 

function spaceOut($text)
{
    return str_replace(' ', '', $text);
}
function checkUser($text)
{
    return $text ? "Yes" : "No";
}

function getEmployee($table, $column, $bool = 'false')
{
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = $bool";
    $statement = $conn->query($query);
    $data = $statement->fetchAll();
    return $data;
}

// specific row count 
function rowCount($table, $column, $bool, $id, $column2)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = ? && $column2 = $bool";
    $statement = $conn->prepare($query);
    $statement->execute([$id]);
    $data = $statement->rowCount();
    return $data;
}
// all rowCount 
function allRowCount($table, $bool, $column)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = $bool";
    $statement = $conn->prepare($query);
    $statement->execute();
    $data = $statement->rowCount();
    return $data;
}

// procedure 
function callProcedure($name, $parameter)
{
    global $conn;
    $query = "CALL $name($parameter)";
    $statement = $conn->prepare($query);
    $statement->execute();
    return $statement ? true : false;
}

// match filter 
function matchFilter()
{
    global $conn;
    $query = "SELECT ID FROM `matches` WHERE CURRENT_TIMESTAMP >= Date && expire = false";
    $statement = $conn->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll();
    return $data;
}
// get price 
function getPrice($price)
{
    return '$' . $price;
}
// get price 
function getStatus($status, $value, $trueText, $falseText)
{
    return $status == $value ? $trueText : $falseText;
}

function ReportOfTicketDetails()
{
    global $conn;
    $query = "SELECT td.ID, c.FullName, t.Account_id , m.Home , m.Away, m.Date , sp.Name, seat_no , Amount FROM 		 ticket_details td
                INNER JOIN ticket t ON td.Ticket_no = t.Ticket_no 
                INNER JOIN customer c ON t.Customer_ID = c.ID 
                inner join matches m on t.match_ID = m.ID
                INNER JOIN seatposition sp ON t.Seat_ID = sp.ID
                where m.expire = false ORDER BY td.Date DESC";
    $statement = $conn->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll();
    return $data;
}
function reportOfSeats($bool)
{
    global $conn;
    $query = "SELECT * FROM seats WHERE status = $bool";
    $statement = $conn->query($query);
    $data = $statement->rowCount();
    return $data;
}

function getTotal($table, $column)
{
    global $conn;
    $query = "SELECT sum($column) FROM $table";
    $statement = $conn->query($query);
    $data = $statement->fetchColumn();
    return $data;
}
function getTotalSalary($table, $column, $column2, $value)
{
    global $conn;
    $query = "SELECT sum($column) FROM $table WHERE $column2 = $value";
    $statement = $conn->query($query);
    $data = $statement->fetchColumn();
    return $data;
}

// get every match unavailable seats
function get_target_match_unavailable_seats($matchid)
{
    global $conn;
    $query = "SELECT s.ID seat_no FROM seats s 
    LEFT JOIN ticket_details td ON s.ID = td.seat_no 
    LEFT JOIN ticket t ON td.Ticket_no = t.Ticket_no 
    LEFT JOIN matches m ON t.Match_ID = m.ID
    WHERE td.seat_no IS NOT null && m.ID = ? && m.expire = false";
    $statement = $conn->prepare($query);
    $statement->execute([$matchid]);
    $data = $statement->fetchAll();
    return $data;
}
// read available seats 
function read_available_seats($seatsid, $positionid)
{
    global $conn;
    $query = "SELECT ID FROM seats WHERE ID NOT IN($seatsid) && Seat_Position_ID = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$positionid]);
    $data = $statement->fetchAll();
    return $data;
}
// read available seats 
function read_available_seats_json($seatsid)
{
    global $conn;
    $query = "SELECT ID, seat_position_ID FROM seats WHERE ID NOT IN($seatsid)";
    $statement = $conn->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll();
    echo json_encode($data);
}
// read available seats 
function read_teacher_clasess($table, $column, $value)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE $column IN($value)";
    $statement = $conn->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll();
    return $data;
}

// update payslip status
function UpdatePayslipStatus($id)
{
    global $conn;
    $query = "UPDATE payslip SET Status = true WHERE ID = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$id]);
    return $statement ? true : false;
}
