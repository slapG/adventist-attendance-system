<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"><img src="<?= $this->Url->assetUrl('img/logo.png') ?>" alt="Logo" style="height: 166px; width: 400px;"></a>
            </div>
            <p class="auth-subtitle mb-4">Log in with your data that you entered during registration.</p>
            <?= $this->form->create(); ?>
                <div class="form-group position-relative has-icon-left mb-4">
                    <?= $this->form->text('email', [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => ' Enter Email',
                        'id' => 'email',
                        'require' => true
                        ]); ?>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <?= $this->form->password('password', [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Enter Password',
                        'id' => 'password',
                        'require' => true
                    ])?>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-check form-check-lg d-flex align-items-end">
                    <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label text-gray-600" for="flexCheckDefault">
                        Keep me logged in
                    </label>
                </div>
                <?= $this->Form->button('Login', ['type' => 'submit','class' => 'btn btn-primary btn-block btn-m shadow-lg mt-4']); ?>
            <?= $this->form->end(); ?>
            <div class="text-center mt-4 text-lg fs-4">
                <p class="text-gray-600">Don't have an account? <a href="auth-register.html"
                        class="font-bold">Sign
                        up</a>.</p>
                <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">
        </div>
    </div>
</div>
<?= $this->Html->script(['login.js'])?>