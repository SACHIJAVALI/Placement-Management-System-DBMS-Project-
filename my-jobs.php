<?php
include './header.php';
require "./check-session.php";
require './src/Database.php';
$db = database::getinstance();
$user = $_SESSION['user'];

$jobs = [];
$usertype =  $_SESSION['type'];
if ($usertype == 'recruiter') {
    $sql = "select * from jobs where recruiter = '$user->id'";
    $res = $db->query($sql);
    while ($row = $res->fetch_object()) {
        $jobs[] = $row;
    }
} else {
    /*$sql = "select * from applied_jobs where candidate_id = '$user->id'";
    //echo $sql;die;
    $res = $db->query($sql);
    while ($row = $res->fetch_object()) {
        $query = "select * from jobs where id = '$row->job_id'";
        $resjob = $db->query($query);
        while ($rowjob = $resjob->fetch_object()) {
            $jobs[] = $rowjob;
        }
    }*/

    $sql = "SELECT j.*, aj.status 
        FROM applied_jobs aj 
        INNER JOIN jobs j ON aj.job_id = j.id 
        WHERE aj.candidate_id = '$user->id'";

    $res = $db->query($sql);
    $jobs = [];

    while ($row = $res->fetch_object()) {
        $jobs[] = $row; // Now $row contains job details + status from applied_jobs
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "delete from jobs where id = '$id'";
    $db->query($sql);
}

?>
<!-- content -->
<div class="page-content bg-white">
    <!-- contact area -->
    <div class="section-full content-inner shop-account">
        <!-- product -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-b30">
                    <h3>My Applied Jobs</h3>
                    <div class="tab-content border">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Job Title</th>
                                    <th>Applied On</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($jobs)) : ?>
                                    <?php foreach ($jobs as $job) : ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($job->title); ?></strong></td>
                                            <td><strong><?php $apply_date = date("Y-m-d", strtotime($job->created_at));
                                                        echo $apply_date;
                                                        ?></strong></td>
                                            <td><strong><?php echo htmlspecialchars($job->status); ?></strong></td>
                                            <td>

                                                <a class="btn btn-primary btn-sm" href="./job-detail.php?id=<?php echo $job->id; ?>">View Job Details</a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="2" class="text-center">No jobs applied yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- product end -->
            </div>
            <!-- contact area end -->
        </div>
    </div>
</div>

<!-- content end-->
<?php include './footer.php' ?>