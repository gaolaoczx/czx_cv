
<?php if( $resume_list ): ?>
    <ul class="resume_list">
        <?php foreach($resume_list as $resume): ?>
            <li id="rlisr-<?=$resume['id'] ?>" class="list-group-item d-flex justify-content-between align-items-center resume-item">
                <a href="./?m=resume&amp;a=detail&amp;id=<?=$resume['id'] ?>" class="btn btn-light mr-auto" target="_blank" ><?= $resume['title'] ?></a>
                <a href="./?m=resume&amp;a=detail&amp;id=<?=$resume['id'] ?>" target="_blank"><img src="./img/open_in_new.png" alt="简历查看"></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="resume_add btn btn-light">
    <a href="./?m=resume&amp;a=add"><img src="./img/add.png" alt="添加简历">添加我的简历</a>
</div>