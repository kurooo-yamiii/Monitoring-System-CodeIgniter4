var dashboard = document.getElementById('dashboard');

// For (Supervisor UI)
var studentlist = document.getElementById('studentList');
var studentadd = document.getElementById('studentadd');
var teacherlist = document.getElementById('teachList');
var professoradd = document.getElementById('professoradd');
var pstdeployment = document.getElementById('pstDeployment');
var depteacher = document.getElementById('teachDeployment');
var statform = document.getElementById('statisticForm');
var statboard = document.getElementById('statboard');
var stateval = document.getElementById('statEval');
var evalremarks = document.getElementById('evalRemarks');
var announcement = document.getElementById('announcement');
var profile = document.getElementById('profile');
var profileup = document.getElementById('profileupdate');
var profilestud = document.getElementById('profilestud');

// Buttons
var studlistbut = document.getElementById('studlistbut');
var teachlistbut = document.getElementById('teachlistbut');
var depbtn = document.getElementById('deploybtn');
var annbtn = document.getElementById('annbtn'); 
var accbtn = document.getElementById('accbtn'); 


function refProfilestud()
{

  localStorage.setItem('showTodoFlag', 'true');
  location.reload(); 
}

function profilestudShow() 
{     
      profilestud.style.display = 'block';
      profileup.style.display = 'none';
      profile.style.display = 'none';
      accbtn.style.background = 'none';
      announcement.style.display = 'none';
      annbtn.style.background = 'none';
      evalremarks.style.display = 'none';
      stateval.style.display = 'none';
      statform.style.display = 'none';
      depteacher.style.display = 'none';
      pstdeployment.style.display = 'none';
      depbtn.style.background = 'none';
      teacherlist.style.display = 'none';
      teachlistbut.style.background = 'none';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
}

function refProfileUp()
{

  localStorage.setItem('showProfileUpFlag', 'true');
  location.reload(); 
}

function profileUpShow() 
{     
      profileup.style.display = 'block';
      profile.style.display = 'none';
      accbtn.style.background = 'rgb(1, 1, 46)';
      announcement.style.display = 'none';
      annbtn.style.background = 'none';
      evalremarks.style.display = 'none';
      stateval.style.display = 'none';
      statform.style.display = 'none';
      depteacher.style.display = 'none';
      pstdeployment.style.display = 'none';
      depbtn.style.background = 'none';
      teacherlist.style.display = 'none';
      teachlistbut.style.background = 'none';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
}


function refProfile()
{

  localStorage.setItem('showProfileFlag', 'true');
  location.reload(); 
}

function profileShow() 
{     
      profile.style.display = 'block';
      accbtn.style.background = 'rgb(1, 1, 46)';
      announcement.style.display = 'none';
      annbtn.style.background = 'none';
      evalremarks.style.display = 'none';
      stateval.style.display = 'none';
      statform.style.display = 'none';
      depteacher.style.display = 'none';
      pstdeployment.style.display = 'none';
      depbtn.style.background = 'none';
      teacherlist.style.display = 'none';
      teachlistbut.style.background = 'none';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
      profileup.style.display = 'none';
}


function refAnnouncement()
{

  localStorage.setItem('showAnnouncementFlag', 'true');
  location.reload(); 
}

function announcementShow() 
{     
      announcement.style.display = 'block';
      annbtn.style.background = 'rgb(1, 1, 46)';
      evalremarks.style.display = 'none';
      stateval.style.display = 'none';
      statform.style.display = 'none';
      depteacher.style.display = 'none';
      pstdeployment.style.display = 'none';
      depbtn.style.background = 'none';
      teacherlist.style.display = 'none';
      teachlistbut.style.background = 'none';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
      profile.style.display = 'none';
      accbtn.style.background = 'none';
      profileup.style.display = 'none';
}


function refStatRemarks()
{

  localStorage.setItem('showStatRemarkFlag', 'true');
  location.reload(); 
}

function statRemarksShow() 
{     
      evalremarks.style.display = 'block';
      stateval.style.display = 'none';
      statform.style.display = 'none';
      depteacher.style.display = 'none';
      pstdeployment.style.display = 'none';
      depbtn.style.background = 'none';
      teacherlist.style.display = 'none';
      teachlistbut.style.background = 'none';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
      annbtn.style.background = 'none';
      profile.style.display = 'none';
      accbtn.style.background = 'none';
      profileup.style.display = 'none';
}


function refStatEval()
{

  localStorage.setItem('showStatEvalFlag', 'true');
  location.reload(); 
}

function statEvalShow() 
{     
      stateval.style.display = 'block';
      depbtn.style.background = 'none';
      teachlistbut.style.background = 'none';
      studlistbut.style.background = 'none';
      annbtn.style.background = 'none';
      profile.style.display = 'none';
      accbtn.style.background = 'none';
      profileup.style.display = 'none';
}


function refStatBoard()
{

  localStorage.setItem('showStatBoardFlag', 'true');
  location.reload(); 
}

function statBoardShow() 
{     
      statboard.style.display = 'block';
      depbtn.style.background = 'none';
      teachlistbut.style.background = 'none';
      studlistbut.style.background = 'none';
      annbtn.style.background = 'none';
      profile.style.display = 'none';
      accbtn.style.background = 'none';
      profileup.style.display = 'none';
}

function refStatForm()
{
  localStorage.setItem('showStatFlag', 'true');
  location.reload(); 
}

function statFormShow() 
{     
      statform.style.display = 'block';
      depteacher.style.display = 'none';
      pstdeployment.style.display = 'none';
      depbtn.style.background = 'none';
      teacherlist.style.display = 'none';
      teachlistbut.style.background = 'none';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
      statboard.style.display = 'none';
       stateval.style.display = 'none';
       evalremarks.style.display = 'none';
       annbtn.style.background = 'none';
       profile.style.display = 'none';
       accbtn.style.background = 'none';
       profileup.style.display = 'none';
}

function refTeachDeploy() 
{
      localStorage.setItem('showTeachDepFlag', 'true');
      location.reload(); 
}

function teachDeploy() 
{     
      depteacher.style.display = 'block';
      pstdeployment.style.display = 'none';
      depbtn.style.background = 'rgb(1, 1, 46)';
      teacherlist.style.display = 'none';
      teachlistbut.style.background = 'none';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
      statform.style.display = 'none';
      statboard.style.display = 'none';
      stateval.style.display = 'none';
      evalremarks.style.display = 'none';
      annbtn.style.background = 'none';
      profile.style.display = 'none';
      accbtn.style.background = 'none';
      profileup.style.display = 'none';
}

function refreshDeploy() 
{
      localStorage.setItem('showDepFlag', 'true');
      location.reload(); 
}

function pstDeployment() 
{     
      depteacher.style.display = 'none';
      pstdeployment.style.display = 'block';
      depbtn.style.background = 'rgb(1, 1, 46)';
      teacherlist.style.display = 'none';
      teachlistbut.style.background = 'none';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
      statform.style.display = 'none';
      statboard.style.display = 'none';
      stateval.style.display = 'none';
      evalremarks.style.display = 'none';
      annbtn.style.background = 'none';
      profile.style.display = 'none';
      accbtn.style.background = 'none';
      profileup.style.display = 'none';
}



function refreshTeachList() 
{
      localStorage.setItem('showTeachListFlag', 'true');
      location.reload(); 
}

function ShowTeachList() 
{
    
      teacherlist.style.display = 'block';
      teachlistbut.style.background = 'rgb(1, 1, 46)';
      dashboard.style.display = 'none';
      studentlist.style.display = 'none';
      studlistbut.style.background = 'none';
      studentadd.style.display = 'none';
      professoradd.style.display = 'none';
      pstdeployment.style.display = 'none';
      depbtn.style.background = 'none';
      depteacher.style.display = 'none';
      statform.style.display = 'none';
      statboard.style.display = 'none';
      stateval.style.display = 'none';
      evalremarks.style.display = 'none';
      annbtn.style.background = 'none';
      profile.style.display = 'none';
      accbtn.style.background = 'none';
      profileup.style.display = 'none';
}


function refreshDashboard()
{
    localStorage.setItem('showDashFlag', 'true');
    location.reload();
}

function showDashboard()
{
        
        dashboard.style.display = 'block';
        teachlistbut.style.background = 'none';
        studlistbut.style.background = 'none';
        studentadd.style.display = 'none';
        teacherlist.style.display = 'none';
        professoradd.style.display = 'none';
        pstdeployment.style.display = 'none';
        depbtn.style.background = 'none';
        depteacher.style.display = 'none';
        statform.style.display = 'none';
        statboard.style.display = 'none';
        stateval.style.display = 'none';
        evalremarks.style.display = 'none';
        annbtn.style.background = 'none';
        profile.style.display = 'none';
        accbtn.style.background = 'none';
        profileup.style.display = 'none';
}

function refreshStudList()
{
    localStorage.setItem('showStudListFlag', 'true');
    location.reload();  
}


function ShowStudList() {

  dashboard.style.display = 'none';
    studentlist.style.display = 'block';
    studlistbut.style.background = 'rgb(1, 1, 46)';
    studentadd.style.display = 'none';
    teacherlist.style.display = 'none';
    teachlistbut.style.background = 'none';
    professoradd.style.display = 'none';
    pstdeployment.style.display = 'none';
    depbtn.style.background = 'none';
    depteacher.style.display = 'none';
    statform.style.display = 'none';
    statboard.style.display = 'none';
    stateval.style.display = 'none';
    evalremarks.style.display = 'none';
    annbtn.style.background = 'none';
    profile.style.display = 'none';
    accbtn.style.background = 'none';
    profileup.style.display = 'none';
}

function studentAdd() 
{   
  
    studentadd.style.display = 'block';
    studentlist.style.display = 'none';
    studlistbut.style.background = 'rgb(1, 1, 46)';
    dashboard.style.display = 'none';
    teacherlist.style.display = 'none';
    teachlistbut.style.background = 'none';
    professoradd.style.display = 'none';
    pstdeployment.style.display = 'none';
    depbtn.style.background = 'none';
    depteacher.style.display = 'none';
    statform.style.display = 'none';
    statboard.style.display = 'none';
    stateval.style.display = 'none';
    evalremarks.style.display = 'none';
    annbtn.style.background = 'none';
    profile.style.display = 'none';
    accbtn.style.background = 'none';
    profileup.style.display = 'none';
}

function professorAdd() {


  studentlist.style.display = 'none';
  studlistbut.style.background = 'none';
  dashboard.style.display = 'none';
  studentadd.style.display = 'none';
  teacherlist.style.display = 'none';
  teachlistbut.style.background = 'rgb(1, 1, 46)';
  professoradd.style.display = 'block';
  pstdeployment.style.display = 'none';
  depbtn.style.background = 'none';
  depteacher.style.display = 'none';
  statform.style.display = 'none';
  statboard.style.display = 'none';
  stateval.style.display = 'none';
  evalremarks.style.display = 'none';
  annbtn.style.background = 'none';
  profile.style.display = 'none';
  accbtn.style.background = 'none';
  profileup.style.display = 'none';

}

if (localStorage.getItem('showStudListFlag') === 'true') {
    ShowStudList();
    localStorage.removeItem('showStudListFlag');
}else if (localStorage.getItem('showDashFlag') === 'true') {
  showDashboard();
  localStorage.removeItem('showDashFlag');
}else if (localStorage.getItem('showTeachListFlag') === 'true') {
  ShowTeachList();
  localStorage.removeItem('showTeachListFlag');
}else if (localStorage.getItem('showDepFlag') === 'true') {
  pstDeployment();
  localStorage.removeItem('showDepFlag');
}else if (localStorage.getItem('showTeachDepFlag') === 'true') {
  teachDeploy(); 
  localStorage.removeItem('showTeachDepFlag');
}else if (localStorage.getItem('showStatFlag') === 'true') {
  statFormShow(); 
  localStorage.removeItem('showStatFlag');
}else if (localStorage.getItem('showStatBoardFlag') === 'true') {
  statBoardShow(); 
  localStorage.removeItem('showStatBoardFlag');
}else if (localStorage.getItem('showStatEvalFlag') === 'true') {
  statEvalShow(); 
  localStorage.removeItem('showStatEvalFlag');
}else if (localStorage.getItem('showStatRemarkFlag') === 'true') {
  statRemarksShow(); 
  localStorage.removeItem('showStatRemarkFlag');
}else if (localStorage.getItem('showAnnouncementFlag') === 'true') {
  announcementShow(); 
  localStorage.removeItem('showAnnouncementFlag');
}else if (localStorage.getItem('showProfileFlag') === 'true') {
  profileShow(); 
  localStorage.removeItem('showProfileFlag');
}else if (localStorage.getItem('showProfileUpFlag') === 'true') {
  profileUpShow(); 
  localStorage.removeItem('showProfileUpFlag');
}else if (localStorage.getItem('showTodoFlag') === 'true') {
  profilestudShow() 
  localStorage.removeItem('showTodoFlag');
}

// AJAX for Search


function searchRecords() {
    var searchTerm = $('#search').val().trim();
    var tablestudent = document.getElementById('startuptable');
    tablestudent.style.display = 'none';
    // Perform AJAX request
    $.ajax({
        type: 'POST',
        url: 'searchstudent.php',
        data: { search: searchTerm },
        success: function (response) {
            // Clear existing content before updating with new search results
            $('#searchResults').empty();

            // Update the content with the search results
            $('#searchResults').html(response);
        }
    });
}


function searchprofRecords() {
  var searchprofTerm = $('#searchprof').val().trim();
  var tableprof = document.getElementById('startupproftable');
  tableprof.style.display = 'none';
  // Perform AJAX request
  $.ajax({
      type: 'POST',
      url: 'searchprof.php',
      data: { search: searchprofTerm },
      success: function (response) {
          // Clear existing content before updating with new search results
          $('#searchprofResults').empty();

          // Update the content with the search results
          $('#searchprofResults').html(response);
      }
  });
}

function searchdeploystudent() {
  var deptstudent = $('#depstudent').val().trim();
 

  // Show a loading indicator (you can customize this based on your needs)
  $('#DeployResult').html('<p>Loading...</p>');

  // Perform AJAX request
  $.ajax({
      type: 'POST',
      url: 'searchdepstud.php',
      data: { search: deptstudent },
      success: function (response) {
          // Clear existing content before updating with new search results
          $('#DeployResult').empty();
          $('#showstudent').empty();
          // Update the content with the search results
          $('#DeployResult').html(response);
  
          
      },
      error: function (xhr, status, error) {
          // Handle errors
          $('#DeployResult').html('<p>Error: ' + error + '</p>');
      }
  });
}
 
function searchdeployteach() {
  var depteach = $('#depteach').val().trim();
 

  // Show a loading indicator (you can customize this based on your needs)
  $('#TeachResult').html('<p>Loading...</p>');

  // Perform AJAX request
  $.ajax({
      type: 'POST',
      url: 'searchdepteach.php',
      data: { search: depteach },
      success: function (response) {
          // Clear existing content before updating with new search results
          $('#TeachResult').empty();
          $('#showteach').empty();
          // Update the content with the search results
          $('#TeachResult').html(response);
  
          
      },
      error: function (xhr, status, error) {
          // Handle errors
          $('#TeachResult').html('<p>Error: ' + error + '</p>');
      }
  });
}

function searchStatPst() {
  var statpst = $('#statpst').val().trim();
 

  // Show a loading indicator (you can customize this based on your needs)
  $('#StatResult').html('<p>Loading...</p>');

  // Perform AJAX request
  $.ajax({
      type: 'POST',
      url: 'searchstat.php',
      data: { search: statpst },
      success: function (response) {
          // Clear existing content before updating with new search results
          $('#StatResult').empty();
          $('#showstats').empty();
          // Update the content with the search results
          $('#StatResult').html(response);
  
          
      },
      error: function (xhr, status, error) {
          // Handle errors
          $('#StatResult').html('<p>Error: ' + error + '</p>');
      }
  });
}

function showStrand(section) {
 

  // Show a loading indicator (you can customize this based on your needs)
  $('#StatResult').html('<p>Loading...</p>');

  // Perform AJAX request
  $.ajax({
      type: 'POST',
      url: 'showstrand.php',
      data: { sec: section },
      success: function (response) {
          // Clear existing content before updating with new search results
          $('#StatResult').empty();
          $('#showstats').empty();
          // Update the content with the search results
          $('#StatResult').html(response);
  
          
      },
      error: function (xhr, status, error) {
          // Handle errors
          $('#StatResult').html('<p>Error: ' + error + '</p>');
      }
  });
}

// Delete from Table with ID AJAX


  function deleteRecord(id) {
    var tablestudent = document.getElementById('startuptable');
    tablestudent.style.display = 'none';
    $.ajax({
      type: 'POST', // or 'GET'
      url: 'deletestudent.php', // Replace with your server-side script to handle deletion
      data: { id: id },
      success: function(response) {
        $('#searchResults').empty();

            // Update the content with the search results
            $('#searchResults').html(response);
         
      },
      error: function(error) {
        // Handle error
        console.error(error);
      }
    });
  }

  function deleteprofRecord(profid) {
    var tableprof = document.getElementById('startupproftable');
    tableprof.style.display = 'none';
    $.ajax({
      type: 'POST', // or 'GET'
      url: 'deleteprof.php', // Replace with your server-side script to handle deletion
      data: { id: profid },
      success: function(response) {
        $('#searchprofResults').empty();

            // Update the content with the search results
            $('#searchprofResults').html(response);
         
      },
      error: function(error) {
        // Handle error
        console.error(error);
      }
    });
  }

  function deleteAnnounce(deleteID) {
  // Create a new FormData object
  var announceFormData = new FormData();
  
  // Append the delete ID to the FormData object
  announceFormData.append('id', deleteID);

  // Create a new XMLHttpRequest object
  var anndel = new XMLHttpRequest();
  
  // Open a POST request to 'delann.php' endpoint
  anndel.open('POST', 'delann.php', true);

  // Set the onload event handler to handle the response
  anndel.onload = function () {
    if (anndel.status >= 200 && anndel.status < 300) {
      var announce = document.getElementById('announcelist');
      announce.style.display = 'none';
      $('#newannouncelist').empty();
      $('#newannouncelist').html(anndel.responseText);
      $('#post').val('');
      document.getElementById('choosepost').value = '';
    } else {
      $('#newannouncelist').empty();
      $('#newannouncelist').html(anndel.responseText);
    }
  };

  // Send the FormData object with the delete ID to the server
  anndel.send(announceFormData);
}


  function updateRecord(id) {
    var tablestudent = document.getElementById('startuptable');
    tablestudent.style.display = 'none';
    $.ajax({
      type: 'POST', // or 'GET'
      url: 'setpasstudent.php', // Replace with your server-side script to handle deletion
      data: { id: id },
      success: function(response) {
        $('#searchResults').empty();

            // Update the content with the search results
            $('#searchResults').html(response);
         
      },
      error: function(error) {
        // Handle error
        console.error(error);
      }
    });
  }

  function updateprofRecord(profid) {
    var tableprof = document.getElementById('startupproftable');
    tableprof.style.display = 'none';
    $.ajax({
      type: 'POST', // or 'GET'
      url: 'setpassprof.php', // Replace with your server-side script to handle deletion
      data: { id: profid },
      success: function(response) {
        $('#searchprofResults').empty();

            // Update the content with the search results
            $('#searchprofResults').html(response);
         
      },
      error: function(error) {
        // Handle error
        console.error(error);
      }
    });
  } 
  
  function statisticID(statid) {
      var supID = $('#SupID').val().trim();
    $.ajax({
      type: 'POST', 
      url: 'setstatid.php', 
      data: { id: statid, sup: supID },
      success: function(response) {
          refStatBoard();
         
      },
      error: function(error) {
        // Handle error
        console.error(error);
      }
    });
  }

    
  function remarksDisplay() {
    var RemID = $('#RemID').val().trim();
    var SupID = $('#SupID').val().trim();
  $.ajax({
    type: 'POST', 
    url: 'remarksdisplay.php', 
    data: { id: RemID, sup: SupID },
    success: function(response) {
      refStatRemarks();
       
    },
    error: function(error) {
      // Handle error
      console.error(error);
    }
  });
}



// Using AJAX Adding Student Account and Referesh my Table

document.getElementById('studAcc').addEventListener('click', function() {
  var formData = new FormData(document.getElementById('studentadd'));
  var xhrStudent = new XMLHttpRequest(); 
  xhrStudent.open('POST', 'pstaddq.php', true);

  xhrStudent.onload = function() {
    if (xhrStudent.status >= 200 && xhrStudent.status < 300) {
      refreshStudList();
      location.reload();
    } else {
      console.error('Request failed with status ' + xhrStudent.status);
    }
  };

  xhrStudent.send(formData);
});

document.getElementById('profAcc').addEventListener('click', function(event) {
  event.preventDefault();

  var formData2 = new FormData(document.getElementById('professoradd'));
  var xhrProfessor = new XMLHttpRequest();
  xhrProfessor.open('POST', 'profadd.php', true);

  xhrProfessor.onload = function() {
    if (xhrProfessor.status >= 200 && xhrProfessor.status < 300) {
      refreshTeachList(); 
      location.reload();
    } else {
      console.error('Request failed with status ' + xhrProfessor.status);
    }
  };

  xhrProfessor.send(formData2);
});

// Saving the StudID for Deployment

function deploymentID(depID) {

  var depIDFormData = new FormData(document.getElementById('pstDeployment'));
  depIDFormData.append('DepID', depID);

  var depIDxhr = new XMLHttpRequest();
  depIDxhr.open('POST', 'depstudentid.php', true);

  depIDxhr.onload = function () {
      if (depIDxhr.status >= 200 && depIDxhr.status < 300) {
          
          refTeachDeploy();
      } else {
          console.error('Request failed with status ' + depIDxhr.status);
      }
  };

  depIDxhr.send(depIDFormData);
}

function deployTwoID(profID) {
    var deploymentFormData = new FormData(document.getElementById('teachDeployment'));
    deploymentFormData.append('profID', profID);

    var deploymentxhr = new XMLHttpRequest();
    deploymentxhr.open('POST', 'depselectq.php', true);

    deploymentxhr.onload = function () {
        if (deploymentxhr.status >= 200 && deploymentxhr.status < 300) {
            refreshDeploy();
            var sucrep = document.getElementById('successReport');
            sucrep.style.display = 'block';
            $('#successReport').empty();
            $('#successReport').html(deploymentxhr.responseText); // Corrected line
        } else {
            console.error('Request failed with status ' + deploymentxhr.status);
        }
    };

    deploymentxhr.send(deploymentFormData);
}

function postAnnouncement() {
  var anounceFormData = new FormData(document.getElementById('announcement'));

  var anouncexhr = new XMLHttpRequest();
  anouncexhr.open('POST', 'announcedisplay.php', true);

  anouncexhr.onload = function () {
      if (anouncexhr.status >= 200 && anouncexhr.status < 300) {

          var announce = document.getElementById('announcelist');
          announce.style.display = 'none';
          $('#newannouncelist').empty();
          $('#newannouncelist').html(anouncexhr.responseText);
          $('#post').val('');
          document.getElementById('choosepost').value = '';
      } else {
        $('#newannouncelist').empty();
        $('#newannouncelist').html(anouncexhr.responseText);
      }
  };

  anouncexhr.send(anounceFormData);
}

function updateProfile() {
  var profFormData = new FormData(document.getElementById('profileupdate'));

  var profxhr = new XMLHttpRequest();
  profxhr.open('POST', 'supprofile.php', true);

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

