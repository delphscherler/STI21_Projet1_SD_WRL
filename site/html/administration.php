<?php
// TODO check user role
session_start();
//Control if user is logged in
if(!isset($_SESSION['uid'])){
   header("Location: index.php");
}

require_once __DIR__.'/helper.php';
require_once __DIR__.'/model/entities/user.php';
require_once __DIR__.'/action/change_password.php';

$users = (new User())->findAll();

require_once __DIR__.'/includes/header.php';
?>
<div class="col-md-6 well">
    <h1 class="text-primary">Administration</h1>
    <hr style="border-top:1px dotted #ccc;"/>
    <button class="btn btn-dark" onclick="document.location.href='inbox.php'">Back</button>
    <a href="add_user.php" class="btn btn-outline-primary">Add user</a>
    <hr style="border-top: 1px dotted #ccc;"/>

    <h3 class ="text-tertiary">Users</h3>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Username</th>
            <th>Validity</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $id => $user): ?>
            <tr>
                <td><?= $user->username ?></td>
                <td><?= $user->validity ?></td>
                <td><?= $user->role ?></td>
                <td>
                    <a href="modify_passwd.php?id=<?= $user->id ?>" class="btn btn-outline-info">Change password</a>
                    <a href="modify_user_role.php?id=<?= $user->id ?>" class="btn btn-outline-info">Change role</a>
                    <a href="modify_user_val.php?id=<?= $user->id ?>" class="btn btn-outline-info">Change validity</a>
                    <a href="delete_user.php?id=<?= $user->id ?>" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
require_once __DIR__.'/includes/footer.php';