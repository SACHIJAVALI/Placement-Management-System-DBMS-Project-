<?php
include './header.php';

require_once '../src/Database.php';

$db = Database::getInstance();

# Delete operation
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "SELECT * from users WHERE id = '$id'";
    $res = $db->query($sql);

    if ($res->num_rows < 1) {
        header('Location:' . $_SERVER['PHP_SELF']);
        exit();
    }

    $sql = "DELETE FROM users WHERE id = '$id'";
    if ($db->query($sql) === true) {
        $msg = "Users data deleted";
    } else {
        $error = "Can not delete Users data";
    }
}


$sql = "SELECT u.name, u.email, r.name AS recruiter_name
FROM applied_jobs aj
JOIN users u ON aj.candidate_id = u.id
JOIN jobs j ON aj.job_id = j.id
JOIN recruiter r ON j.recruiter = r.id
WHERE aj.status = 'accepted';";

//echo $sql;die;

$res = $db->query($sql);
$details = [];
while ($row = $res->fetch_object()) {
    $details[] = $row;
}

//print_r($details);die;

?>

<div class="container-fluid">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="">Dashboard</a> / Selected Students</li>
    </ol>
   

 <?php if (isset($msg)) : ?>
        <div class="alert alert-success">
            <strong><i class="fa fa-check">Success! </i></strong> <?php echo htmlspecialchars($msg) ?>
        </div>
    <?php endif ?>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger">Failed! </i></strong> <?php echo htmlspecialchars($error) ?>
        </div>
    <?php endif ?>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Selected Students Table</div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-bordered table-sm text-center dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          
                           
                            <th >Sl no</th>
                            <th width="20%">Student Name</th>
                             <th width="20%">Email</th>
                             <th width="20%">Recruiter</th>
                            <th width="35%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                      <?php $i=0; foreach ($details as $d): ?>
                        <tr>
                       
                             <td><?php echo $i+1 ?></td>
                            <td><?php echo $d->name ?></td>
                            <td><?php echo $d->email ?></td>
                            <td><?php echo $d->recruiter_name ?></td>
                            <td>
                               <!-- <a href="./view-user.php?view=<?php echo $d->id ?>"
                                    class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>-->
                                <a href=""
                                    class="btn btn-success btn-sm"><i class="fa fa-check"></i>Hired</a>
                            </td>
                        </tr>
                      <?php $i++; endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->


<?php
include './footer.php';
?>