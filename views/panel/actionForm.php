<div class="container my-3">
    <h4 class="text-secondary"><?=$data["actionName"]?></h4>
    <div class="row my-3">
        <div class="col-3">
            <h5 class="pt-2"><?=$data["actionName"]?>金額:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="text" class="<?=isset($data["valueInvalid"])?$data["valueInvalid"]:""?> form-control" value="<?=isset($data["value"])?$data["value"]:""?>" id="value" placeholder="請輸入<?=$data["actionName"]?>金額">
            <div id="valueFeedback" class="invalid-feedback"><?=isset($data["valueFeedback"])?$data["valueFeedback"]:""?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">密碼:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="password" class="<?=isset($data["actionPassword"])?$data["actionPassword"]:""?> form-control" id="actionPasswordInput" placeholder="請輸入網銀密碼">
            <div id="actionPasswordFeedback" class="invalid-feedback"><?=isset($data["actionPasswordFeedback"])?$data["actionPasswordFeedback"]:""?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">密碼確認:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="password" class="<?=isset($data["actionCheckPassword"])?$data["actionCheckPassword"]:""?> form-control" id="actionCheckPasswordInput" placeholder="請再次輸入網銀密碼">
            <div id="actionCheckPasswordFeedback" class="invalid-feedback"><?=isset($data["actionCheckPasswordFeedback"])?$data["actionCheckPasswordFeedback"]:""?></div>
        </div>
    </div>
    <div class="row">
        <div class="offset-8 col-2">
            <button data-action="<?=$data["action"]?>" type="button" id="actionSubmit" class="float-right btn btn-success">提交</button>
        </div>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>