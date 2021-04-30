<?php
    ob_start();
    session_start();

    if ($_SESSION['loggedtype'] != "admin") {
        header("Location: LoginA.php");
    }
?>
<!DOCTYPE html>
<html>
<title>Administradores</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="../CSS/Admin.css">
<script src="https://kit.fontawesome.com/91ccf300f9.js" crossorigin="anonymous"></script>
<script src="../JavaScript/DCF.js"></script>
<script src="../JavaScript/Admin.js"></script>

<body>
    <div id="Div">
        <br>
        <h1 class="w3-center" id="informacoesP">Informações Sobre:</h1>
        <div id="Options">
            <div id="voluntarioDiv">
                <a href="AdminV.php"><i class="fa fa-male" id="voluntarioIcon"></i></a>
                <h5 id="voluntarioP">Voluntários</p>
            </div>
            <div id="instituicaoDiv">
                <a href="AdminI.php"><i class="fa fa-building" id="instituicaoIcon"></i></a>
                <h5 id="instituicaoP">Instituições</p>
            </div>
            <div id="acaoDiv">
                <a href="AdminA.php"><i class="fa fa-hands-helping" id="acaoIcon"></i></a>
                <h5 id="acaoP">Ações</p>
            </div>
        </div>
        
    </div>

    <h1 id='todosU' class='w3-text-black'> <b>Todos utilizadores</b> </h1>

    <div class="w3-container w3-small">
        <div id="filtrarutilizadores">
                <div id="esq">
                    <label><b>ID</b></label>
                    <input type="text" class="w3-input" name="id" placeholder="ID" name="id" id="id"/>
                    <br>
                    <label><b>Distrito:</b></label>
                    <select class="w3-input" name="distrito" id="distrito" size="1">
                        <option value="" disabled selected>Selecione o seu Distrito:</option>
                    </select> 
                    <br>
                    <label><b>Concelho:</b></label>
                    <select class="w3-input" name="concelho" id="concelho" size="1">
                        <option value="" disabled selected>Selecione o seu Concelho:</option>
                    </select> 
                </div>
                <div id="dir">
                    <label><b>Nome</b></label>
                    <input type="text" class="w3-input" name="nome" placeholder="Nome" name="nome" id="nome"/>
                    <br>
                    <label><b>Freguesia:</b></label>
                    <select class="w3-input" name="freguesia" id="freguesia" size="1">
                        <option value="" disabled selected>Selecione a sua Freguesia:</option>
                    </select> 
                    <br>
                    <label><b>Tipo:</b></label>
                    <select class="w3-input" name="tipo" id="tipo" size="1">
                        <option value="" disabled selected>Tipo</option>
                        <option value="Voluntário">Voluntário</option>
                        <option value="Instituição">Instituição</option>
                        <option value="Ação">Ação</option>
                    </select> 
                </div>
                <input class="w3-button" id="limpaprocura" onclick="LimparProcuraUtilizadores()" type="submit" value="Limpar"/>
                <input class="w3-button" id="procura" onclick="showTodosUtilizadores()" type="submit" value="Procura"/>
        </div>
    </div>

    <div id='todosUtilizadoresDiv'>
    </div>

    <h1 id='todosCo' class='w3-text-black'> <b>Convites</b> </h1>

    <div class="w3-container w3-small">
        <div id="filtrarconvites">
                <div id="esq">
                    <label><b>Voluntário</b></label>
                    <input type="text" class="w3-input" name="voluntario" placeholder="Voluntário" name="voluntario" id="con_voluntario"/>
                    <br>
                    <label><b>Instituição</b></label>
                    <input type="text" class="w3-input" name="instituicao" placeholder="Instituição" name="instituicao" id="con_instituicao"/>
                    <br>
                    <label><b>Ação</b></label>
                    <input type="text" class="w3-input" name="acao" placeholder="Ação" name="acao" id="con_acao"/>
                </div>
                <div id="dir">
                    <label><b>Estado</b></label>
                    <select class="w3-input" name="estado" id="con_estado">
                        <option value="" disabled selected>Estado:</option>
                        <option value="Pendente">Pendente</option>
                        <option value="Aceite">Aceite</option>
                        <option value="Rejeitado">Rejeitado</option>
                    </select> 
                    <br>
                    <label><b>Data</b></label>
                    <input type="date" class="w3-input" name="data" placeholder="Data" name="data" id="con_data"/>
                </div>
                <input class="w3-button" id="limpaprocura" onclick="LimparProcuraConvites()" type="submit" value="Limpar"/>
                <input class="w3-button" id="procura" onclick="showTodosConvites()" type="submit" value="Procura"/>
        </div>
    </div>

    <div id='todosConvitesDiv'>
    </div>

    <h1 id='todosCa' class='w3-text-black'> <b>Candidaturas</b> </h1>

    <div class="w3-container w3-small">
        <div id="filtrarcandidaturas">
            <div id="esq">
                    <label><b>Voluntário</b></label>
                    <input type="text" class="w3-input" name="voluntario" placeholder="Voluntário" name="voluntario" id="can_voluntario"/>
                    <br>
                    <label><b>Instituição</b></label>
                    <input type="text" class="w3-input" name="instituicao" placeholder="Instituição" name="instituicao" id="can_instituicao"/>
                    <br>
                    <label><b>Ação</b></label>
                    <input type="text" class="w3-input" name="acao" placeholder="Ação" name="acao" id="can_acao"/>
                </div>
                <div id="dir">
                    <label><b>Estado</b></label>
                    <select class="w3-input" name="estado" id="can_estado">
                        <option value="" disabled selected>Estado:</option>
                        <option value="Pendente">Pendente</option>
                        <option value="Aceite">Aceite</option>
                        <option value="Rejeitado">Rejeitado</option>
                    </select> 
                    <br>
                    <label><b>Data</b></label>
                    <input type="date" class="w3-input" name="data" placeholder="Data" name="data" id="can_data"/>
                </div>
                <input class="w3-button" id="limpaprocura" onclick="LimparProcuraCandidaturas()" type="submit" value="Limpar"/>
                <input class="w3-button" id="procura" onclick="showTodasCandidaturas()" type="submit" value="Procura"/>
        </div>
    </div>

    <div id='todasCandidaturasDiv'>
    </div>

    <h1 id='todosP' class='w3-text-black'> <b>Participações</b> </h1>

    <div class="w3-container w3-small">
        <div id="filtrarparticipacoes">
                <div id="esq">
                <label><b>Voluntário</b></label>
                    <input type="text" class="w3-input" name="voluntario" placeholder="Voluntário" name="voluntario" id="par_voluntario"/>
                    <br>
                    <label><b>Instituição</b></label>
                    <input type="text" class="w3-input" name="instituicao" placeholder="Instituição" name="instituicao" id="par_instituicao"/>
                </div>
                <div id="dir">
                    <label><b>Ação</b></label>
                    <input type="text" class="w3-input" name="acao" placeholder="Ação" name="acao" id="par_acao"/>
                </div>
                <input class="w3-button" id="limpaprocura" onclick="LimparProcuraParticipacoes()" type="submit" value="Limpar"/>
                <input class="w3-button" id="procura" onclick="showTodasParticipacoes()" type="submit" value="Procura"/>
        </div>
    </div>

    <div id='todasParticipacoesDiv'>
    </div>

</body>