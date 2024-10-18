var dashboard = document.getElementById('dashboard');

// Forms for Cooperating Teacher UI

var approvaldtr = document.getElementById('approvalDTR');
var displayeval = document.getElementById('showEval');
var studeval = document.getElementById('studEvaluation');
var addeval = document.getElementById('addEvaluation');
var todoList = document.getElementById('todolist');
var profile = document.getElementById('profile');
var profileup = document.getElementById('profileupdate');

// Buttons for Cooperating Teacher UI

var dtrbtn = document.getElementById('dtrbtn');
var evalbtn = document.getElementById('evalbtn');
var todobtn = document.getElementById('todolistbut');
var profbtn = document.getElementById('profbtn');

// All of the Function Starts Here

function refProfileUp()
{
    localStorage.setItem('showProfileUpFlag', 'true');
    location.reload();
}

function showProfileUp()
{
    profileup.style.display = 'block';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    todoList.style.display = 'none';
    todobtn.style.background = 'none';
    addeval.style.display = 'none';
    displayeval.style.display = 'none';
    evalbtn.style.background = 'none';
    approvaldtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    studeval.style.display = 'none';
}

function refProfile()
{
    localStorage.setItem('showProfileFlag', 'true');
    location.reload();
}

function showProfile()
{
    profile.style.display = 'block';
    profbtn.style.background = 'rgb(1, 1, 46)';
    todoList.style.display = 'none';
    todobtn.style.background = 'none';
    addeval.style.display = 'none';
    displayeval.style.display = 'none';
    evalbtn.style.background = 'none';
    approvaldtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    studeval.style.display = 'none';
    profileup.style.display = 'none';
}

function refTodolist()
{
    localStorage.setItem('showTodoFlag', 'true');
    location.reload();
}

function showTodolist()
{
    todoList.style.display = 'block';
    todobtn.style.background = 'rgb(1, 1, 46)';
    addeval.style.display = 'none';
    displayeval.style.display = 'none';
    evalbtn.style.background = 'none';
    approvaldtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    studeval.style.display = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileup.style.display = 'none';
}

function refAddEval()
{
    localStorage.setItem('showAddEvalFlag', 'true');
    location.reload();
}

function showAddEval()
{
    addeval.style.display = 'block';
    displayeval.style.display = 'none';
    evalbtn.style.background = 'rgb(1, 1, 46)';
    approvaldtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    studeval.style.display = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileup.style.display = 'none';
}

function showStudEval()
{
    addeval.style.display = 'none';
    studeval.style.display = 'block';
    displayeval.style.display = 'none';
    evalbtn.style.background = 'rgb(1, 1, 46)';
    approvaldtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileup.style.display = 'none';
}

function refEval()
{
    localStorage.setItem('showEvalFlag', 'true');
    location.reload();
}

function showEval()
{
    addeval.style.display = 'none';
    displayeval.style.display = 'block';
    evalbtn.style.background = 'rgb(1, 1, 46)';
    approvaldtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    studeval.style.display = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileup.style.display = 'none';
}

function refresAppDTR()
{
    localStorage.setItem('showApprovalFlag', 'true');
    location.reload();
}

function showApproval()
{
    addeval.style.display = 'none';
    approvaldtr.style.display = 'block';
    dtrbtn.style.background = 'rgb(1, 1, 46)';
    displayeval.style.display = 'none';
    evalbtn.style.background = 'none';
    studeval.style.display = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileup.style.display = 'none';
}

function refreshDashboard()
{
    localStorage.setItem('showDashFlag', 'true');
    location.reload();
}

function showDashboard()
{
    addeval.style.display = 'none';
    dashboard.style.display = 'block';
    dtrbtn.style.background = 'none';
    displayeval.style.display = 'none';
    evalbtn.style.background = 'none';
    studeval.style.display = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileup.style.display = 'none';
}

if (localStorage.getItem('showDashFlag') === 'true') {
    showDashboard();
    localStorage.removeItem('showDashFlag');
} else if (localStorage.getItem('showApprovalFlag') === 'true') {
    showApproval();
    localStorage.removeItem('showApprovalFlag');
} else if (localStorage.getItem('showEvalFlag') === 'true') {
    showEval();
    localStorage.removeItem('showEvalFlag');
} else if (localStorage.getItem('showAddEvalFlag') === 'true') {
    showAddEval();
    localStorage.removeItem('showAddEvalFlag');
} else if (localStorage.getItem('showTodoFlag') === 'true') {
    showTodolist();
    localStorage.removeItem('showTodoFlag');
} else if (localStorage.getItem('showProfileFlag') === 'true') {
  showProfile();
  localStorage.removeItem('showProfileFlag');
} else if (localStorage.getItem('showProfileUpFlag') === 'true') {
  showProfileUp();
  localStorage.removeItem('showProfileUpFlag');
}


// My AJAX starts here

function approvalUpdate(appid) {
    var StudID = $('#StudID').val().trim();
    $.ajax({
      type: 'POST', 
      url: 'approvalupdate.php', 
      data: { id: appid, stud: StudID },
      success: function(response) {
        $('#oldapproval').empty();
        $('#oldapproval').html(response);
      },
      error: function(error) {
        $('#approvalerror').empty();
        $('#approvalerror').html(error);
      }
    });
  } 
  
  function approvalDelete(delid) {
    var StudID = $('#StudID').val().trim();
    $.ajax({
      type: 'POST', 
      url: 'approvaldelete.php', 
      data: { id: delid, stud: StudID },
      success: function(response) {
        $('#oldapproval').empty();
        $('#oldapproval').html(response);
      },
      error: function(error) {
        $('#approvalerror').empty();
        $('#approvalerror').html(error);
      }
    });
  }

  function deleteApproved(appid) {
    var StudID = $('#StudID').val().trim();
    $.ajax({
      type: 'POST', 
      url: 'approvaldelete.php', 
      data: { id: appid, stud: StudID },
      success: function(response) {
        $('#oldapproval').empty();
        $('#oldapproval').html(response);
      },
      error: function(error) {
        $('#approvalerror').empty();
        $('#approvalerror').html(error);
      }
    });
  } 
  
  function deleteEvaluation(evalID) {
    var fetchid = $('#fetchid').val().trim();
    $.ajax({
      type: 'POST', 
      url: 'deleteeval.php', 
      data: { id: evalID, stud: fetchid },
      success: function(response) {
        $('#listEvaluation').empty();
        $('#listEvaluation').html(response);
      },
      error: function(error) {
        $('#displayError').empty();
        $('#displayError').html(error);
      }
    });
  } 
  
  function displayEval(evalID) {
    $.ajax({
      type: 'POST', 
      url: 'profshoweval.php', 
      data: { id: evalID },
      success: function(response) {
        showStudEval();
        $('#scoreRemarks').empty();
        $('#scoreRemarks').html(response);
      },
      error: function(error) {
        $('#catchError').empty();
        $('#catchError').html(error);
      }
    });
  } 
  
  function addTodo() {
    var StudID = $('#StudID').val().trim();
    var title = $('#todoin').val().trim();
    var date = $('#datetodoin').val().trim();
    $.ajax({
      type: 'POST', 
      url: 'coopaddtodo.php', 
      data: { id: StudID, title: title, date: date },
      success: function(response) {
        $('#updateTodo').empty();
        $('#todoError').empty();
        $('#updateTodo').html(response);
        document.getElementById("todoin").value = "";
        document.getElementById("datetodoin").value = "";
      },
      error: function(error) {
        console.error(error);
        $('#todoError').empty();
        $('#todoError').html(error.responseText);
      }
    });
  }
  
  function deletetodo(deltodo) {
    var StudID = $('#StudID').val().trim();
    $.ajax({
      type: 'POST', 
      url: 'coopdeltodo.php', 
      data: { id: StudID, delid: deltodo },
      success: function(response) {
        $('#updateTodo').empty();
        $('#todoError').empty();
        $('#updateTodo').html(response);
        document.getElementById("todoin").value = "";
        document.getElementById("datetodoin").value = "";
      },
      error: function(error) {
        console.error(error);
        $('#todoError').empty();
        $('#todoError').html(error.responseText);
      }
    });
  } 

  function generateEval() {
    var evalFormData = new FormData(document.getElementById('addEvaluation'));
  
    var evalxhr = new XMLHttpRequest();
    evalxhr.open('POST', 'evaladd.php', true);
  
    evalxhr.onload = function () {
        if (evalxhr.status >= 200 && evalxhr.status < 300) {
          showEval();
          $('#listEvaluation').empty();
          $('#listEvaluation').html(evalxhr.responseText);
        } else {
          $('#displayError').empty();
          $('#displayError').html(error);
        }
    };
  
    evalxhr.send(evalFormData);
  }

  function updateProfile() {
    var profFormData = new FormData(document.getElementById('profileupdate'));
  
    var profxhr = new XMLHttpRequest();
    profxhr.open('POST', 'coopprofile.php', true);
  
    profxhr.onload = function () {
        if (profxhr.status >= 200 && profxhr.status < 300) {
            refProfile();
        } else {
          $('#errorUpdate').empty();
          $('#errorUpdate').html(profxhr.responseText);
        }
    };
  
    profxhr.send(profFormData);
  }
  
  