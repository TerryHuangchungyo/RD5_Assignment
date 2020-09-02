<div class="container mt-3">
    <h4 class="pl-2 text-secondary">帳戶資訊</h4>
    <div class="card mt-3">
        <div class="card-header">
            <?=$data["accountHolder"]?>，您好
        </div>
        <div class="card-body">
        <h5>帳戶名稱: <?=$data["accountName"]?></h5>
        <h5>帳戶餘額: $   <?=$data["accountBalance"]?></h5>
        </div>
    </div>
</div>