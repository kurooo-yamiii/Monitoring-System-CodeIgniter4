<!-- Add & Update Final Demo Modal -->
<div class="modal fade" id="FinalDemoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"  style="max-width: 90%; max-height: 90%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
							<div class="logos">
								<div class="logo-right">
									<img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
								</div>
								<div>Create New <span id="lessonHolder" style="margin-left: 5px; color: rgba(100, 50, 30); font-weight: 700;"> Final Demo Evaluation</span></div>
							</div>	
						</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="ClearAllField()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body" style="display: flex; flex-direction: row;">
                <div class="frame-lesson-plan">
                    <iframe  src="<?= base_url('assets/lesson/1/LessonPlan-672f64bfd58310.97362496.pdf') ?>" 
                    class="iframe-lesson-plan" 
                    frameborder="0">></iframe>
                </div>
        <div class="answer-sheet">
                <input type="text" name="EvalID" id="EvalID" hidden>
            <div class="modal-navigation">
                <button class="nav-button" type="button" onclick="showSection('firstSet', this)">Domain I</button>
                <button class="nav-button" type="button" onclick="showSection('secondSet', this)">Domain II</button>
                <button class="nav-button" type="button" onclick="showSection('thirdSet', this)">Domain III</button>
                <button class="nav-button" type="button" onclick="showSection('fourthSet', this)">Domain IV</button>
                <button class="nav-button" type="button" onclick="showSection('fifthSet', this)">Domain V</button>
                <button class="nav-button" type="button" onclick="showSection('sixthSet', this)">Remarks VI</button>
            </div>
                <div class="space"></div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="pst">PRACTICE TEACHER’S NAME:</label>
                        <input type="text" class="form-control" id="pst" name="pst" required>
                    </div>
                    <div class="col-md-5">
                        <label for="subject">SUBJECT & GRADE LEVEL TAUGHT:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="col-md-2">
                        <label for="date">DATE:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-5">
                        <label for="observer">OBSERVER:</label>
                        <input type="text" class="form-control" id="observer" name="observer" required>
                    </div>
                    <div class="col-md-5">
                        <label for="subject">COOPERATING SCHOOL:</label>
                        <input type="text" class="form-control" id="cooperating" name="cooperating" required>
                    </div>
                    <div class="col-md-2">
                        <label for="quarter">QUARTER:</label>
                        <input type="text" class="form-control" id="quarter" name="quarter" required>
                    </div>
                </div>
                <div class="form-group-eval-form2 set-group" id="firstSet" style="display: none;">
                    <table class="custom-table-form2">
                        <p class="eval-title">I. Content Knowledge and Pedagogy</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1. The teacher states clear and accurate information that is both current, relevant,
                            integrative, and research-based to show mastery of content.</th>
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
                            <th class="custom-table-row-form2">2. The teacher demonstrates educational technology principles to facilitate teaching
                            and learning process.</th>
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
                            <th class="custom-table-row-form2">3. The teacher asks probing questions that help students to solve problems and think
                            critically.</th>
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
                            <th class="custom-table-row-form2">4. The teacher speaks fluently and audibly with varied pitch, volume, tone and speed of
                            voice.</th>
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
                            <th class="custom-table-row-form2">5. The teacher conducts proper pacing of the lesson with smooth transition between
                            activities.</th>
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
                        <p class="eval-title">II. Learning Environment</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1. The teacher encourages active student engagement with lessons through
                            meaningful discussion.</th>
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
                            <th class="custom-table-row-form2">2. The teacher is neat, well-groomed, and free from distracting mannerism.</th>
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
                            <th class="custom-table-row-form2">3. PThe teacher manifests dynamism and enthusiasm in interacting with students in both
                            modalities.</th>
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
                            <th class="custom-table-row-form2">4. The teacher has a systematic way of conducting classes from beginning to end.</th>
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
                            <th class="custom-table-row-form2">5. The teacher promotes a safe environment for self-reflecting and sharing insights.</th>
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
                        <p class="eval-title">III. Diversity of Learners</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1.The teacher adapts varied strategies that are responsive to individual student
                            differences in both modalities.</th>
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
                            <th class="custom-table-row-form2">2. The teacher connects subject matter with students’ prior knowledge, experiences,
                            and interests.</th>
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
                            <th class="custom-table-row-form2">3. The teacher utilizes resources that suit to learners’ backgrounds.</th>
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
                            <th class="custom-table-row-form2">4. The teacher responds to students' difficulties with compassion and understanding.</th>
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
                            <th class="custom-table-row-form2">5. The teacher checks on students’ wellbeing.</th>
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
                        <p class="eval-title">IV Curriculum and Planning</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1. The teacher organizes the lesson in a meaningful, structured, and sequenced
                            manner.</th>
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
                            <th class="custom-table-row-form2">2. The teacher articulates appropriate learning objectives with relevant learning
                            activities in both learning modalities</th>
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
                            <th class="custom-table-row-form2">3. The teacher coordinates with cooperating teacher in the development of the lesson
                            plan.</th>
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
                            <th class="custom-table-row-form2">4.The teacher inculcates values in instruction and learning activities of students in both
                            modalities.</th>
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
                            <th class="custom-table-row-form2">5. The teacher makes effective use of resources, including ICT, to illustrate lesson.</th>
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
                <div class="form-group-eval-form2 set-group" id="fifthSet" style="display:none;">
                    <table class="custom-table-form2">
                        <p class="eval-title">V. Assessment and Reporting</p>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">1. The teacher is clear in giving directions and on explaining what is expected on
                            learning activities and assessments.</th>
                            <td class="custom-table-column-form2">
                                <select id="e1" name="e1" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">2. The teacher helps students to ask questions.</th>
                            <td class="custom-table-column-form2">
                                <select id="e2" name="e2" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">3. The teacher answers questions with in-depth and accurate explanation.</th>
                            <td class="custom-table-column-form2">
                                <select id="e3" name="e3" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">4.The teacher provides timely, accurate, and constructive feedback to students'
                            achievements and effort.</th>
                            <td class="custom-table-column-form2">
                                <select id="e4" name="e4" class="custom-select" required>
                                    <option value="1">Not Observed</option>
                                    <option value="2">Unsatisfactory</option>
                                    <option value="3">Needs Improvement</option>
                                    <option value="4">Satisfactory</option>
                                    <option value="5">Very Satisfactory</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="custom-tr-form2">
                            <th class="custom-table-row-form2">5. The teacher designs assessment tools that are aligned with the learning objectives.</th>
                            <td class="custom-table-column-form2">
                                <select id="e5" name="e5" class="custom-select" required>
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
                <div id="sixthSet" class="set-group" style="display:none;">
                    <p class="prof-title">Strengths of the Student Teacher</p> 
                    <textarea class="form-control" id="strenght" style="margin-left: 5px; font-weight: 700;" rows="3"></textarea>
                    <p class="prof-title">Areas for Improvement</p> 
                    <textarea class="form-control" id="improvement" style="margin-left: 5px; font-weight: 700;" rows="3"></textarea>
                </div>
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