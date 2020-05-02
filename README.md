# Task-Manager
###PHP application that manages the creation and removal of tasks within specific list. 

##Task
Use a session array to track data in an application.

##Criteria
One file to control the main index of the page,
One file to manage the addition and removal of tasks,
One file to control the css

##Summary of Tech Stack Because this app is used to showcase understanding of cookies and sessions, the only tech stacks used are PHP and CSS3

##Functionality This app contains funtionality that when the Clear All button is clicked, all session data is cleared
from memory, the session ID is cleaned up, and the cookie for the session is deleted. This app also contains 
functionality that adds a new list to the task manager and code that stores the currently selected task list name in the session array. I
also used a matrix names $_SESSION[‘tasklist’][‘ListName’] that was used so that each element contains a task.
