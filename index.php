<?php
ini_set('display_errors', '1');
include './header.php';
require './src/Database.php';

$db = Database::getInstance();


if (isset($_POST['search'])) {
	$keywords = $db->real_escape_string($_POST['keyword']);
	$city = $db->real_escape_string($_POST['city']);
	$sector = $db->real_escape_string($_POST['sector']);

	$sql = "SELECT * FROM jobs WHERE title LIKE '%$keywords%' || sector = '$sector' || city = '$city'";
	$res = $db->query($sql);

	$jobs = [];

	while ($row = $res->fetch_object()) {
		$jobs[] = $row;
	}


	foreach ($jobs as $key => $job) {
		$sql = "SELECT name from city WHERE id = '$job->city'";
		$res = $db->query($sql);
		$city = $res->fetch_object()->name;

		$sql = "SELECT name FROM sector WHERE id = '$job->sector'";
		$res = $db->query($sql);
		$sector = $res->fetch_object()->name;

		$sql = "SELECT * from recruiter WHERE id = '$job->recruiter'";
		$res = $db->query($sql);
		$recruiter = $res->fetch_object();

		$jobs[$key]->city = $city;
		$jobs[$key]->sector = $sector;
		$jobs[$key]->recruiter = $recruiter;
	}
} else {
	$sql = "SELECT * FROM jobs ORDER BY id DESC LIMIT 0,10";
	$res = $db->query($sql);

	$jobs = [];

	while ($row = $res->fetch_object()) {
		$jobs[] = $row;
	}


	foreach ($jobs as $key => $job) {
		$sql = "SELECT name from city WHERE id = '$job->city'";
		$res = $db->query($sql);
		$city = $res->fetch_object()->name;

		$sql = "SELECT name FROM sector WHERE id = '$job->sector'";
		$res = $db->query($sql);
		$sector = $res->fetch_object()->name;

		$sql = "SELECT * from recruiter WHERE id = '$job->recruiter'";
		$res = $db->query($sql);
		$recruiter = $res->fetch_object();

		$jobs[$key]->city = $city;
		$jobs[$key]->sector = $sector;
		$jobs[$key]->recruiter = $recruiter;
	}
}


# Get all sectors
$sql = "SELECT id, name FROM sector";
$res = $db->query($sql);
$sectors = [];

while ($row = $res->fetch_object()) {
	$sectors[] = $row;
}

# Get all cities
$sql = "SELECT id, name FROM city";
$res = $db->query($sql);
$cities = [];

while ($row = $res->fetch_object()) {
	$cities[] = $row;
}



?>

<style>
	.job-card {
		transition: all 0.3s ease-in-out;
		border-radius: 10px;
		overflow: hidden;
		border: 1px solid rgba(0.5, 0.5, 0.5, 0.5);
	}

	.job-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
		border-color: rgba(0.5, 0.5, 0.5, 0.5);
	}

	.job-post-company img {
		transition: all 0.3s ease-in-out;
	}

	.job-card:hover .job-post-company img {
		transform: scale(1.1);
	}
</style>
<!-- Content -->
<div class="page-content">
	<!-- Section Banner -->
	<div class="dez-bnr-inr dez-bnr-inr-md" style="background-image:url(images/main-slider/slide1.jpg);">
		<div class="container">
			<div class="dez-bnr-inr-entry align-m ">
				<div class="find-job-bx">
					<p class="site-button button-sm">Find Jobs, Employment & Career Opportunities</p>

					<form class="dezPlaceAni" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
						<div class="row">

							<div class="col-lg-4 col-md-6">
								<div class="form-group">
									<label>Job Title, Keywords, or Phrase</label>
									<div class="input-group">
										<input type="text" name="keyword" class="form-control" placeholder="">
										<div class="input-group-append">
											<span class="input-group-text"><i class="fa fa-search"></i></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="form-group">
									<select name="city">
										<option>Select City</option>
										<?php foreach ($cities as $city) : ?>
											<option value="<?php echo $city->id ?>"> <?php echo $city->name ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="form-group">
									<select name="sector">
										<option>Select Sector</option>
										<?php foreach ($sectors as $sector) : ?>
											<option value="<?php echo $sector->id ?>"> <?php echo $sector->name ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="col-lg-2 col-md-6">
								<button type="submit" name="search" class="site-button btn-block">Find Job</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Section Banner END -->
	<!-- Our Job -->
	<div class="section-full bg-white content-inner-2">
		<div class="container">
			<div class="d-flex job-title-bx section-head">
				<div class="mr-auto">
					<h2 class="m-b5">Recent Jobs</h2>
				</div>
				<div class="align-self-end">
					<a href="./browse-job.php" class="site-button button-sm">Browse All Jobs <i class="fa fa-long-arrow-right"></i></a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9">
					<ul class="list-unstyled">
						<?php foreach ($jobs as $job) : ?>
							<li class="mb-4">
								<a href="./job-detail.php?id=<?php echo $job->id ?>" class="text-decoration-none text-dark">
									<div class="card job-card border-0 shadow-sm">
										<div class="card-body" style="border:1px solid rgba(0, 0, 0, 0.1)">
											<div class="d-flex align-items-center">
												<!-- Company Logo -->
												<div class="job-post-company me-3">
													<img src="images/logo/icon1.png" class="rounded-circle border p-1 bg-light shadow-sm" width="60" height="60" alt="Company Logo">
												</div>
												<div class="job-post-info flex-grow-1">
													<h5 class="mb-1 fw-bold"><?php echo htmlspecialchars($job->title) ?></h5>
													<ul class="list-inline text-muted small mb-2">
														<li class="list-inline-item">
															<i class="fa fa-map-marker text-danger"></i> <?php echo htmlspecialchars($job->city) ?>
														</li>
														<li class="list-inline-item">
															<i class="fa fa-bookmark text-primary"></i> <?php echo htmlspecialchars($job->type) ?>
														</li>
														<li class="list-inline-item">
															<i class="fa fa-clock-o text-success"></i>
															<?php
															$d = new DateTime($job->created_at);
															echo $d->format('d-m-Y');
															?>
														</li>
													</ul>
												</div>
											</div>

											<div class="d-flex justify-content-between align-items-center mt-3">
												<span class="badge bg-primary text-white py-2 px-3"><?php echo htmlspecialchars($job->type) ?></span>
												<span class="text-success fw-bold fs-5">
													Rs-<?php echo number_format($job->ctc, 2, '.', ',') ?>/-
												</span>
											</div>
										</div>
									</div>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>

			<div class="col-lg-3">
				<div class="sticky-top">


				</div>
			</div>
		</div>
	</div>
</div>
<!-- Our Job END -->

<?php include './footer.php' ?>