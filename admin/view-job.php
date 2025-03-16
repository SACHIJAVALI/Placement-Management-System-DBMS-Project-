<?php
include './header.php';


require_once '../src/Database.php';
$db = Database::getInstance();



$id = $db->real_escape_string($_GET['view']);

$sql = "SELECT * FROM jobs WHERE id = '$id'";

$res = $db->query($sql);
$data = $res->fetch_object();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Process the form submission
    if (isset($_POST['status'])) {

        $job_id = $_POST["job_id"];

        $job_status = $_POST["status"];


        $sql = " UPDATE jobs SET status = '$job_status' WHERE id = '$job_id'";
        //echo $sql;die;
        if ($db->query($sql) === true) {
            echo "<script>alert('Job verified successfully'); window.location.href = './jobs-index.php';</script>";
        } else {
            echo "<script>alert('Unable to verify');</script>";
        }

    }
}

?>
<div class="container-fluid">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="">Dashboard</a> / Job Details</li>
    </ol>
    <div class="card">
        <div class="card-header">
            Job details
        </div>
        <div class="card-body">
            <table class="table tabled-bordered">
                <tr>
                    <td><strong>Title: </strong><?php echo htmlspecialchars($data->title) ?></td>
                    <?php
                    $sql = "SELECT name FROM sector WHERE id = '$data->sector'";
                    $res = $db->query($sql);
                    $row = $res->fetch_array();

                    ?>
                    <td width="20%"><strong>Sector: </strong><?php echo $row['name'] ?></td>
                    <td width="20%"><strong>Type: </strong><?php echo htmlspecialchars($data->type) ?></td>

                </tr>
                <tr>
                    <?php
                    $sql = "SELECT name FROM city WHERE id = '$data->city'";
                    $res = $db->query($sql);
                    $row = $res->fetch_array();

                    ?>
                    <td><strong>City.: </strong><?php echo $row['name'] ?></td>
                    <?php
                    $sql = "SELECT name FROM recruiter WHERE id = '$data->recruiter'";
                    $res = $db->query($sql);
                    $row = $res->fetch_array();

                    ?>

                    <td><strong>Recruiter: </strong><?php echo $row['name'] ?></td>
                    <td width="20%"><strong>CTC: </strong><?php echo htmlspecialchars($data->ctc) ?></td>

                </tr>

                <tr>
                    <td width="20%"><strong>Deadline: </strong><?php echo htmlspecialchars($data->deadline) ?></td>
                    <td width="20%"><strong>Qualification: </strong><?php echo htmlspecialchars($data->qualification) ?>
                    </td>
                    <td><strong>Experiance: </strong><?php echo htmlspecialchars($data->exp) ?></td>
                </tr>
                <tr>

                    <td width="20%"><strong>How to apply: </strong><?php echo htmlspecialchars($data->how_to_apply) ?>
                    </td>
                    <td width="20%"><strong>Requirement: </strong><?php echo htmlspecialchars($data->requirement) ?>
                    </td>
                    <td><strong>Description: </strong><?php echo htmlspecialchars($data->description) ?></td>
                </tr>
                <tr>
                    <td style="padding-top:10px"><strong>Attachment :</strong></td>
                    <td><a href="../upload/age-proof/<?php echo $data->image ?>" target="blank">view </td>

                </tr>
                <td><strong>Job Status:</strong></td>
                    <?php $data->status == 'Pending' ? $labelColor = 'info' : $labelColor = 'success' ?>
                    <td><span class="badge badge-<?php echo $labelColor ?>"><?php echo $data->status ?></span>
                    </td>
            </table>
        </div>

        <div class="card m-5">
            <div class="card-body">
                <form method="POST" action="./view-job.php">
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <h6>Status</h6>
                        </div>
                    </div>
                    <input type="hidden" name="job_id" value="<?php echo $id ?>">
                    <div class="form-row">
                        <div class="form-group col-lg-8">
                            <select class="form-control" name="status">
                                <option value="Pending" <?php if ($data->status === 'Pending')
                                    echo 'selected'; ?>>
                                    Pending</option>
                                <option value="Verified" <?php if ($data->status === 'Verified')
                                    echo 'selected'; ?>>Verified
                                </option>
                                <option value="Rejected" <?php if ($data->status === 'Rejected')
                                    echo 'selected'; ?>>Rejected</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-4">
                            <button type="submit" class="btn btn-primary ">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include './footer.php';
?>