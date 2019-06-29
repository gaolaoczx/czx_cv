
<form action="./?m=resume&amp;a=update" id="form_resume_modify" onsubmit="send_form('form_resume_modify');return false;">
    <div id="form_resume_modify_notice" class="form_info full"></div>
    <div class="form-group">
        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="<?=$resume['title'] ?>">
    </div>
    <div class="form-group">
        <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="10"><?=htmlspecialchars($resume['content']) ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?=$resume['id'] ?>" />
    <button type="submit" id='modify_finished' class="btn btn-primary">修改完成</button>
</form>

