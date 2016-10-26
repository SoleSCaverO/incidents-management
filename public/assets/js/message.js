function showmessage( message, success )
{
    $.notify( message,(success==1)?"success":"error" );
}