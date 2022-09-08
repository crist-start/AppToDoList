<?php
include_once dirname(__FILE__) . '/ToDoListController.php';

$toDoList = new ToDoListController();

if (isset($_GET['save'])) {
    $postdata = json_decode(file_get_contents('php://input'), false);
    echo $toDoList->save($postdata);
} else if (isset($_GET['finishTask'])) {
    $postdata = json_decode(file_get_contents('php://input',), false);
    echo $toDoList->finiishTask($postdata);
} else if (isset($_GET['getAll'])) {
    echo $toDoList->getAll();
} else if (isset($_GET['getActiveList'])) {
    echo $toDoList->getActiveList();
} else if (isset($_GET['getFinalizedList'])) {
    echo $toDoList->getFinalizedList();
}