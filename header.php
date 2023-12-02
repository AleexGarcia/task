<?php
function headerComponent($nivel = null)
{

    switch ($nivel) {
        case 'admin':
            echo "
                <header>
                    <h1>Tarefas</h1>
                    <nav>
                        <ul>
                            <li><a href='./gerenciar-tarefas.php'>Gerenciar tarefas</a></li>
                            <li><a href='./gerenciar-usuarios.php'>Gerenciar usuários</a></li>
                            <li><a href='./dashboard.php'>Dashboard</a></li>
                            <li><a href='./perfil.php'>Perfil</a></li>
                        </ul>
                    </nav>
                    <a href='./actions/autenticacao/logout.php'>Sair</a>
                </header>
            ";
            break;
        case 'coordenador':
            echo "
            <header>
            <h1>Tarefas</h1>
            <nav>
                <ul>
                    <li><a href='./gerenciar-tarefas.php'>Gerenciar tarefas</a></li>
                    <li><a href='./dashboard.php'>Dashboard</a></li>
                    <li><a href='./perfil.php'>Perfil</a></li>
                </ul>
            </nav>
            <a href='./actions/autenticacao/logout.php'>Sair</a>
        </header>
        ";
            break;
        case 'padrao':
            echo "
            <header>
            <h1>Tarefas</h1>
            <nav>
                <ul>
                    <li><a href='./dashboard.php'>Dashboard</a></li>
                    <li><a href='./perfil.php'>Perfil</a></li>
                </ul>
            </nav>
            <a href='./actions/autenticacao/logout.php'>Sair</a>
             </header>
            
            ";
            break;
        default:
            echo "
        <header>
        <h1>Tarefas</h1>
        <nav>
            <ul>
            </ul>
        </nav>
         </header>
        
        ";
    }
}
