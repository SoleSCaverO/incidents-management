$(document).on('ready',principal);

var $modalRegister;
var $modalEdit;
var $modalDelete;
var states = [];

function principal()
{
    loadStates();
    $modalRegister = $('#modalRegister');
    $modalEdit = $('#modalEdit');
    $modalDelete = $('#modalDelete');
    $('[data-register]').on('click',modalRegister);
    $('[data-edit]').on('click',modalEdit);
    $('[data-delete]').on('click',modalDelete);

    $('#formRegister').on('submit',project);
    $('#formEdit').on('submit',project);
    $('#formDelete').on('submit',project);
}

function loadStates()
{
    $.ajax({
        url:'../public/proyectos-estados',
        type:'GET'
    }).done(function (response) {
        $.each( response,function(key,value ){
            states.push(value);
        });
    });
}

function modalRegister()
{
    // States
    $modalRegister.find('[name=state]').html('');
    for( var j=0; j<states.length; j++ )
        $modalRegister.find('[name=state]').append('<option value="'+states[j].id +'">'+states[j].name+'</option>');

    $modalRegister.modal('show');
}

function modalEdit()
{
    var id = $(this).data('edit');
    var name = $(this).data('name');
    var state = $(this).data('state');
    var visibility = $(this).data('visibility');
    var description= $(this).data('description');

    $modalEdit.find('[name=id]').val(id);
    $modalEdit.find('[name=name]').val(name);
    $modalEdit.find('[name=description]').val(description);

    // Visibilities
    $modalEdit.find('[name=visibilities]').html('');
    if(  visibility == 1 ){
        $modalEdit.find('[name=visibilities]').append(
            '<div class="col-md-3"> <input type="radio" name="visibility" value="1" checked>Público </div>'+
            '<div class="col-md-3"> <input type="radio" name="visibility" value="2">Privado </div>'
        );
    }
    else
    {
        $modalEdit.find('[name=visibilities]').append(
            '<div class="col-md-3"> <input type="radio" name="visibility" value="1">Público </div>'+
            '<div class="col-md-3"> <input type="radio" name="visibility" value="2" checked>Privado </div>'
        );
    }

    // States
    $modalEdit.find('[name=state]').html('');
    for( var j=0; j<states.length; j++ )
        if( states[j].id == state  )
            $modalEdit.find('[name=state]').append('<option value="'+states[j].id +'" selected>'+states[j].name+'</option>');
        else
            $modalEdit.find('[name=state]').append('<option value="'+states[j].id +'">'+states[j].name+'</option>');

    $modalEdit.modal('show');
}

function modalDelete()
{
    var id = $(this).data('delete');
    var name = $(this).data('name');

    $modalDelete.find('[name=id]').val(id);
    $modalDelete.find('[name=name]').val(name);
    $modalDelete.modal('show');
}

function project()
{
    event.preventDefault();
    $.ajax({
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            method: 'POST'
        })
        .done(function( response ) {
            if(response.error)
                showmessage(response.message,0);
            else{
                showmessage(response.message,1);
                setTimeout(function(){
                    location.reload();
                }, 500);
            }
        });
}