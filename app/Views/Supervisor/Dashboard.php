<form id="dashboard">
      <div class="dashboard">
       <p class="announce-para">Dashboard - Welcome Back Supervisor <span>  <?php echo $_SESSION['Name']?> !!!</span></p>

        <div class="logos">
            <div class="logo">
                <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="<?=base_url('assets/img/ced.jpg')?>" alt="Logo 2" width="50">
            </div>
        </div>
     </div>
    
    <div class="divider"></div>

    <div class="card-container">
        <div class="card3">
            <div class="chart-container">
                <div class="bar" id="chart">
                <!-- Print my Student TeacherBar Graph -->
                </div>
            </div>
            <div class="row-total">
                <p class="total-row-space">RTU PST: 
                <span id="firstOverall" style="margin-left: 5px; color: navy; font-weight: 700;"></span></p>
            </div>
        </div>

        <div class="card">
            <div class="chart-container">
                <div class="bar" id="chart3">
                <!-- Print Pasig Teacher Graph Bar Graph (2) -->
                </div>
            </div>
            <div class="row-total">
                <p class="total-row-space">RTU Pasig Coop-Teacher: 
                <span id="secondOverall" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></p>
            </div>
        </div>

        <div class="card">
            <div class="chart-container">
                <div class="bar" id="chart2">
                    <!-- Print Mandaluyong Teacher Bar Graph Bar Graph (3) -->
                </div>
            </div>
            <div class="row-total">
                <p class="total-row-space">RTU Mandaluyong Coop-Teacher: 
                <span id="thirdOverall" style="margin-left: 5px; color: navy; font-weight: 700;"> </span></p>
            </div>
        </div>
        <!-- Creation of Pie Chart -->
        <div class="card2">
            <div class="piehcart-justify">
                <canvas id="myPieChart" width="400" height="400"></canvas> <!-- Pie Chart  -->
            </div>
        </div>
    </div>

<script>
     var table;
   $(document).ready(function() {
            getProgram();
            getManda();
            getPasig();
            standByDeploy();
            table = $('#getFetchRecent').DataTable({
                ordering: false,
                responsive: true,
                retrieve: false,
                paging: false, 
                dom: 'lrt',
            });
            fetchRecentDep();
        })

        function getProgram() { // First Chart Fetch
            $.ajax({
            type: 'GET', 
            url: '<?= site_url('SupervisorController/Program') ?>', 
            dataType: 'json',
            success: function(response) {
                const overallCount = Object.values(response).reduce((acc, curr) => {
                    return acc + Number(curr); // Convert current value to a number
                }, 0);
                $('#firstOverall').text(overallCount);
            createVerticalBars('chart', response);
            },
            error: function(error) {
              console.log(error);
            }
            });
        }

        function getManda() { // Second Chart Fetch
            $.ajax({
            type: 'GET', 
            url: '<?= site_url('SupervisorController/SchoolManda') ?>', 
            dataType: 'json',
            success: function(response) {
                const overallCount = Object.values(response).reduce((acc, curr) => {
                    return acc + Number(curr); // Convert current value to a number
                }, 0);
                $('#secondOverall').text(overallCount);
            createVerticalBars('chart2', response);
            },
            error: function(error) {
              console.log(error);
            }
            });
        }
        
        function getPasig() { // Third Chart Fetch
            $.ajax({
            type: 'GET', 
            url: '<?= site_url('SupervisorController/SchoolPasig') ?>', 
            dataType: 'json',
            success: function(response) {
                const overallCount = Object.values(response).reduce((acc, curr) => {
                    return acc + Number(curr); // Convert current value to a number
                }, 0);
                $('#thirdOverall').text(overallCount);
            createVerticalBars('chart3', response);
            },
            error: function(error) {
              console.log(error);
            }
            });
        }

        function standByDeploy() { // PieChart Fetch
            $.ajax({
            type: 'GET', 
            url: '<?= site_url('SupervisorController/DeployStandBy') ?>', 
            dataType: 'json',
            success: function(response) {           
                const deployValue = parseInt(response.Deploy); 
                const standbyValue = parseInt(response.StandBy); 
                const datas = [deployValue, standbyValue];
                const labels = ['DP: ' + deployValue, 'SB: ' + standbyValue];
                const colors = ['#FFD700', '#000080'];
                pieChart(datas, labels, colors);
            },
            error: function(error) {
              console.log(error);
            }
            });
        }

    function createVerticalBars(chartId, data) {
        const chart = document.getElementById(chartId);
        const minBarHeight = 20;
        const maxValue = Math.max(...Object.values(data));
        for (const category in data) {
            const barContainer = document.createElement('div');
            barContainer.classList.add('bar-container');

            const bar = document.createElement('div');
            bar.classList.add('bar');

            // Calculate the scaling factor based on the maximum value
            const scaleFactor = maxValue > 0 ? (data[category] / maxValue) : 0;
            
            // Calculate the scaled bar height ensuring it's not below the minimum
            const scaledBarHeight = Math.max(scaleFactor * 100, minBarHeight);
            bar.style.height = `${scaledBarHeight}px`;

            const label = document.createElement('div');
            label.classList.add('label');
            label.textContent = data[category];

            const categoryLabel = document.createElement('div');
            categoryLabel.classList.add('category-label');
            categoryLabel.textContent = category;

            barContainer.appendChild(label);
            barContainer.appendChild(bar);
            barContainer.appendChild(categoryLabel);
            chart.appendChild(barContainer);
        }
    }

    function pieChart(datas, labels, colors) 
    { 
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: datas,
                    backgroundColor: colors,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'black',
                            weight: 600
                        }
                    }
                }
            }
        });}
       
        function fetchRecentDep() { // Table Fetch
            $.ajax({
            type: 'GET', 
            url: '<?= site_url('SupervisorController/RecentDeploy') ?>', 
            dataType: 'json',
            success: function(response) {    
                table.clear().draw();
                    const res = response.data;
                        if (res.length > 0) {
                            res.forEach(function(info) {
                                var rowData = $(`<tr id="trid${info.ID}">
                                <td>${info.Name}</td>
                                <td>${info.Program}</td>
                                <td>${info.Section}</td>
                                <td>${info.Resource}</td>
                                <td>${info.Supervisor}</td>
                                </tr>
                                `);  
                        table.row.add(rowData);
                        });
                    table.draw();
                }
            },
            error: function(error) {
              console.log(error);
            }
            });
        }
   
 </script>

    <div class="eval-studd">
        <h3>Recent Deployed PST</h3>
			<table class="table table-striped" id="getFetchRecent">
			  <thead>
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Program</th>
				  <th scope="col">Section</th>
				  <th scope="col">Resurce Teacher</th>
				  <th scope="col">Supervisor</th>
			    </tr>
			  </thead>
			  <tbody>
			  </tbody>
            </table>
    </div>
	
</form>
