$(document).on('ready',principal);

var $modalRegister;
var $modalEdit;
var $modalDelete;
var states = [];
var frequencies = [];
var priorities = [];

function principal()
{
    $('.mytable').footable();

    // States
    $.ajax({
        url:'../incidencias-estados',
        type:'GET'
    }).done(function (response) {
        $modalRegister.find('[name=state]').html('');
        $.each( response,function(key,value ){
            states.push(value);
        });
    });

    // Frequencies
    $.ajax({
        url:'../incidencias-frecuencias',
        type:'GET'
    }).done(function (response) {
        $modalRegister.find('[name=frequency]').html('');
        $.each( response,function(key,value ){
            frequencies.push(value);
        });
    });

    // Priorities
    $.ajax({
        url:'../incidencias-prioridades',
        type:'GET'
    }).done(function (response) {
        $modalRegister.find('[name=priority]').html('');
        $.each( response,function(key,value ){
            priorities.push(value);
        });
    });

    $modalRegister = $('#modalRegister');
    $modalEdit = $('#modalEdit');
    $modalDelete = $('#modalDelete');

    $('[data-register]').on('click',modalRegister);
    $('[data-edit]').on('click',modalEdit);
    $('[data-delete]').on('click',modalDelete);

    $('#formRegister').on('submit',processIncident);
    $('#formEdit').on('submit',processIncident);
    $('#formDelete').on('submit',processIncident);
}

function modalRegister()
{
    var project = $('#project').val();
    $modalRegister.find('[name=project]').val(project);

    // States
    $modalRegister.find('[name=state]').html('');
    for( var i=0; i<states.length;i++ )
        $modalRegister.find('[name=state]').append('<option value="'+states[i].id +'">'+states[i].name+'</option>');

    // Frequencies
    $modalRegister.find('[name=frequency]').html('');
    for( var j=0; j<frequencies.length;j++ )
        $modalRegister.find('[name=frequency]').append('<option value="'+frequencies[j].id +'">'+frequencies[j].name+'</option>');

    // Priorities
    $modalRegister.find('[name=priority]').html('');
    for( var k=0; k<priorities.length;k++ )
        $modalRegister.find('[name=priority]').append('<option value="'+priorities[k].id +'">'+priorities[k].name+'</option>');

    setTimeout(function(){
        $modalRegister.modal('show');
    }, 1000);
}

function modalEdit()
{
    var id = $(this).data('edit');
    var name = $(this).data('name');
    var summary = $(this).data('summary');
    var category = $(this).data('category');
    var state = $(this).data('state');
    var frequency = $(this).data('frequency');
    var priority = $(this).data('priority');
    var visibility = $(this).data('visibility');
    var platform = $(this).data('platform');
    var os = $(this).data('os');
    var os_version = $(this).data('os_version');

    $modalEdit.find('[name=id]').val(id);
    $modalEdit.find('[name=name]').val(name);
    $modalEdit.find('[name=summary]').val(summary);

    // Categories
    $modalEdit.find('[name=categories]').html('');
    if(  category == 1 ){
        $modalEdit.find('[name=categories]').append(
            '<div class="col-md-3"> <input type="radio" name="category" value="1" checked>Software </div>'+
            '<div class="col-md-3"> <input type="radio" name="category" value="2">Hardware </div>'
        );
    }
    else
    {
        $modalEdit.find('[name=categories]').append(
            '<div class="col-md-3"> <input type="radio" name="category" value="1">Software </div>'+
            '<div class="col-md-3"> <input type="radio" name="category" value="2" checked>Hardware </div>'
        );
    }

    // States
    $modalEdit.find('[name=state]').html('');
    for( var i=0; i<states.length;i++ )
        if( states[i].id == state )
            $modalEdit.find('[name=state]').append('<option value="'+states[i].id +'" selected>'+states[i].name+'</option>');
        else
            $modalEdit.find('[name=state]').append('<option value="'+states[i].id +'">'+states[i].name+'</option>');

    // Frequencies
    $modalEdit.find('[name=frequency]').html('');
    for( var j=0; j<frequencies.length;j++ )
        if( frequencies[j].id ==frequency )
            $modalEdit.find('[name=frequency]').append('<option value="'+frequencies[j].id +'" selected>'+frequencies[j].name+'</option>');
        else
            $modalEdit.find('[name=frequency]').append('<option value="'+frequencies[j].id +'">'+frequencies[j].name+'</option>');

    // Priorities
    $modalEdit.find('[name=priority]').html('');
    for( var k=0; k<priorities.length;k++ )
        if( priorities[k].id == priority )
            $modalEdit.find('[name=priority]').append('<option value="'+priorities[k].id +'" selected>'+priorities[k].name+'</option>');
        else
            $modalEdit.find('[name=priority]').append('<option value="'+priorities[k].id +'">'+priorities[k].name+'</option>');

    // Visibilities
    $modalEdit.find('[name=visibilities]').html('');
    if(  category == 1 ){
        $modalEdit.find('[name=visibilities]').append(
            '<div class="col-md-3"> <input type="radio" name="visibility" value="1" checked>Pública </div>'+
            '<div class="col-md-3"> <input type="radio" name="visibility" value="2">Privada </div>'
        );
    }
    else
    {
        $modalEdit.find('[name=visibilities]').append(
            '<div class="col-md-3"> <input type="radio" name="visibility" value="1">Pública </div>'+
            '<div class="col-md-3"> <input type="radio" name="visibility" value="2" checked>Privada </div>'
        );
    }
    $modalEdit.find('[name=platform]').val(platform);
    $modalEdit.find('[name=os]').val(os);
    $modalEdit.find('[name=os_version]').val(os_version);

    setTimeout(function(){
        $modalEdit.modal('show');
    }, 1000);
}

function modalDelete()
{
    var id = $(this).data('delete');
    var name = $(this).data('name');

    $modalDelete.find('[name=id]').val(id);
    $modalDelete.find('[name=name]').val(name);
    $modalDelete.modal('show');
}

function processIncident()
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