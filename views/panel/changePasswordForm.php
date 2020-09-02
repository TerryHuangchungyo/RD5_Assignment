<div class="container my-3">
    <h4 class="text-secondary">更改密碼</h4>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">欲更改密碼:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="password" class="<?=isset($data["changePassword"])? $data["changePassword"]:""?> form-control" id="changePasswordInput" placeholder="請輸入欲更改密碼">
            <div id="changePasswordFeedback" class="invalid-feedback"><?=isset($data["changePasswordFeedback"])?$data["changePasswordFeedback"]:""?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">再次輸入欲更改密碼:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="password" class="<?=isset($data["changeCheckPassword"])?$data["changeCheckPassword"]:""?> form-control" id="changeCheckPasswordInput" placeholder="請再次輸入欲更改密碼">
            <div id="changeCheckPasswordFeedback" class="invalid-feedback"><?=isset($data["changeCheckPasswordFeedback"])?$data["changeCheckPasswordFeedback"]:""?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">請輸入原密碼:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="password" class="<?=isset($data["password"])?$data["password"]:""?> form-control" id="passwordInput" placeholder="請輸入原密碼">
            <div id="passwordFeedback" class="invalid-feedback"><?=isset($data["passwordFeedback"])?$data["passwordFeedback"]:""?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">請再次輸入原密碼:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="password" class="<?=isset($data["checkPassword"])?$data["checkPassword"]:""?> form-control" id="checkPasswordInput" placeholder="請再次輸入原密碼">
            <div id="checkPasswordFeedback" class="invalid-feedback"><?=isset($data["checkPasswordFeedback"])?$data["checkPasswordFeedback"]:""?></div>
        </div>
    </div>
    <div class="row">
        <div class="offset-8 col-2">
            <button type="button" id="changeSubmit" class="float-right btn btn-success">提交</button>
        </div>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>