
function send_form ( form_id )
{
    // alert($("#"+form_id).attr("action"));
    $.post( $("#"+form_id).attr("action") , $("#"+form_id).serialize() , function ( data )
    {
        // alert(data);
        if( $("#"+form_id+"_notice") )
        {
            $("#"+form_id+"_notice").html( data );
        }
    } );
}

function delete_confirm ( resume_id )
{
    // alert(resume_id);
    if ( confirm("真的要删除简历吗？") )
    {
        $.post("./?m=resume&a=delete&id="+resume_id, null ,function ( data )
        {
            if ( data == 'done')
            {
                $("#rlisr-"+resume_id).remove();
            }
        } );
    }
}
