<?php 
if (!isset($_SESSION['ID']) || !isset($_SESSION['Name'])) {
    header("Location: " . site_url("TeacherController/logout"));
    exit();
}
?>
<form>
<div class="dashboard">
   <p class="announce-para">Pre-Service Teacher <span id="divForPSTName" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"> List of Evaluation </span></p>
   <div class="logos">
      <div class="logo">
         <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo 1" width="50" />
      </div>
      <div class="logo">
         <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50" />
      </div>
   </div>
   </div>
   
   <input type="text" name="id" id="id" value="<?php echo $_SESSION['Student']; ?>" hidden>
   <input type="text" name="name" id="name" value="<?php echo $_SESSION['Name']; ?>" hidden>

   <div class="divider"></div>
   <div class="button-container">
		  		<button type="button" class="btn-shadow btn btn-primary" style="font-size: 14px;" data-target="#AddNewEval"
                    id="CreatePST" onclick="openAddEvaluation()" data-toggle="modal">
                    <span class="fas fa-plus"></span> Add New Evaluation
                </button>
			</div>
	<div class="space"></div>

	<div id="EvalResult" class="todo-container"></div>

<!-- Preview Evaluation Modal -->
<div class="modal fade" id="PrevEval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"  style="max-width: 60%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Lesson: <span id="lessonHolder" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"></span></div>
							</div>	
						</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="TableforEvalPreview">
                                <thead>
                                <tr>
                                    <th scope="col">Category</th>
                                    <th scope="col">Qs1</th>
                                    <th scope="col">Qs2</th>
                                    <th scope="col">Qs3</th>
                                    <th scope="col">Qs4</th>
                                    <th scope="col">Qs5</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                        <tbody>
                </tbody>
            </table>
            <div class="space"></div>
            <div class="space"></div>
                <div>
                    <p class="button-title-remarks">Remarks</p> 
                    <textarea class="form-control" id="remarksHolder" style="margin-left: 5px; font-weight: 700;" rows="3" readonly></textarea>
                </div>
            <div class="space"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
 </div>

 <!-- Add & Update Evaluation Modal -->
<div class="modal fade" id="AddNewEval" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"  style="max-width: 60%; max-height: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Create New <span id="lessonHolder" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"> Evaluation</span></div>
							</div>	
						</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="ClearAllField()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            <input type="text" name="EvalID" id="EvalID" hidden>
            <div class="modal-navigation">
                <button class="nav-button" type="button" onclick="showSection('firstSet', this)">I. Lesson Proper</button>
                <button class="nav-button" type="button" onclick="showSection('secondSet', this)">II. Mastery of the Lesson</button>
                <button class="nav-button" type="button" onclick="showSection('thirdSet', this)">III. Lesson Plan</button>
                <button class="nav-button" type="button" onclick="showSection('fourthSet', this)">IV. Conduct of Assessment</button>
                <button class="nav-button" type="button" onclick="showSection('fifthSet', this)">V. Remarks</button>
            </div>
                <div class="space"></div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="date">Lesson</label>
                        <input type="text" class="form-control" id="lesson" name="lesson" required>
                    </div>
                    <div class="col-md-4">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>
                <div class="form-group-eval-form2 set-group" id="firstSet" style="display: none;">
                    <table class="custom-table-form2">
                        <p class="eval-title">I. Lesson Proper</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1. Ensures that all of the concepts and topic are explained in an understandable manner.</th>
                            <td class="custom-table-column-form2">
                                <select id="a1" name="a1" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">2. Uses techniques and strategies to keep students engaged and interested.</th>
                            <td class="custom-table-column-form2">
                                <select id="a2" name="a2" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">3. Provides real-life or relatable examples to reinforce lesson content.</th>
                            <td class="custom-table-column-form2">
                                <select id="a3" name="a3" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">4. Encourages student participation and responds to questions effectively.</th>
                            <td class="custom-table-column-form2">
                                <select id="a4" name="a4" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">5. Balances the lessons flow, ensuring its neither rushed nor too slow.</th>
                            <td class="custom-table-column-form2">
                                <select id="a5" name="a5" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-group-eval-form2 set-group" id="secondSet" style="display:none;">
                    <table class="custom-table-form2">
                        <p class="eval-title">II. Mastery of the Lesson</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1. Demonstrates in-depth understanding of the subject.</th>
                            <td class="custom-table-column-form2">
                                <select id="b1" name="b1" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">2. Responds accurately and confidently to students' questions.</th>
                            <td class="custom-table-column-form2">
                                <select id="b2" name="b2" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">3. Presents information logically and cohesively.</th>
                            <td class="custom-table-column-form2">
                                <select id="b3" name="b3" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">4. Adjusts teaching methods based on student responses and understanding.</th>
                            <td class="custom-table-column-form2">
                                <select id="b4" name="b4" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">5. Incorporates supplementary materials to enhance learning.</th>
                            <td class="custom-table-column-form2">
                                <select id="b5" name="b5" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-group-eval-form2 set-group" id="thirdSet" style="display:none;">
                    <table class="custom-table-form2">
                        <p class="eval-title">III. Lesson Plan</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1. Outlines clear and achievable learning objectives.</th>
                            <td class="custom-table-column-form2">
                                <select id="c1" name="c1" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">2. Designs interactive and meaningful activities related to lesson content.</th>
                            <td class="custom-table-column-form2">
                                <select id="c2" name="c2" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">3. Plans appropriate assessments that align with lesson objectives.</th>
                            <td class="custom-table-column-form2">
                                <select id="c3" name="c3" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">4. Allocates time effectively for each part of the lesson.</th>
                            <td class="custom-table-column-form2">
                                <select id="c4" name="c4" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">5. Includes varied teaching strategies to cater to different learning styles.</th>
                            <td class="custom-table-column-form2">
                                <select id="c5" name="c5" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form-group-eval-form2 set-group" id="fourthSet" style="display:none;">
                    <table class="custom-table-form2">
                        <p class="eval-title">IV Conduct of Assessment</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1. Ensures assessments reflect the lesson objectives.</th>
                            <td class="custom-table-column-form2">
                                <select id="d1" name="d1" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">2. Provides clear, understandable instructions for assessments.</th>
                            <td class="custom-table-column-form2">
                                <select id="d2" name="d2" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">3. Uses unbiased and accurate grading criteria.</th>
                            <td class="custom-table-column-form2">
                                <select id="d3" name="d3" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">4. Offers constructive feedback that promotes student growth.</th>
                            <td class="custom-table-column-form2">
                                <select id="d4" name="d4" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">5. Ensures assessments accurately gauge student understanding of the material.</th>
                            <td class="custom-table-column-form2">
                                <select id="d5" name="d5" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="fifthSet" class="set-group" style="display:none;">
                    <p class="prof-title">Remarks</p> 
                    <textarea class="form-control" id="remarks" style="margin-left: 5px; font-weight: 700;" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="ClearAllField()" data-dismiss="modal">Close</button>
                <button type="button" id="addButton" class="btn btn-primary" onclick="AddEvaluation()">Create Evaluation</button>
                <button type="button" id="updateButton" class="btn btn-primary" onclick="UpdateEvaluation()">Update Evaluation</button>
            </div>
        </div>
    </div>
 </div>

</form>

<script>

     $(document).ready(function() {
        PDOEvaluation()
      });

      function openAddEvaluation() {
        const firstSection = document.getElementById('firstSet');
        firstSection.style.display = 'block';

        const firstButton = document.querySelector('.nav-button');
        firstButton.classList.add('active');

        const upButton = document.getElementById('updateButton');
        const adButton = document.getElementById('addButton');
        upButton.style.display = 'none';
        adButton.style.display = 'block';
    }

    function showSection(sectionId, button) {
        const sections = document.querySelectorAll('.set-group');
        sections.forEach(section => {
            section.style.display = 'none';
        });

        const selectedSection = document.getElementById(sectionId);
        selectedSection.style.display = 'block';

        const buttons = document.querySelectorAll('.nav-button');
        buttons.forEach(btn => {
            btn.classList.remove('active');
        });

        button.classList.add('active');
    }

    function AddEvaluation() {

        var firstSet = {
            a1: $('#a1').val(),
            a2: $('#a2').val(),
            a3: $('#a3').val(),
            a4: $('#a4').val(),
            a5: $('#a5').val(),
        }

        var secondSet = {
            b1: $('#b1').val(),
            b2: $('#b2').val(),
            b3: $('#b3').val(),
            b4: $('#b4').val(),
            b5: $('#b5').val(),
        }

        var thirdSet = {
            c1: $('#c1').val(),
            c2: $('#c2').val(),
            c3: $('#c3').val(),
            c4: $('#c4').val(),
            c5: $('#c5').val(),
        }

        var fourthSet = {
            d1: $('#d1').val(),
            d2: $('#d2').val(),
            d3: $('#d3').val(),
            d4: $('#d4').val(),
            d5: $('#d5').val(),
        }

        var info = {
            id: $('#id').val(),
            lesson: $('#lesson').val(),
            date: $('#date').val(),
            remarks: $('#remarks').val(),
        }

        var data = {
            firstSet: firstSet,
            secondSet: secondSet,
            thirdSet: thirdSet,
            fourthSet: fourthSet,
            info: info,
        }
        
        $.ajax({
                type: 'POST',
                url: '<?php echo site_url('TeacherController/CreateEvaluation'); ?>',
                data: {
                    data: data
                },
                dataType: 'json',
                success: function(response) {
					PDOEvaluation(); 
					$('#AddNewEval').modal('hide'); 
                    ClearAllField();
					message('success', 'Evaluation Succesfully Added', 2000); 
                },
                error: function(error) {
                    message('error', 'Something Went Wrong, Try  Again', 2000); 
                }
            });
    }

    function ClearAllField() {
        $('#lesson').val('');
        $('#date').val('');
        $('#remarks').val('');

        const dropdownGroups = ['#firstSet', '#secondSet', '#thirdSet', '#fourthSet', '#fifthSet'];
        dropdownGroups.forEach(group => {
            const elements = document.querySelectorAll(`${group} select`);
            elements.forEach(select => {
                select.selectedIndex = 0;
            });
        });

        const sections = document.querySelectorAll('.set-group');
        sections.forEach(section => {
            section.style.display = 'none';
        });

        const buttons = document.querySelectorAll('.nav-button');
        buttons.forEach(btn => {
            btn.classList.remove('active');
        });
    }

    $('#AddNewEval').on('hide.bs.modal', function () {
        ClearAllField();
    });

      function PDOEvaluation() {
        const id = $('#id').val();
        $('#EvalResult').empty();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('TeacherController/PSTEvaluation'); ?>',
            data: {
                ID: id
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0) {
                    response.forEach(function(info) {
                        const formattedDate = formatDate(info.Date);

                        const scores = {
                            a1: info.a1, b1: info.b1, c1: info.c1, d1: info.d1,
                            a2: info.a2, b2: info.b2, c2: info.c2, d2: info.d2,
                            a3: info.a3, b3: info.b3, c3: info.c3, d3: info.d3,
                            a4: info.a4, b4: info.b4, c4: info.c4, d4: info.d4,
                            a5: info.a5, b5: info.b5, c5: info.c5, d5: info.d5
                        };

                        var appendEvaluation = $(` 
                            <div class="todo-itemprof">
                            <div style=" display: flex;
                                flex-direction: row;
                                justify-content: space-between;
                                align-items: center;">
                               <div style="width: auto; flex-grow: 1;">
                                    <h2>Lesson:<span class="ave" style="background-color: rgba(100, 50, 30);">${info.Lesson}</span></h2>
                                    <small style="color: rgba(100, 50, 30); font-weight: 700;">Total Average: ${info.Average}</small> 
                                    <small>Date: ${formattedDate}</small> 
                               </div>
                               <div style="width: auto;">
                                <button href="javascript:void(0);" onclick="deleteQues(${info.ID}, '${info.Name}');"type="button" class="btn btn-danger" data-target="#DeletePST" data-toggle="modal"><span class="fas fa-trash"></span></button> 
                                <button type="button" onclick="updateConstruct('${encodeURIComponent(JSON.stringify(scores))}', ${info.ID}, '${info.Lesson}', '${info.Date}', '${info.Remarks}')" class="btn btn-primary">
                                    <span class="fas fa-redo"></span>
                                </button>
                                <button onclick="previewEvaluation(${info.ID}, '${info.Lesson}')" class="btn btn-warning" type="button" data-target="#PrevEval"
                                    id="PreviewEvaluation" data-toggle="modal"><span class="fas fa-eye"></span></button> 
                               </div>
                               </div>
                            </div>
                        `);
                        $('#EvalResult').append(appendEvaluation);
                    });
                } else {
                    var noEvaluationExisting = $(`
                        <div class="todo-itemprof">
                            <button class="removee-to-do" style="background-color: rgba(100, 50, 30);" type="button">N/A</button> 
                            <h2>No current evaluation for you</h2>
                            <small>Note: Always remind your cooperating teacher to conduct evaluation for every lesson</small>
                        </div>
                    `);
                    $('#EvalResult').append(noEvaluationExisting);
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function updateConstruct(scoreString, id, lesson, date, remarks) {
        try {
        const scores = JSON.parse(decodeURIComponent(scoreString));

        $('#lesson').val(lesson);
        $('#date').val(date);
        $('#remarks').val(remarks);
        $('#EvalID').val(id);

        for (const key in scores) {
            if (scores.hasOwnProperty(key)) {
                $('#' + key).val(scores[key]);
            }
        }

        const firstSection = document.getElementById('firstSet');
        firstSection.style.display = 'block';

        const firstButton = document.querySelector('.nav-button');
        firstButton.classList.add('active');

        const upButton = document.getElementById('updateButton');
        const adButton = document.getElementById('addButton');
        upButton.style.display = 'block';
        adButton.style.display = 'none';

        $('#AddNewEval').modal('show');
    } catch (error) {
        console.error('Error parsing scores:', error);
    }
    }

    function UpdateEvaluation() {
        var firstSet = {
            a1: $('#a1').val(),
            a2: $('#a2').val(),
            a3: $('#a3').val(),
            a4: $('#a4').val(),
            a5: $('#a5').val(),
        }

        var secondSet = {
            b1: $('#b1').val(),
            b2: $('#b2').val(),
            b3: $('#b3').val(),
            b4: $('#b4').val(),
            b5: $('#b5').val(),
        }

        var thirdSet = {
            c1: $('#c1').val(),
            c2: $('#c2').val(),
            c3: $('#c3').val(),
            c4: $('#c4').val(),
            c5: $('#c5').val(),
        }

        var fourthSet = {
            d1: $('#d1').val(),
            d2: $('#d2').val(),
            d3: $('#d3').val(),
            d4: $('#d4').val(),
            d5: $('#d5').val(),
        }

        var info = {
            id: $('#EvalID').val(),
            lesson: $('#lesson').val(),
            date: $('#date').val(),
            remarks: $('#remarks').val(),
        }

        var data = {
            firstSet: firstSet,
            secondSet: secondSet,
            thirdSet: thirdSet,
            fourthSet: fourthSet,
            info: info,
        }
        
        $.ajax({
                type: 'POST',
                url: '<?php echo site_url('TeacherController/UpdateEvaluation'); ?>',
                data: {
                    data: data
                },
                dataType: 'json',
                success: function(response) {
					PDOEvaluation(); 
					$('#AddNewEval').modal('hide'); 
                    ClearAllField();
					message('success', 'Evaluation Succesfully Updated', 2000); 
                },
                error: function(error) {
                    message('error', 'Something Went Wrong, Try  Again', 2000); 
                }
            });
    } 

    function previewEvaluation(id, lesson) {
        getRemarks(id);
        $('#lessonHolder').text(lesson);
        var table = $('#TableforEvalPreview').DataTable({
            ordering: false,
            responsive: true,
            retrieve: true,
			pageLength: 5,
			dom: '<"row"<"col-md-6"B><"col-md-6"f>>' + 
             '<"row"<"col-md-12"tr>>' + 
             '<"row"<"col-md-5"i><"col-md-7"p>>', 
                 buttons: [
                     {
                        extend: "pdfHtml5",
                        className: 'btn btn-danger',
						text: `PST Evaluation`,
                        title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        text: 'PDF',
                         init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-pdf buttons-html5')
                        }
                    },
                    {
                        extend: "copyHtml5",
                        className: 'btn btn-primary',
						text: `PST Evaluation`,
                        title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        text: 'Copy',
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-copy buttons-html5')
                        }
                    },
                    {
                        extend: "excelHtml5",
                        className: 'btn btn-success',
                        text: 'Excel',
						title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-excel buttons-html5')
                        }
                    },
                    {
                        extend: "csvHtml5",
                        className: 'btn btn-warning',
                        text: 'CSV',
						title: `PST Evaluation`,
                        exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                        },
                        init: function(api, node, config) {
                           $(node).removeClass('dt-button buttons-csv buttons-html5')
                        }
					}
				]
			});
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('TeacherController/FetchEvaluationTable'); ?>',
                data: {
                    ID: id
                },
                dataType: 'json',
                success: function(response) {
                    table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr >
                                    <td>${info.Variable}</td>
                                    <td>${info.Q1 ? info.Q1 : ''}</td>
                                    <td>${info.Q2 ? info.Q2 : ''}</td>
                                    <td>${info.Q3 ? info.Q3 : ''}</td>
                                    <td>${info.Q4 ? info.Q4 : ''}</td>
                                    <td>${info.Q5 ? info.Q5 : ''}</td>
                                    <td>${info.Total}</td>
                                </tr>
                                `);  
                        table.row.add(rowData);
                        });
                    table.draw();
                }              
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

    function getRemarks(id) {
        $.ajax({
                type: 'POST',
                url: '<?php echo site_url('StudentController/FetchEvaluationRemarks'); ?>',
                data: {
                    ID: id
                },
                dataType: 'json',
                success: function(response) {
                    $('#remarksHolder').val(response[0].Remarks === "" ? 'Currently there are no remarks for this lesson' : response[0].Remarks);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
    }    

    function formatDate(dateString) {
		const date = new Date(dateString);
		const options = { year: 'numeric', month: 'long', day: 'numeric' };
		return date.toLocaleDateString('en-US', options);
	}

    function message(icon,message,duration){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: duration,
            timerProgressBar: true
        })

        Toast.fire({
            icon: icon,
            title: message
        })
        return false;		
    }

</script>