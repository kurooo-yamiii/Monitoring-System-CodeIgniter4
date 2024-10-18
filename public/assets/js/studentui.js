
var dashboard = document.getElementById('dashboard');

// For (Student UI)
var dtr = document.getElementById('dtr');
var addDtr = document.getElementById('addDtr');
var showeval = document.getElementById('showEval');
var displayeval = document.getElementById('displayEval');
var announce = document.getElementById('announcement');
var profile = document.getElementById('profile');
var profileupdate = document.getElementById('profileupdate');
var todolist = document.getElementById('todolist');

// Buttons
var evalbtn = document.getElementById('evalbtn');
var dtrbtn = document.getElementById('dtrbtn');
var anounbtn = document.getElementById('anounbtn');
var profbtn = document.getElementById('profbtn');
var todobtn = document.getElementById('todobtn');


function refTodoList()
{
    localStorage.setItem('showTodoFlag', 'true');
    location.reload();  
}

function showTodoList() 
{
    todolist.style.display = 'block';
    todobtn.style.background = 'rgb(1, 1, 46)';
    profileupdate.style.display = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    dashboard.style.display = 'none'; 
    dtr.style.display = 'none';
    addDtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    showeval.style.display = 'none';
    evalbtn.style.background = 'none';
    displayeval.style.display = 'none';
    anounbtn.style.background = 'none';
    announce.style.display = 'none';
    
}

function refreshprofileUp()
{
    localStorage.setItem('showUpprofFlag', 'true');
    location.reload();  
}

function profileUp() 
{
    profileupdate.style.display = 'block';
    profile.style.display = 'none';
    profbtn.style.background = 'rgb(1, 1, 46)';
    dashboard.style.display = 'none'; 
    dtr.style.display = 'none';
    addDtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    showeval.style.display = 'none';
    evalbtn.style.background = 'none';
    displayeval.style.display = 'none';
    anounbtn.style.background = 'none';
    announce.style.display = 'none';
    todolist.style.display = 'none';
    todobtn.style.background = 'none';
    
}

function refreshProf()
{
    localStorage.setItem('showProfFlag', 'true');
    location.reload();  
}

function showProf() 
{
    profile.style.display = 'block';
    profbtn.style.background = 'rgb(1, 1, 46)';
    dashboard.style.display = 'none';
    dtr.style.display = 'none';
    addDtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    showeval.style.display = 'none';
    evalbtn.style.background = 'none';
    displayeval.style.display = 'none';
    anounbtn.style.background = 'none';
    announce.style.display = 'none';
    profileupdate.style.display = 'none';
    todolist.style.display = 'none';
    todobtn.style.background = 'none';
}

function showAnou() 
{
    dashboard.style.display = 'none'; 
    dtr.style.display = 'none';
    addDtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    showeval.style.display = 'none';
    evalbtn.style.background = 'none';
    displayeval.style.display = 'none';
    anounbtn.style.background = 'rgb(1, 1, 46)';
    announce.style.display = 'block';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileupdate.style.display = 'none';
    todolist.style.display = 'none';
    todobtn.style.background = 'none';
}
function refreshDashboard()
{
    localStorage.setItem('showDashFlag', 'true');
    location.reload();
}

function showDashboard()
{
        dashboard.style.display = 'block';
        addDtr.style.display = 'none';
        dtr.style.display = 'none';
        dtrbtn.style.background = 'none';
        showeval.style.display = 'none';
        evalbtn.style.background = 'none';
        displayeval.style.display = 'none';
        anounbtn.style.background = 'none';
        announce.style.display = 'none';
        profile.style.display = 'none';
        profbtn.style.background = 'none';
        profileupdate.style.display = 'none';
        todolist.style.display = 'none';
        todobtn.style.background = 'none';
}

function refreshDtr()
{
    localStorage.setItem('showDtrFlag', 'true');
    location.reload();  
}

function showDtr()
{       
        dtrbtn.style.background = 'rgb(1, 1, 46)'; 
        dtr.style.display = 'block';
        dashboard.style.display = 'none'; 
        addDtr.style.display = 'none';
        showeval.style.display = 'none';
        evalbtn.style.background = 'none';
        displayeval.style.display = 'none';
        anounbtn.style.background = 'none';
        announce.style.display = 'none';
        profile.style.display = 'none';
        profbtn.style.background = 'none';
        profileupdate.style.display = 'none';
        todolist.style.display = 'none';
        todobtn.style.background = 'none';
}

function AddDtr()
{       
        addDtr.style.display = 'block';
        dtrbtn.style.background = 'rgb(1, 1, 46)';
        dashboard.style.display = 'none'; 
        dtr.style.display = 'none';
        showeval.style.display = 'none';
        evalbtn.style.background = 'none';
        displayeval.style.display = 'none';
        anounbtn.style.background = 'none';
        announce.style.display = 'none';
        profile.style.display = 'none';
        profbtn.style.background = 'none';
        profileupdate.style.display = 'none';
        todolist.style.display = 'none';
        todobtn.style.background = 'none';
}

function showEval()
{   
    showeval.style.display = 'block';
    evalbtn.style.background = 'rgb(1, 1, 46)';
    dashboard.style.display = 'none'; 
    dtr.style.display = 'none';
    addDtr.style.display = 'none';
    dtrbtn.style.background = 'none'; 
    displayeval.style.display = 'none';
    anounbtn.style.background = 'none';
    announce.style.display = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileupdate.style.display = 'none';
    todolist.style.display = 'none';
    todobtn.style.background = 'none';
}

function refEval()
{
    localStorage.setItem('showListFlag', 'true');
    location.reload();
}


function evalView()
{
    evalbtn.style.background = 'rgb(1, 1, 46)';
    displayeval.style.display = 'block';
    dashboard.style.display = 'none'; 
    dtr.style.display = 'none';
    addDtr.style.display = 'none';
    dtrbtn.style.background = 'none';
    showeval.style.display = 'none';
    anounbtn.style.background = 'none';
    announce.style.display = 'none';
    profile.style.display = 'none';
    profbtn.style.background = 'none';
    profileupdate.style.display = 'none';
    todolist.style.display = 'none';
    todobtn.style.background = 'none';
}

// If Else for Reloading my Page

if (localStorage.getItem('showDtrFlag') === 'true') {
    showDtr();
    localStorage.removeItem('showDtrFlag');
}else if (localStorage.getItem('showDashFlag') === 'true') {
    showDashboard();
    localStorage.removeItem('showDashFlag');
}else if (localStorage.getItem('showEvalFlag') === 'true') {
    evalView();
    localStorage.removeItem('showEvalFlag');
}else if (localStorage.getItem('showListFlag') === 'true') {
    showEval();
    localStorage.removeItem('showListFlag');
}else if (localStorage.getItem('showProfFlag') === 'true') {
    showProf();
    localStorage.removeItem('showProfFlag');
}else if (localStorage.getItem('showUpprofFlag') === 'true') {
    profileUp();
    localStorage.removeItem('showUpprofFlag');
}else if (localStorage.getItem('showTodoFlag') === 'true') {
    showTodoList();
    localStorage.removeItem('showTodoFlag');
}

// Ajax proces starts here

// Using AJAX to Add DTR and Refresh the Table
document.getElementById('insertDtr').addEventListener('click', function() {
    var formDataDtr = new FormData(document.getElementById('addDtr'));
    var xhrDtr = new XMLHttpRequest();
    xhrDtr.open('POST', 'add.php', true);

    xhrDtr.onload = function() {
        if (xhrDtr.status >= 200 && xhrDtr.status < 300) {
            localStorage.setItem('showDtrFlag', 'true');
            location.reload();
        } else {
            $('#dtrfailed').empty();
            $('#dtrfailed').html(xhrDtr.responseText);
        }
    };

    xhrDtr.onerror = function() {
        console.error("Network error occurred.");
    };

    xhrDtr.send(formDataDtr);
});

// Using AJAX for Profile Update and Refresh

function setProfile() {
    var profFormData = new FormData(document.getElementById('profileupdate'));
  
    var profxhr = new XMLHttpRequest();
    profxhr.open('POST', 'profileup.php', true);
  
    profxhr.onload = function () {
        if (profxhr.status >= 200 && profxhr.status < 300) {
            refreshProf();
        } else {
          $('#updatefeedback').empty();
          $('#updatefeedback').html(profxhr.responseText);
        }
    };
  
    profxhr.send(profFormData);
  }

function refreshEval(button) {
    var evalID = button.parentElement.querySelector('input[name="evalID"]').value;

    // Use AJAX to send the value to a PHP script
    var xhrEval = new XMLHttpRequest();
    xhrEval.open("POST", "returneval.php", true);
    xhrEval.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhrEval.onreadystatechange = function() {
        if (xhrEval.readyState == 4 && xhrEval.status == 200) {
            // Handle the response from the server if needed
            console.log(xhrEval.responseText);
            // Optionally, update the view or perform other actions based on the response
            evalCue(xhrEval.responseText);
            localStorage.setItem('showEvalFlag', 'true');
            location.reload();
        }
    };
    
    xhrEval.send("evalID=" + encodeURIComponent(evalID));
}

function evalCue(response) {
    // Update the view or perform other actions based on the server response
    console.log("Server response:", response);
    // Example: Update a div with the response
    document.getElementById('resultView').innerHTML = response;
}

function deletetodo(deltodo) {
    var StudID = $('#StudID').val().trim();
    $.ajax({
      type: 'POST', 
      url: 'updatetodo.php', 
      data: { id: deltodo, studid: StudID },
      success: function(response) {
        $('#updateTodo').empty();
        $('#todoError').empty();
        $('#updateTodo').html(response);
      },
      error: function(error) {
        console.error(error);
        $('#todoError').empty();
        $('#todoError').html(error.responseText);
      }
    });
  } 


function fetchData() {
  var date = document.getElementById("datee").value;
  var accid = document.getElementById("accid").value;
  
  $.ajax({
      type: "POST",
      url: "sortdtr.php", // Update with your PHP script URL
      data: { id: accid, date: date },
      success: function(response) {
          $('#sort').empty();
          document.getElementById("sortresult").innerHTML = response;
         
      }
  });
}



function generatePDF() {
    // Create a new jsPDF instance
    const pdf = new jsPDF();

    // Get the HTML content of the form
    const formContent = document.getElementById("dtr");

    // Set the default scale and margin values
    let scaleValue = 0.15;
    let marginValues = [20, 12, 20, 12];

    // Check the window width and adjust the scale and margin values
    if (window.innerWidth <= 1024) {
        scaleValue = 0.3;
        marginValues = [10, 58, 10, 58];
    }

    // Use html2pdf library to convert HTML to PDF
    pdf.html(formContent, {
        margin: marginValues, // Adjust the margins as needed [top, right, bottom, left]
        html2canvas: { scale: scaleValue }, // Set the scale value based on the window width
        autoPaging: true, // Center content horizontally on each page
        callback: function (pdf) {
            // Save the PDF with a specific name
            pdf.save("Daily Time Record.pdf");
        }
    });
}

document.getElementById('generatePdfButton').addEventListener('click', generatePDF);



