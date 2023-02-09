<?php


?>
<link rel="stylesheet" href="/CommuSupport/public/CSS/button/button-styles.css">
<link rel="stylesheet" href="/CommuSupport/public/CSS/login/forget-password.css">
<div class="background">
    <div class="grid-background">

        <div id="usernameDiv" class="form-group">
            <h3>Forgot Password?</h3>
            <p>Enter your username to find if an account exists. Then we will send and OTP to the phone number
                registered to that account.</p>
            <label for="username" class="form-label">Username:</label>
            <input id="username" type="text" size="40" class="basic-input-field">
            <span id="usernameError" class="error"></span>
            <div class="forget-btns">
                <button id="usernameSubmit" class="btn-primary">Find Account</button>
            </div>
        </div>

        <div id="otpDiv" class="form-group" style="display: none">
            <label for="otp" class="form-label">Enter your otp:</label>
            <input id="otp" type="password" size="40" class="basic-input-field">
            <span id="otpError" class="error"></span>
            <span id="otpCountDown" class="success"></span>
            <button id="otpSubmit" class="btn-primary" style="display: none">Submit</button>
            <button id="otpRequest" class="btn-primary">Request OTP Again</button>
        </div>

        <div id="newPasswordDiv" class="form-group" style="display: none">
            <label for="newPassword" class="form-label">Enter your new password:</label>
            <input id="newPassword" type="password" size="40" class="basic-input-field">
            <span id="newPasswordError" class="error"></span>

            <label for="confirmPassword" class="form-label">Confirm your new password:</label>
            <input id="confirmPassword" type="password" size="40" class="basic-input-field">
            <span id="confirmPasswordError" class="error"></span>
            <button id="newPasswordSubmit" class="btn-primary">Submit</button>
        </div>
        <div class="forget-btns">
            <button id="back-to-login" class="btn-secondary">Back to Login</button>
        </div>

    </div>
</div>


<script type="module" src="/CommuSupport/public/JS/login/forgetPassword/forgetPassword.js"></script>