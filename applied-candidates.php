<?php
include './header.php';
require "./check-session.php";
require './src/Database.php';
$db = database::getinstance();
$user = $_SESSION['user'];
$jobId = $_GET['jobId'];
$candidates = [];

$sql = "SELECT * FROM applied_jobs WHERE job_id = '$jobId'";
$res = $db->query($sql);
while ($row = $res->fetch_object()) {
	$sql = "SELECT * FROM users WHERE id = '$row->candidate_id'";
	$resUser = $db->query($sql);
	while ($rowUser = $resUser->fetch_object()) {
		$rowUser->status = $row->status; // Fetch status from applied_jobs table
		$rowUser->application_id = $row->id; // Get the applied_jobs ID
		$candidates[] = $rowUser;
	}
}
?>

<!-- content -->
<div class="page-content bg-white">
	<div class="section-full content-inner shop-account">
		<div class="container">
			<div class="row">
				<div class="col-md-12 m-b30">
					<h3>Applied Candidates</h3>
					<div class="tab-content border">
						<table class="table">
							<tr>
								<th>Name</th>
								<th>Resume</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php foreach ($candidates as $c): ?>
								<tr id="row_<?php echo $c->application_id; ?>">
									<td><strong><?php echo $c->name ?></strong></td>
									<td>
										<a class="btn btn-primary" href="./resume/<?php echo $c->resume ?>">View Resume</a>
									</td>
									<td id="status_<?php echo $c->application_id; ?>">
										<?php echo ucfirst($c->status); ?>
									</td>
									<td>
										<button class="btn btn-success"
											onclick="updateStatus(<?php echo $c->application_id; ?>, 'accepted')">Accept</button>
										<button class="btn btn-danger"
											onclick="updateStatus(<?php echo $c->application_id; ?>, 'rejected')">Reject</button>
									</td>
								</tr>
							<?php endforeach ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- content end-->
<?php include './footer.php' ?>

<script>
	function updateStatus(applicationId, status) {
		console.log(applicationId)
		if (confirm("Are you sure you want to " + status + " this candidate?")) {
			fetch('update_candidate_status.php', {
				method: 'POST',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				body: 'id=' + applicationId + '&status=' + status
			})
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						document.getElementById("status_" + applicationId).innerText = status.charAt(0).toUpperCase() + status.slice(1);
					} else {
						alert("Failed to update status.");
					}
				});
		}
	}
</script>