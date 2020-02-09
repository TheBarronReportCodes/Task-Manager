<?php

// start the session with a persistent cookie of 1 year
$lifetime = 60 * 60 * 24 * 365;             // 1 year in seconds
session_set_cookie_params($lifetime, '/');
session_start();
if (!isset($_SESSION['tasklistnames'])) {
    $_SESSION['tasklistnames'] = array();
}
if (!isset($_SESSION['tasklist'])) {
    $_SESSION['tasklist'] = array();
}

$action = filter_input(INPUT_POST, 'action');
$errors = array();

switch($action) {
    case 'Clear All':
        // Clear session data from memory
        $_SESSION = array();
        // Clean up session ID
        session_destroy();
        // Delete the cookie for the session
        $name = session_name();                // Get name of the session cookie
        $expire = strtotime('-1 year');        // Create expiration date in the past
        $params = session_get_cookie_params(); // Get session params
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
        break;
    case 'Add Task':
        $new_task = filter_input(INPUT_POST, 'newtask');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else { 
            $selected_list = $_SESSION['selectedlist'];        //make selected list variable
            array_push($_SESSION['tasklist'][$selected_list], $new_task); //add a value ($new_task) to the end of our $task_list array
        }
        break;
    case 'Delete Task':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);        //take in id from task list page
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else { 
            $selected_list = $_SESSION['selectedlist'];                              //make selected list variable
            $task_list = $_SESSION['tasklist'][$selected_list];                     //make task list variable so we can call the index
            unset($task_list[$task_index]);                                         //remove index of on array based on id from task list page. This does NOT return the array
            $_SESSION['tasklist'][$selected_list] = array_values($task_list);       //update array to be equal to the modified array (array_values RETURNS the array)
        }
        break;
    case 'Add List':       
        $new_list_name = filter_input(INPUT_POST, 'newlistname');    //filter name to a variable
        if (empty($new_list_name)) {         
            $errors[] = 'The new list cannot be empty.';        //throw error if empty
        } else {
            //Note that this is a 2D array. the tasks are an array within the lists
            $_SESSION['tasklistnames'][] = $new_list_name;  //add value to session lists array (accepts arrays of tasks)
            $_SESSION['selectedlist'] = $new_list_name;     //added value becomes new selected list in the array
            $_SESSION['tasklist'][$new_list_name] = array();  //Set each new list created equal to an empty array
        }
        break;
    case 'Select List':
        $listname = filter_input(INPUT_POST, 'listname'); //listname currently selected from the dropdown
        $_SESSION['selectedlist'] = $listname; //list name from dropdown becomes new selected list in the array
        break;
}

// setup variables for view
$task_list_names = array();
$task_list = array();

if (isset($_SESSION['tasklistnames'])) {            //if at least one list name exists
    $task_list_names = $_SESSION['tasklistnames'];  //create list name variable that contains the name of lists
    $selected_list = $_SESSION['selectedlist'];       //selected list variable stores current list selected
    $task_list = $_SESSION['tasklist'][$selected_list]; //Array for the tasks to be stored for the currently selected list
}

include('task_list.php');
?>