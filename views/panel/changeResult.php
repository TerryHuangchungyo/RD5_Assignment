<div class="container mt-3">
    <h4 class="text-secondary"><?=$data["what"]?>更改<?=$data["success"]?></h4>
    <div class="row mb-3">
        <?php if( isset($data["msg"])): ?>
            <?php
                echo "<h5>系統訊息</h5>";
                foreach($data["msg"] as $msg) {
                    echo $msg."<br>";
                }
                echo "如有任何問題請儘速聯絡客服<br>";
                echo "聯絡電話: 0950816888<br>";
                echo "聯絡信箱: 12345@mail.money.com<br>";
            ?>
        <?php endif;?>
    </div>
    <div class="row">
        <div class="offset-8 col-2">
            <button type="button" id="continue" data-where="<?=$data["where"]?>" class="float-right btn btn-outline-primary">繼續操作</button>
        </div>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>