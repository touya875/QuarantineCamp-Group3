<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("check.php");
?>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div class="sk-three-bounce">
			<div class="sk-child sk-bounce1"></div>
			<div class="sk-child sk-bounce2"></div>
			<div class="sk-child sk-bounce3"></div>
		</div>
	</div>
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		<!--**********************************
            Nav header start
        ***********************************-->
		<?php

		include("includes/navhead.php");

		?>
		<!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Chat box start
        ***********************************-->

		<!--**********************************
            Chat box End
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
		<?php

		include("includes/main.php");

		?>
		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<?php

		include("includes/sidebar.php");

		?>
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-sm-4 mb-3">
					<div class="mr-auto">
						<h2 class="text-black font-w600">Testing</h2>
						<p class="mb-0">Test Covid</p>
					</div>
					<div>
						<a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+New Testing</a>
						<!-- <a href="index.html" class="btn btn-outline-primary"><i class="las la-calendar-plus scale5 mr-3"></i>Filter Date</a> -->
					</div>
				</div>
				<!-- Add Order -->
				<div class="modal fade" id="addOrderModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Testing</h5>
								<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="add_test.php" method="get">
									<!-- <div class="form-group">
										<label class="text-black font-w500">Test ID</label>
										<input type="number" class="form-control">
									</div> -->
									<div class="form-group">
										<label class="text-black font-w500">Patient ID</label>
										<input type="number" name="patient_id" class="form-control">
									</div>

									<div class="form-group">
										<label class="text-black font-w500">Employee ID</label>
										<?php
										$sql_employee = "SELECT * FROM `people_in_camp` ";
										$result_em = mysqli_query($conn, $sql_employee);
										if (mysqli_num_rows($result_em) > 0) {
											// output data of each row
										?>
											<select name="people_id" class="form-control">
												<option value="">select</option>
												<?php
												while ($row_em = mysqli_fetch_assoc($result_em)) {
												?>
													<option value="<?php echo $row_em['people_in_camp_id'] ?>"><?php
																												switch ($row_em["people_in_camp_job_type"]) {
																													case 'Doctor':
																														echo "#D-" . $row_em["people_in_camp_id"] . " " . $row_em["people_in_camp_fname"] . " " . $row_em["people_in_camp_lname"];
																														break;
																													case 'Nurse':
																														echo "#N-" . $row_em["people_in_camp_id"] . " " . $row_em["people_in_camp_fname"] . " " . $row_em["people_in_camp_lname"];
																														break;
																													case 'Staff':
																														echo "#S-" . $row_em["people_in_camp_id"] . " " . $row_em["people_in_camp_fname"] . " " . $row_em["people_in_camp_lname"];
																														break;
																													case 'Volunteer':
																														echo "#V-" . $row_em["people_in_camp_id"] . " " . $row_em["people_in_camp_fname"] . " " . $row_em["people_in_camp_lname"];
																														break;
																													case 'Manager':
																														echo "#M-" . $row_em["people_in_camp_id"] . " " . $row_em["people_in_camp_fname"] . " " . $row_em["people_in_camp_lname"];
																														break;
																												} ?></option>
											<?php
												}
											}
											?>
											</select>
											<!-- <input type="number" name="people_id" class="form-control"> -->
									</div>

									<div class="form-group">
										<label class="text-black font-w500">Test Date</label>
										<input type="datetime-local" name="date" class="form-control">
									</div>
									<!-- <div class="form-group">
										<label class="text-black font-w500">Status</label>
										<input type="text" class="form-control">
									</div> -->
									<div class="form-group">
										<label class="text-black font-w500">Testing type</label>
										<select class="d-block w-100 default-select" id="gender" name="testing_type" required="">
											<option value="">Choose...</option>
											<option value="pcr">PCR Test</option>
											<option value="quick">Quick Test</option>
										</select>
									</div>
									<div class="form-group">
										<label class="text-black font-w500">Result</label>
										<select class="d-block w-100 default-select" name="result" id="gender" required="">
											<option value="">Choose...</option>
											<option>Positive</option>
											<option>Negative</option>
										</select>
									</div>
									<div class="form-group">
										<label class="text-black font-w500">SP02</label>
										<input type="number" class="form-control" name="spo2" placeholder="%">
									</div>
									<div class="form-group">
										<label class="text-black font-w500">Respiratory Rate</label>
										<input type="number" class="form-control" name="respiratory_rate" placeholder="bpm">
									</div>
									<div class="form-group">
										<!-- <input type="submit" class="btn btn-primary" name = "addtest" value = "create"> -->
										<button type="submit" class="btn btn-primary" name="add_test">CREATE</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="table-responsive card-table">
							<table id="example5" class="display dataTablesCard table-responsive-xl">
								<thead>
									<tr>
										<th>
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="checkAll" required="">
												<label class="custom-control-label" for="checkAll"></label>
											</div>
										</th>
										<th>Test ID</th>
										<th>Patient ID</th>
										<th>People ID</th>
										<th>Test Date</th>
										<th>Status</th>
										<th>PCR Test</th>
										<th>Quick Test</th>
										<th>SP02</th>
										<th>Respiratory rate</th>
										<th></th>
									</tr>
								</thead>
								<?php
								if (!isset($_GET['people_id'])) {
									$sql = "SELECT * FROM `test` 
												INNER JOIN `test_covid` ON test.test_id = test_covid.test_id 
												INNER JOIN `people_in_camp` ON test.employee_id = people_in_camp.people_in_camp_id 
												INNER JOIN `patient` ON test.patient_id = patient.patient_id;";
								} else {
									$sql = "SELECT * FROM `test` 
												INNER JOIN `test_covid` ON test.test_id = test_covid.test_id 
												INNER JOIN `people_in_camp` ON test.employee_id = people_in_camp.people_in_camp_id 
												INNER JOIN `patient` ON test.patient_id = patient.patient_id
												WHERE test.patient_id = " . $_GET['people_id'] . ";";
								}
								$result = mysqli_query($conn, $sql);
								if (mysqli_num_rows($result) > 0) {
									// output data of each row
									while ($row = mysqli_fetch_assoc($result)) {
								?>
										<tbody>
											<tr>
												<td>
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="customCheckBox3" required="">
														<label class="custom-control-label" for="customCheckBox3"></label>
													</div>
												</td>
												<!-- <td>
											<img src="images/users/12.png" alt="" width="43">
										</td> -->
												<td><span class="text-nowrap">#T-<?php echo $row['test_id']; ?></span></td>
												<td><span class="text-nowrap">#P-<?php echo $row['patient_id'] . " " . $row["fname"] . " " . $row["lname"]; ?></span></td>
												<td><span class="text-nowrap"><?php switch ($row["people_in_camp_job_type"]) {
																					case 'Doctor':
																						echo "#D-" . $row["people_in_camp_id"] . " " . $row["people_in_camp_fname"] . " " . $row["people_in_camp_lname"];
																						break;
																					case 'Nurse':
																						echo "#N-" . $row["people_in_camp_id"] . " " . $row["people_in_camp_fname"] . " " . $row["people_in_camp_lname"];
																						break;
																					case 'Staff':
																						echo "#S-" . $row["people_in_camp_id"] . " " . $row["people_in_camp_fname"] . " " . $row["people_in_camp_lname"];
																						break;
																					case 'Volunteer':
																						echo "#V-" . $row["people_in_camp_id"] . " " . $row["people_in_camp_fname"] . " " . $row["people_in_camp_lname"];
																						break;
																				} ?></span></td>
												<td><?php echo $row['date_test']; ?></td>
												<!-- <td>
											<a href="javascript:void(0)" class="btn btn-primary text-nowrap btn-sm light">2 Appointment</a>
										</td> -->
												<!-- <td><span class="text-nowrap">+12 4124 5125</span></td> -->
												<?php switch ($row['result']) {
													case 'Positive':
												?>
														<td><span class="badge light badge-danger"><?php echo $row['result']; ?></span></td>
													<?php
														break;

													case 'Negative':
													?>
														<td><span class="badge light badge-success"><?php echo $row['result']; ?></span></td>
												<?php
														break;

													default:
														echo "no results";
														break;
												} ?>
												<td><span class="text-dark"><?php echo $row['pcr']; ?></span></td>
												<td><span class="text-dark"><?php echo $row['quick_test']; ?></span></td>
												<td><span class="text-dark"><?php echo $row['spo2']; ?>%</span></td>
												<td><span class="text-dark"><?php echo $row['respiratory_rate']; ?> bpm</span></td>
												<td>
													<div class="dropdown ml-auto text-right">
														<div class="btn-link" data-toggle="dropdown">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
																<path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
																<path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
															</svg>
														</div>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">View Detail</a>
															<a class="dropdown-item" href="#">Edit</a>
															<a class="dropdown-item" href="#">Delete</a>
														</div>
													</div>
												</td>
											</tr>
									<?php
									}
								} else {
									echo "0 result";
								}
									?>
										</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--**********************************
            Content body end
        ***********************************-->

		<!--**********************************
            Footer start
        ***********************************-->
		<?php

		include("includes/footer.php");

		?>
		<!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

		<!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
	<!--**********************************
        Main wrapper end
    ***********************************-->

	<!--**********************************
        Scripts
    ***********************************-->
	<!-- Required vendors -->
	<script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="./vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="./js/custom.min.js"></script>
	<script src="./js/deznav-init.js"></script>

	<!-- Datatable -->
	<script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script>
		(function($) {
			var table = $('#example5').DataTable({
				searching: false,
				paging: false,
				select: false,
				//info: false,         
				lengthChange: false

			});
			$('#example tbody').on('click', 'tr', function() {
				var data = table.row(this).data();

			});
		})(jQuery);
	</script>
</body>

</html>