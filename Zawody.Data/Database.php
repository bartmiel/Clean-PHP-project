<?php
//Łączymy plik ze zdefiniowanymi stałymi do łączności z bazą danych
require_once('Config.php');
#region Obsługa bazy danych
//Tworzymy funkcje do obsługi łączności z bazą danych
function dbConnect()
{
    global $dbConn;
    $dbConn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS)
        or exit('Błąd: ' . mysqli_connect_errno());
    if (!mysqli_select_db($dbConn, DB_NAME)) {
        if (mysqli_errno($dbConn) == 1049) {
            createDb();
            echo "Utworzono testową baze";
        } else {
            echo ('Błąd: ' . mysqli_connect_errno());
        }
    }
    mysqli_set_charset($dbConn, "utf8");
}
function query($sql)
{
    global $dbConn;
    return mysqli_query($dbConn, $sql);
}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

function fetch_assoc($result)
{
    return mysqli_fetch_assoc($result);
}

function fetch_row($result)
{
    return mysqli_fetch_row($result);
}

function num_rows($result)
{
    return mysqli_num_rows($result);
}

function insert_id()
{
    global $dbConn;
    return mysqli_insert_id($dbConn);
}

function errno()
{
    global $dbConn;
    return mysqli_errno($dbConn);
}

function dbClose()
{
    global $dbConn;
    mysqli_close($dbConn);
}
#endregion
#region Przygotowanie bazy danych oraz danych testowych
function createDb()
{
    global $dbConn;
    $sql = 'CREATE DATABASE zawodydb DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;';
    query($sql);
    mysqli_select_db($dbConn, DB_NAME);
    createTables();
    insertSampleData();
}

function createTables()
{
    $sql = 'CREATE TABLE user

            (
                userId INT NOT NULL AUTO_INCREMENT,
                firstname VARCHAR(32) NOT NULL,
                lastname VARCHAR (32) NOT NULL,
                email VARCHAR (50) NOT NULL,
                city VARCHAR (50) NOT NULL,
                address VARCHAR (150) NOT NULL,
                admin BOOLEAN NOT NULL,
                password VARCHAR (250) NOT NULL,
                clubname VARCHAR (150),
                PRIMARY KEY (`userId`)
            )';
    query($sql);

    $sql =  'CREATE TABLE competition
            (
                competitionId INT NOT NULL AUTO_INCREMENT,
                name VARCHAR(200) NOT NULL,
                location VARCHAR(50) NOT NULL,
                description VARCHAR(500) NOT NULL,
                date DATE NOT NULL,
                time TIME NOT NULL,
                registration TINYINT(1) NOT NULL,
                finished TINYINT(1) NOT NULL,
                isactive TINYINT(1) NOT NULL,
                PRIMARY KEY (`competitionId`)
            )';
    query($sql);

    $sql =  'CREATE TABLE distance
            (
                distanceId INT NOT NULL AUTO_INCREMENT,
                competitionId INT NOT NULL,
                name VARCHAR(50) NOT NULL,
                distanceLimit INT NOT NULL,
                PRIMARY KEY (`distanceId`),
                FOREIGN KEY (`competitionId`)
                REFERENCES `competition`(`competitionId`)
            )';
    query($sql);

    $sql =  'CREATE TABLE userDistance
            (
                userId INT NOT NULL,
                distanceId INT NOT NULL,
                PRIMARY KEY (`userId`,`distanceId`),
                FOREIGN KEY (`userId`)
                REFERENCES `user`(`userId`),
                FOREIGN KEY (`distanceId`)
                REFERENCES `distance`(`distanceId`)
            )';
    query($sql);

    $sql = 'CREATE TABLE finishParticipant

            (
                userId INT NOT NULL,
                distanceId INT NOT NULL,
                result TIME NOT NULL,
                PRIMARY KEY (`userId`, `distanceId`)
            )';
    query($sql);
}

function insertSampleData()
{
    $sqlArray = array(
        "INSERT INTO `user`
            VALUES (null,'Jan', 'Kowalski', 'admin@test.pl', 'Nowy Sącz', 'ul.Zielona 27 35-100 Nowy Sącz', '1', '$2y$10$7Vs8DFk5Zjw37gzUZjIBdO4MxX0nuRFwfZXI.TvKaUXCp7eqYvlye', 'Najlepsi biegacze');",
        "INSERT INTO `user`
            VALUES (null,'Krzysztof', 'Jarzyna', 'krzysztof@test.pl', 'Kraków', 'ul.Zielona 27 35-100 Nowy Sącz', '0', '$2y$10$7Vs8DFk5Zjw37gzUZjIBdO4MxX0nuRFwfZXI.TvKaUXCp7eqYvlye', 'Krakowiacy biegają super');",
        "INSERT INTO `user`
            VALUES (null,'Alina', 'Pietruszka', 'alina@test.pl', 'Tarnów', 'ul.Zielona 27 35-100 Nowy Sącz', '0', '$2y$10$7Vs8DFk5Zjw37gzUZjIBdO4MxX0nuRFwfZXI.TvKaUXCp7eqYvlye', 'Tarnów biega nocą');",
        "INSERT INTO `user`
            VALUES (null,'Małgorzata', 'Nowak', 'malgorzata@test.pl', 'Warszawa', 'ul.Zielona 27 35-100 Nowy Sącz', '0', '$2y$10$7Vs8DFk5Zjw37gzUZjIBdO4MxX0nuRFwfZXI.TvKaUXCp7eqYvlye', 'Warsaw super extra team');",
        "INSERT INTO `user`
            VALUES (null,'Tomasz', 'Wiśniewski', 'tomasz@test.pl', 'Rzeszów', 'ul.Zielona 27 35-100 Nowy Sącz', '0', '$2y$10$7Vs8DFk5Zjw37gzUZjIBdO4MxX0nuRFwfZXI.TvKaUXCp7eqYvlye', 'Rzeszowski klub biegacza');",
        
        "INSERT INTO `competition`
            VALUES (null,'VII Grand Prix Trzemeszna','Trzemeszno', 'Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis',
                    '2022-01-22','10:30:00','0', '1', '1');",
        "INSERT INTO `competition`
            VALUES (null,'	Maraton Ponoworoczny','Poznań', 'Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis',
                    '2022-01-15','12:00:00','0', '1', '1');",
        "INSERT INTO `competition`
            VALUES (null,'II Bieg Niedźwiedzia','Łódź', 'Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis',
                    '2022-02-20','12:30:00', '1', '0', '1');",
        "INSERT INTO `competition`
            VALUES (null,'Świdnicki Bieg Noworoczny','Świdnik', 'Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis',
                    '2022-02-26','12:00:00', '1', '0', '1');",
        "INSERT INTO `competition`
            VALUES (null,'Dwumaraton Olęderski','Borechowice', 'Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis',
                    '2022-03-13','10:00:00', '1', '0', '1');",
        "INSERT INTO `competition`
            VALUES (null,'Wesołe Biegi Górskie','Kraków', 'Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis',
                    '2022-03-27','14:00:00', '1', '0', '1');",
        "INSERT INTO `competition`
            VALUES (null,'Półmaraton Gór Stołowych','Nowy Sącz', 'Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis Opis opis',
                    '2022-04-02','23:00:00', '0', '0', '1');",
        
        "INSERT INTO `distance`
            VALUES (null,'1', 'Bieg główny 10 km', '100');",
        "INSERT INTO `distance`
            VALUES (null,'1', 'Bieg towarzyszący 5 km', '20');",
        "INSERT INTO `distance`
            VALUES (null,'1', 'Marsz NW 10 km', '150');",
        "INSERT INTO `distance`
            VALUES (null,'2', 'Bieg główny 20 km', '200');",
        "INSERT INTO `distance`
            VALUES (null,'2', 'Bieg towarzyszący 15 km', '70');",
        "INSERT INTO `distance`
            VALUES (null,'2', 'Marsz NW 20 km', '37');",
        "INSERT INTO `distance`
            VALUES (null,'3', 'Bieg główny 30 km', '86');",
        "INSERT INTO `distance`
            VALUES (null,'3', 'Bieg towarzyszący 25 km', '47');",
        "INSERT INTO `distance`
            VALUES (null,'3', 'Marsz NW 30 km', '69');",
        "INSERT INTO `distance`
            VALUES (null,'4', 'Bieg główny 40 km', '124');",
        "INSERT INTO `distance`
            VALUES (null,'4', 'Bieg towarzyszący 35 km', '500');",
        "INSERT INTO `distance`
            VALUES (null,'4', 'Marsz NW 40 km', '478');",
        "INSERT INTO `distance`
            VALUES (null,'5', 'Bieg główny 50 km', '12');",
        "INSERT INTO `distance`
            VALUES (null,'5', 'Bieg towarzyszący 45 km', '35');",
        "INSERT INTO `distance`
            VALUES (null,'5', 'Marsz NW 50 km', '42');",
        "INSERT INTO `distance`
            VALUES (null,'6', 'Bieg główny 60 km', '80');",
        "INSERT INTO `distance`
            VALUES (null,'6', 'Bieg towarzyszący 55 km', '90');",
        "INSERT INTO `distance`
            VALUES (null,'6', 'Marsz NW 60 km', '135');",
        "INSERT INTO `distance`
            VALUES (null,'7', 'Bieg główny 70 km', '178');",
        "INSERT INTO `distance`
            VALUES (null,'7', 'Bieg towarzyszący 65 km', '52');",
        "INSERT INTO `distance`
            VALUES (null,'7', 'Marsz NW 70 km', '65');",

        "INSERT INTO `userdistance`
            VALUES ('1','1');",
        "INSERT INTO `userdistance`
            VALUES ('1','4');",
        "INSERT INTO `userdistance`
            VALUES ('1','7');",
        "INSERT INTO `userdistance`
            VALUES ('1','10');",
        "INSERT INTO `userdistance`
            VALUES ('1','13');",
        "INSERT INTO `userdistance`
            VALUES ('1','16');",

        "INSERT INTO `userdistance`
            VALUES ('2','19');",
        "INSERT INTO `userdistance`
            VALUES ('2','1');",
        "INSERT INTO `userdistance`
            VALUES ('2','4');",
        "INSERT INTO `userdistance`
            VALUES ('2','7');",
        "INSERT INTO `userdistance`
            VALUES ('2','10');",
        "INSERT INTO `userdistance`
            VALUES ('2','13');",

        "INSERT INTO `userdistance`
            VALUES ('3','16');",
        "INSERT INTO `userdistance`
            VALUES ('3','19');",
        "INSERT INTO `userdistance`
            VALUES ('3','1');",
        "INSERT INTO `userdistance`
            VALUES ('3','4');",
        "INSERT INTO `userdistance`
            VALUES ('3','7');",
        "INSERT INTO `userdistance`
            VALUES ('3','10');",

        "INSERT INTO `userdistance`
            VALUES ('4','21');",
        "INSERT INTO `userdistance`
            VALUES ('4','13');",
        "INSERT INTO `userdistance`
            VALUES ('4','16');",
        "INSERT INTO `userdistance`
            VALUES ('4','2');",
        "INSERT INTO `userdistance`
            VALUES ('4','5');",
        "INSERT INTO `userdistance`
            VALUES ('4','8');",

        "INSERT INTO `userdistance`
            VALUES ('5','11');",
        "INSERT INTO `userdistance`
            VALUES ('5','14');",
        "INSERT INTO `userdistance`
            VALUES ('5','17');",
        "INSERT INTO `userdistance`
            VALUES ('5','20');",
        "INSERT INTO `userdistance`
            VALUES ('5','3');",
        "INSERT INTO `userdistance`
            VALUES ('5','6');",

        "INSERT INTO `userdistance`
            VALUES ('1','9');",
        "INSERT INTO `userdistance`
            VALUES ('1','12');",
        "INSERT INTO `userdistance`
            VALUES ('1','15');",
        "INSERT INTO `userdistance`
            VALUES ('1','18');",
        "INSERT INTO `userdistance`
            VALUES ('1','21');",
        "INSERT INTO `userdistance`
            VALUES ('1','1');",

        "INSERT INTO `userdistance`
            VALUES ('2','4');",
        "INSERT INTO `userdistance`
            VALUES ('2','7');",
        "INSERT INTO `userdistance`
            VALUES ('2','10');",
        "INSERT INTO `userdistance`
            VALUES ('2','13');",
        "INSERT INTO `userdistance`
            VALUES ('2','16');",
        "INSERT INTO `userdistance`
            VALUES ('2','19');",

        "INSERT INTO `userdistance`
            VALUES ('3','3');",
        "INSERT INTO `userdistance`
            VALUES ('3','6');",
        "INSERT INTO `userdistance`
            VALUES ('3','9');",
        "INSERT INTO `userdistance`
            VALUES ('3','12');",
        "INSERT INTO `userdistance`
            VALUES ('3','15');",
        "INSERT INTO `userdistance`
            VALUES ('3','18');",

        "INSERT INTO `userdistance`
            VALUES ('4','21');",
        "INSERT INTO `userdistance`
            VALUES ('4','2');",
        "INSERT INTO `userdistance`
            VALUES ('4','5');",
        "INSERT INTO `userdistance`
            VALUES ('4','7');",
        "INSERT INTO `userdistance`
            VALUES ('4','10');",
        "INSERT INTO `userdistance`
            VALUES ('4','13');",

        "INSERT INTO `userdistance`
            VALUES ('5','16');",
        "INSERT INTO `userdistance`
            VALUES ('5','19');",
        "INSERT INTO `userdistance`
            VALUES ('5','1');",
        "INSERT INTO `userdistance`
            VALUES ('5','4');",
        "INSERT INTO `userdistance`
            VALUES ('5','7');",
        "INSERT INTO `userdistance`
            VALUES ('5','10');",

        "INSERT INTO `finishParticipant`
            VALUES ('1','1','00:15:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('2','1', '00:25:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('3','1', '00:35:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('4','1', '00:45:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('5','1', '00:55:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('1','2','00:55:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('2','2', '00:45:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('3','2', '00:35:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('4','2', '00:25:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('5','2', '00:15:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('1','3','00:12:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('2','3', '00:18:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('3','3', '00:11:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('4','3', '00:09:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('5','3', '00:25:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('1','4','00:17:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('2','4', '00:34:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('3','4', '00:21:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('4','4', '00:12:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('5','4', '00:16:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('1','5','01:15:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('2','5', '01:05:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('3','5', '01:03:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('4','5', '01:16:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('5','5', '01:27:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('1','6','00:15:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('2','6', '00:25:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('3','6', '00:35:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('4','6', '00:45:00');",
        "INSERT INTO `finishParticipant`
            VALUES ('5','6', '00:55:00');",
    );
    foreach ($sqlArray as $sql)
        query($sql);
}
#endregion