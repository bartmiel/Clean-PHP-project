<?php
#region funkcje odpowiedzialne za dołączanie nagłówka i stopki
function GetHeader($title, $bootstrap)
{
    require_once('../Template/Header.php');
}

function GetFooter()
{
    require_once('../Template/Footer.php');
}
#endregion
#region funkcje odpowiedzialne za dołączanie widoków
function GetRegistrationForm()
{
    require_once('../Registration/RegistrationForm.php');
}

function GetCompetitionView($competitionId, $date, $name, $time, $location, $regStatus)
{
    require('../Home/CompetitionsView.php');
}

function GetCompetitionDetailsView($location, $name, $date, $description, $limit, $distances, $competitionId)
{
    require_once("../Home/CompetitionDetailsView.php");
}

function GetAddCompetitionFormView()
{
    require_once("../Home/AddCompetitionView.php");
}

function GetResultsView($competitionId, $date, $name, $location)
{
    require("../Home/ResultsView.php");
}
function GetResultDetailsView($location, $name, $date, $distances, $competitionId, $distanceSelected, $distanceSelectedName)
{
    require_once("../Home/ResultDetailsView.php");
}
function GetSignInForm($isAuth)
{
    require_once('../SignIn/SignInForm.php');
}
#endregion
#region funkcje odpowiedzialne za zwracanie wartości do widoków
function GetTime($time)
{
    return date('G:i', strtotime($time));
}

function GetDay($date)
{
    return date('d', strtotime($date));
}

function DayOfTheWeek($date)
{
    //'N' jako numeryczna reprezentacja dnia 1-7
    $day = date('N', strtotime($date));
    $daysOfTheWeek = array('Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela');
    return $daysOfTheWeek[$day - 1];
}

function GetMonth($date)
{
    //'n' jako numeryczna reprezentacja miesiąca 1-12
    $month = date('n', strtotime($date));
    $months = array('Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień');
    return $months[$month - 1];
}

function GetDateOfEvent($date)
{
    return date("j.m.Y", strtotime($date));
}
function GetNumberOfFinishedParticipant($competitionId)
{
    $sql = "select fp.userId from finishparticipant as fp
            left join distance as d on d.distanceId = fp.distanceId
            where competitionId=$competitionId";
    $nOfP = num_rows(query($sql));
    return $nOfP;
}

function GetRegistrationStatus($registrationStatus)
{
    if ($registrationStatus) {
        $status = "REJESTRACJA OTWARTA";
        $bootstrap = "bg-success";
        return array($status, $bootstrap);
    } else {
        $status = "REJESTRACJA ZAMKNIĘTA";
        $bootstrap = "bg-danger";
        return array($status, $bootstrap);
    }
}

function GetLimit($competitionId)
{
    $limit = 0;
    $sql = "select distanceLimit from distance where competitionId=$competitionId";
    $result = query($sql);
    foreach ($result as $lim) {
        $limit += $lim['distanceLimit'];
    }
    return $limit;
}

function GetDistances($distances)
{
    $string = "";
    foreach ($distances as $d) {
        $string .=  "<option value=" . "\"" . $d['distanceId'] . "\"" . ">" . $d['name'] . "</option>";
    }
    return $string;
}

function GetRegisteredParticipants($competitionId)
{
    $sql = "select ud.userId from userdistance as ud left join distance as d
            on ud.distanceId=d.distanceId
            where d.competitionId=$competitionId";
    $numberOfRegisteredParticipants = num_rows(query($sql));
    return $numberOfRegisteredParticipants;
}
#endregion
#region pozostałe funkcje do obsługi zdarzeń

function RegisterToCompetition($distanceSelected)
{
    $sql = "select name, distanceLimit from distance where distanceId=$distanceSelected";
    $numberOfRegisteredParticipants = num_rows(query($sql));
    $row = fetch_row(query($sql));
    if ($numberOfRegisteredParticipants < $row[1]) {
        $userId = $_COOKIE['user_id'];
        $sql = "insert into userdistance values ($userId, $distanceSelected)";
        query($sql);
        if (errno() == 1062) {
            echo '<script>alert("Jesteś już zarejestrowany na ten dystans");</script>';
        }
    }
}

function GetParticipants($competitionId)
{
    $i = 0;
    $sql = "select u.lastname, u.firstname, u.city, u.clubname ,d.name 
            from userdistance as ud left join distance as d
            on ud.distanceId=d.distanceId
            left join user as u
            on ud.userId=u.userId
            where d.competitionId=$competitionId
            order by u.lastname";
    $result = query($sql);
    $string = "";
    while ($participant = fetch_array($result)) {
        $i++;
        $string .=  "<tr>
                        <th scope='row'>$i</th>
                        <td>$participant[0]</td>
                        <td>$participant[1]</td>
                        <td>$participant[2]</td>
                        <td>$participant[3]</td>
                        <td>$participant[4]</td>
                    </tr>";
    }
    return $string;
}

function GetFinishedParticipants($competitionId, $distanceSelected)
{
    $i = 0;
    $sql = "select u.lastname, u.firstname, u.city, u.clubname, fp.result 
            from finishparticipant as fp left join distance as d
            on fp.distanceId=d.distanceId
            left join user as u
            on fp.userId=u.userId
            where d.competitionId=$competitionId and fp.distanceId=$distanceSelected
            order by fp.result";
    $result = query($sql);
    $string = "";
    while ($participant = fetch_array($result)) {
        $i++;
        $string .=  "<tr>
                        <th scope='row'>$i</th>
                        <td>$participant[0]</td>
                        <td>$participant[1]</td>
                        <td>$participant[2]</td>
                        <td>$participant[3]</td>
                        <td>$participant[4]</td>
                    </tr>";
    }
    return $string;
}

function createUser($post)
{
    dbConnect();
    extract($post);

    if (!empty($firstname) && !isset($_GET['rej'])) {
        $getUserSql = "SELECT * FROM User WHERE email='{$email}'";
        $user = fetch_array(query($getUserSql));
        if ($user) {
            echo "<div class='card col-5 p-4 mt-4' style='border-radius: 15px;'><div class='row justify-content-center' >
                <h4 class='text-center text-danger mb-4'>Użytkownik o podanym adresie już istnieje!</h4>
                <input type='button' onclick=location.href='./Registration.php' class='w-50 btn btn-secondary mb-3' value='Powrót do rejestracji' />
            </div></div>";
            exit();
        } else {
            $password  = password_hash($password, PASSWORD_DEFAULT);

            $address  = " $street , + $city $postalCode";

            $createUserSql = "INSERT INTO user (userId,firstname,lastname,email,
                                address,city,admin,password, clubname)
                            VALUES (null,'$firstname','$lastname','$email',
                            '$address','$city','$admin','$password', '$clubname') ";
            query($createUserSql);
            dbClose();
            header('Location: Registration.php?rej=1');
        }
    }
}

function createCompetition($post)
{
    dbConnect();
    extract($post);
    if (!empty($competitionName) && !isset($_GET['ok'])) {
        $getCompetitionSql = "select name from competition where name='$competitionName' and date='$competitionDate'";
        $competition = num_rows(query($getCompetitionSql));
        if ($competition) {
            echo "<div class='card col-6 p-4 mt-4'>
                        <div class='row justify-content-center'>
                            <h4 class='text-center text-danger mb-4'>Próbujesz dodać zawody które już istnieją!
                            <input type='button' onclick=location.href='../AddCompetition.php' class='w-50 btn btn-secondary mb-3' value='Dodaj inne zawody' />
                        </div>
                    </div>";
            exit();
        } else {
            $createCompetitionSql = "   insert into competition
                                        values (null,'$competitionName','$competitionLocation', '$competitionDescription',
                                        '$competitionDate', '$competitionStartHour','1','0','1')";
            query($createCompetitionSql);

            $id = insert_id();
            for ($i = 0; $i < count($competitionDistance); $i++) {
                $createCompetitionDistanceSql = "   insert into distance
                                                 values(null, $id, '$competitionDistance[$i]', $competitionDistanceLimit[$i])";
                query($createCompetitionDistanceSql);
            }
            dbClose();
            header('Location: AddCompetition.php?ok=1');
        }
    }
}

function isOpenRegistration($competitionId)
{
    dbConnect();
    $getCompetitionSql = "SELECT * FROM competition WHERE competitionId='{$competitionId}'";
    $competition = fetch_array(query($getCompetitionSql));

    if ($competition['registration'] != 1) {
        return false;
    }
    return true;
}

function endTheEvent($competitionId)
{
    $sqlQuerry = "UPDATE competition SET finished = 1 WHERE competitionId='{$competitionId}'";
    query($sqlQuerry);
}

function deleteEvent($competitionId)
{
    $sqlQuerry = "UPDATE competition SET  isactive = 0 WHERE competitionId='{$competitionId}'";
    query($sqlQuerry);
}

function closeRegistration($competitionId)
{
    $sqlQuerry = "UPDATE competition SET  registration = 0 WHERE competitionId='{$competitionId}'";
    query($sqlQuerry);
}

function openRegistration($competitionId)
{
    $sqlQuerry = "UPDATE competition SET  registration = 1 WHERE competitionId='{$competitionId}'";
    query($sqlQuerry);
}
#endregion
