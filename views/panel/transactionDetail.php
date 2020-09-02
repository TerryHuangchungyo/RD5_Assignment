<div class="container mt-3">
    <h4 class="text-secondary">交易明細</h4>
    <div class="container rounded border border-dark">
        <div class="my-3 ml-2">
            <h5>交易編號: <?=$data["transId"]?></h5>
        </div>
        <div class="my-3 ml-2">
            <h5>交易日期: <?=$data["date"]?></h5>
        </div>
        <div class="my-3 ml-2">
            <h5>交易類型: <?=$data["actionName"]?></h5>
        </div>
        <div class="my-3 ml-2">
            <h5>交易狀態: <?=$data["status"]?></h5>
        </div>
        <div class="my-3 ml-2">
            <h5>交易帳戶: <?=$data["accountName"]?></h5>
        </div>
        <div class="my-3 ml-2">
            <h5>交易金額: <?=$data["value"]?></h5>
        </div>
        <div class="my-3 ml-2">
            <h5>帳戶餘額: <?=$data["residue"]?></h5>
        </div>
        <?php if( !$data["success"] ):?>
            <div class="my-3 ml-2">
                <h5>系統訊息:</h5>
                <p><?=$data["errorMsg"]?></p>
            </div>
        <?php endif;?>
    </div>
    <div class="row float-right mr-1 my-3">
        <button type="button" id="continue" data-where=<?=$data["action"]?> class="btn btn-outline-primary">繼續操作</button>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>