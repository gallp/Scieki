<?php

class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>"

<div class="input-box">
    <label for="password">Hasło</label>
    <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
    <span class="invalid-feedback"><?php echo $password_err; ?></span>
</div>