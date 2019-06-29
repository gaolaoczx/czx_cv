
<form action="./?m=resume&amp;a=save" id="form_resume_add" onsubmit="send_form('form_resume_add');return false;">
    <div id="form_resume_add_notice" class="form_info full"></div>
    <div class="form-group">
        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="简历标题"  >
    </div>
    <div class="form-group">
        <textarea name="content" class="form-control" placeholder="简历内容，支持markdown语法(不少于10个字符)" id="exampleFormControlTextarea1" rows="10"></textarea>
    </div>
    <button type="submit" id='save_resume' class="btn btn-primary">保存简历</button>
</form>

