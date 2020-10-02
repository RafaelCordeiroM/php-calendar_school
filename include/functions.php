<?php include "db.php" ?>
<?php
date_default_timezone_set("America/Sao_Paulo");
function array_get_agenda($route)
{

    global $connection;
    $query = mysqli_query($connection, "SELECT * from agenda");

    $index = 0;
    if ($route == "php") {
        while ($row = mysqli_fetch_assoc($query)) {

            $array[$index] = $row;
            $index++;
        }

        return $array;
    } 
    // is neccessary to obtain the agenda-hour correctly 
    else if ($route == "java_modal") {
        while ($row = mysqli_fetch_assoc($query)) {
            
            //// formating date in the correct format for js
            $date = date_create($row["agenda_date"]);
            $row["agenda_date"] = date_format($date,"d")."/".date_format($date,"m")."/".date_format($date,"Y");
            //// formating hour in the correct format for js
            $date = date_create($row["agenda_hour"]);
            $row["agenda_hour"] = date_format($date, 'H') . ":" . date_format($date, 'i')." <span class='text-muted'>hrs</span>";

            $array[$index] = $row;
            $index++;
        }

        return $array;
    }
}
function array_get_not($route)
{

    global $connection;
    $query = mysqli_query($connection, "SELECT * from notifications");

    $index = 0;
    
    if ($route == "php") {
        while ($row = mysqli_fetch_assoc($query)) {

            $array[$index] = $row;
            $index++;
        }

        return $array;
    } 
    else if ($route == "java_modal") {
        while ($row = mysqli_fetch_assoc($query)) {

            $hour = date_create($row["not_hour"]);
            $row["not_hour"] = date_format($hour, 'H') . ":" . date_format($hour, 'i')."<span class='text-muted'>hrs</span>";

            $date = date_create($row["not_date"]);
            $row["not_date"] = date_format($date, 'd') . "/" . date_format($date, 'm');


            $array[$index] = $row;
            $index++;
        }

        return $array;
    } 
}
function get_day_scheduled(){
    global $connection;
    $query = mysqli_query($connection,"SELECT agenda_date,agenda_id from agenda");

    $index = 0;
    while($row = mysqli_fetch_assoc($query)){

        $array[$index] = $row;
        $index++;
    }

    return $array;

}
function create_event(){
    global $connection;

    $title = $_POST['title'];
    $teachers = $_POST['teachers'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $array = $_POST['participants'];

    $participants = ""; 
    foreach($array as $element){
        $participants .= $element." ";
    }

    $query = "INSERT INTO agenda(agenda_title,agenda_teachers,agenda_date,agenda_hour,agenda_description,agenda_participants)";
    $query .=  "VALUES('{$title}','{$teachers}','{$date}','{$hour}','{$description}','{$participants}')";
    $execute = mysqli_query($connection,$query);

    if(!$execute){
        echo mysqli_error($connection);
    }
    
    else {
        return true;
    }
}
function update_event(){
    global $connection;

    $id = $_POST['id'];
    $title = $_POST['title'];
    $teachers = $_POST['teachers'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    
    $array = $_POST['participants'];
    $participants = ""; 
    foreach($array as $element){
        $participants .= $element." ";
    }
   
    $query = "UPDATE agenda set agenda_title = '{$title}',";
    $query .= "agenda_teachers = '{$teachers}',";
    $query .= "agenda_date = '{$date}',";
    $query .= "agenda_hour = '{$hour}',";
    $query .= "agenda_description = '{$description}',";
    $query .= "agenda_participants = '{$participants}'";
    $query .= " WHERE agenda_id = '{$id}'";
    $execute = mysqli_query($connection,$query);

    if(!$execute){
        echo mysqli_error($connection);
    }
    else {
        header("location:{$_SERVER['PHP_SELF']}");
        return true;
    }
    
}

function create_not(){
    global $connection;

    $title = $_POST['title'];
    $description = $_POST['description'];
    $hour = date("H:i");
    $date = date("Y-m-d");
    $author = $_POST['author'];


    $query = "INSERT INTO notifications(not_title,not_author,not_hour,not_date,not_description)";
    $query .=  "VALUES('{$title}','{$author}','{$hour}','{$date}','{$description}')";

    if(strlen($title) <= 100){

    
    $execute = mysqli_query($connection,$query);

    if(!$execute){
        echo mysqli_error($connection);
    }
    
    else {
        header("location:{$_SERVER['PHP_SELF']}");
        return true;
    }
}
}

function update_not(){
    global $connection;

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author = $_POST['author'];


    $query = "UPDATE notifications SET";
    $query .= "not_title =  '{$title}',";
    $query .= "not_description =  '{$description}',";
    $query .= "not_author =  '{$author}'";
    $query .= "WHERE not_id =  '{$id}'";

    $execute = mysqli_query($connection,$query);

    if(!$execute){
        echo mysqli_error($connection);
    }
    
    else {
        header("location:{$_SERVER['PHP_SELF']}");
        return true;
    }

}