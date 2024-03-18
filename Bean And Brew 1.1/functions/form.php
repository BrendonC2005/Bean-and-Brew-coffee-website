<?php
function form()
{
    echo '<form method="POST" style="margin-left: 5%; margin-right: 5%; margin-top: 2%; font-size: 2rem;">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label" style="color: #606C38;">Email address</label>
        <input type="email" name="email" required class="form-control" id="exampleInputEmail1">
        <span class="error">
            <?php echo $emailErr; ?>
        </span>
    </div>
    <br>
    <div class="mb-3">
        <label for="name" class="form-label" style="color: #606C38;">Name</label>
        <input type="text" name="name" required class="form-control" id="name">
        <span class="error">
            <?php echo $nameErr; ?>
        </span>
    </div>
    <br>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label" style="color: #606C38;">Password</label>
        <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" name="submit" class="btn btn-primary"
        style="background-color: #606C38; font-size: 2rem;">Confirm</button>
    <br><br>
</form>';
}
?>