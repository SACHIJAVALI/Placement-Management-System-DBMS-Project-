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
    $sql = "select * from applied_jobs where candidate_id = '$user->id'";
    $res = $db->query($sql);
    while ($row = $res->fetch_object()) {
        $query = "select * from jobs where id = '$row->job_id'";
        $resjob = $db->query($query);
        while ($rowjob = $resjob->fetch_object()) {
            $jobs[] = $rowjob;
        }
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
            <div class="container-fluid">
          
                <div class="row">
                    
                    <div class="col-xl-3 col-md-6 col-lg-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Total Posted Jobs</div>
                            <span style="margin-left:40px"><?php echo 1 ?></span><br>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="">View Details</a>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Total Applied Candidates</div>
                            <span style="margin-left:40px"><?php echo 1 ?></span><br>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="">View Details</a>
                              
                            </div>
                        </div>
                    </div>
                   


                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 m-b30">
                    <h3> My Posted Jobs</h3>

                    <div class="tab-content border">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Job Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($jobs)) : ?>
                                    <?php foreach ($jobs as $job) : ?>
                                        <tr>
                                            <td><strong><?php echo htmlspecialchars($job->title); ?></strong></td>
                                            <td>
                                                <?php if ($usertype == 'recruiter') : ?>
                                                    <a class="btn btn-primary btn-sm" href="./applied-candidates.php?jobId=<?php echo $job->id; ?>">View Candidates</a>
                                                    <a class="btn btn-danger btn-sm" href="<?php echo $_SERVER['PHP_SELF']; ?>?delete=<?php echo $job->id; ?>" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                                                <?php else : ?>
                                                    Status:<span style="color:red"> Pending</span> <a class="btn btn-primary btn-sm" href="./job-detail.php?id=<?php echo $job->id; ?>">View Job Details</a>
                                                <?php endif; ?>
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