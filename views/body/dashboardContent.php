<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?=$data["brandName"]?></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto" action="<?=Web::root?>dashboard/logout">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">登出</button>
        </form>
    </div>
</nav>
<div class="row bg-white">
    <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <?php foreach( $data["navs"] as $name => $value):  ?>
                <a class="nav-link" id="<?=$name?>-tab" data-toggle="pill" href="#<?=$name?>" role="tab" aria-controls="<?=$name?>" aria-selected="false"><?=$value?></a>
            <?php endforeach;?>
        </div>
    </div>
    <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
            <?php foreach( $data["navs"] as $name => $value):  ?>
                <div class="tab-pane fade" id="<?=$name?>" role="tabpanel" aria-labelledby="<?=$name?>-tab"></div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>