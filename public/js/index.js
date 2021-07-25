

$(document).ready(function() {
    $('#wilaya').change(function(e) {
         //console.log(e.target.value);
         const wilayaName = e.target.value;
         $.ajax({
             method:'GET',
             url: '/communes/'+wilayaName,
             data:{
                 _token: '{{csrf_token()}}',
             },
             dataType: 'json'
         }).done(function(data){
             //console.log(data);
             $('#commune').empty();
             $.each(data.communes, function(key, value){
                 $('#commune').append('<option>' +value.name+ '</option>')
            })
        });
    })

    $('#info').on('submit', function(e){
        e.preventDefault();
        const name = $('#name').val();
        const email = $('#email').val();
        const phone = $('#phone').val();
        $.ajax({
            method:'PUT',
            url: '/user/settings/information',
            data:{
                name:name,
                email:email,
                phone:phone,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json'
        }).done(function(data){
            if(data.success){
                var success = $('<div class="alert alert-success" id="myAlert" role="alert"></div>').text(data.success);
                $("#alert").before(success); 
                setTimeout(function(){
                    $("#myAlert").remove()
                }, 3000);
            }else{
                var errors = $('<div class="alert alert-danger" id="myAlert" role="alert"></div>');
                $("#alert").before(errors); 
                $.each(data.errors, function(key, value){
                    errors.append('<p>'+value+'</p>');
                });
                setTimeout(function(){
                    $("#myAlert").remove()
                }, 3000);
            }
        });
    })
    // password update
    $('#pass').on('submit', function(e){
        e.preventDefault();
        const current_password = $('#current_password').val();
        const password = $('#password').val();
        const password_confirmation = $('#password_confirmation').val();
        $.ajax({
            method:'PUT',
            url: '/user/settings/password',
            data:{
                current_password:current_password,
                password:password,
                password_confirmation:password_confirmation,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json'
        }).done(function(data){
            if(data.success){
                var success = $('<div class="alert alert-success" id="myAlert" role="alert"></div>').text(data.success);
                $("#alert-p").before(success); 
                setTimeout(function(){
                    $("#myAlert").remove()
                }, 3000);
            }else{
                var errors = $('<div class="alert alert-danger" id="myAlert" role="alert"></div>');
                $("#alert-p").before(errors); 
                $.each(data.errors, function(key, value){
                    errors.append('<p>'+value+'</p>');
                });
                setTimeout(function(){
                    $("#myAlert").remove()
                }, 3000);
            }
        });
    })
})
