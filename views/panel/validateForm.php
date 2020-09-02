<div class="container my-3">
    <h4 class="text-secondary">驗證</h4>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">密碼:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="password" class="<?=isset($data["validatePassword"])?$data["validatePassword"]:""?> form-control" id="validatePasswordInput" placeholder="請輸入網銀密碼">
            <div id="validatePasswordFeedback" class="invalid-feedback"><?=isset($data["validatePasswordFeedback"])?$data["validatePasswordFeedback"]:""?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">密碼確認:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="password" class="<?=isset($data["validateCheckPassword"])?$data["validateCheckPassword"]:""?> form-control" id="validateCheckPasswordInput" placeholder="請再次輸入網銀密碼">
            <div id="validateCheckPasswordFeedback" class="invalid-feedback"><?=isset($data["validateCheckPasswordFeedback"])?$data["validateCheckPasswordFeedback"]:""?></div>
        </div>
    </div>
    <div class="row">
        <div class="offset-8 col-2">
            <button type="button" id="validateSubmit" class="float-right btn btn-success">提交</button>
        </div>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>