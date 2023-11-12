<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
</head>
<body>
    
    <h1>Busque por um Usuario</h1>

    <form action="" method="post" id="form" name="form">
        <input type="Search" name="text" placeholder="Pesquisar" id="text">
        <input type="submit" value="Pesquisar">
    </form>

    <div class="resultado">
      
    </div>
    <script>
            $('#form').on('submit', function(e){
                e.preventDefault();
                var usuario = $('#text').val();

                if(usuario == ''){
                    alert('Insira um usuario');
                }else{
                    $.ajax({
                        url: 'buscaUsuario.php',
                        type: 'POST',
                        data: {text: usuario},
                    }).done(function(data){
                        
                        let jData = JSON.parse(data);
                        
                        if(jData.success){
                            console.log(data);
                            let html = '';
                            for (let key in jData.data) {
                                html += `
                                        <ul>
                                        <li>Nome: ${jData.data[key].Nome} </li>
                                        <li>Usuario: ${jData.data[key].Usuario} </li>
                                        <li>Senha: ${jData.data[key].Senha} </li>
                                `;
                                html+= '</ul>';
                            }
                            
                            $('.resultado').html(html);

                        }
                        });
                    }});

        </script>    
</body>
</html>