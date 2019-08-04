
function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}


$(document).ready(function(){
    var boxesChecked = false;

    $("#btn-checkAll").click(function(){
        
        boxesChecked = !boxesChecked;
        if(boxesChecked) {
            $(this).removeClass("btn btn-outline-secondary");
            $(this).addClass("btn btn-outline-primary");
        } else {
            $(this).removeClass("btn btn-outline-primary");
            $(this).addClass("btn btn-outline-secondary");
        }

        var boxes = document.getElementsByName("afiliadosId[]");
        for(var i=0; i < boxes.length; i++) {
            boxes[i].checked = boxesChecked;
        }
    });

    $("#descargar").click(function(){
        var boxes = document.getElementsByName("afiliadosId[]");
        let afiliadosId = [];
        for (var i=0; i < boxes.length; i++) {
            if (boxes[i].checked) 
            {
                afiliadosId.push(boxes[i].value);
            }
        }

        $.ajax({
            url: "/afiliados/download",
            type: 'post',
            data: {
                ids: afiliadosId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (result) {
                download(new Date(), result);
            }
        });
    });

    $("body").on("click", function(e){
        if($(e.target).is(".btn-registrar")) {
            e.preventDefault();
            
            $.ajax({
                url: $("#form-reg").attr('action'),
                type: 'post',
                data: $("#form-reg").serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (result) {
                    $('#regModal').modal('hide');
                    $("#alerta-exito").append(result['success']);
                    $("#alerta-exito").show()
                    setTimeout(function () { document.location.reload(true); }, 750);
                }
            });

        } 

        if($(e.target).is(".btn-editar")) {
            e.preventDefault();
            const id = e.target.value;

            var data = $("#form-"+id).serialize();
            data['_method'] = 'PUT';
    
            $.ajax({
                url: $("#form-"+id).attr('action'),
                type: 'post',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (result) {
                    $('#editModal-'+id).modal('hide');
                    $("#alerta-exito").append(result['success']);
                    $("#alerta-exito").show()
                    setTimeout(function () { document.location.reload(true); }, 750);
                }
            });

        } 

        if($(e.target).is(".btn-eliminar")) {
            const id = e.target.value;

            var data = {id : id};
            data['_method'] = 'DELETE';

            $.ajax({
                url: "/afiliados/"+id,
                type: 'post',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (result) {
                    $('#destroyModal-'+id).modal('hide');
                    $("#alerta-exito").append(result['success']);
                    $("#alerta-exito").show()
                    setTimeout(function () { document.location.reload(true); }, 500);
                }
            });
        }             
    });
});