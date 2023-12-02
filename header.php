<?php
function headerComponent($nivel = null, $nome = null)
{

    switch ($nivel) {
        case 'admin':
            echo "
                <header>
                <div>
                <h1>Tarefas</h1>
                <p>Bem-vindo, $nome !</p>
                </div>
                    <nav>
                        <ul>
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
            <div>
                <h1>Tarefas</h1>
                <p>Bem-vindo, $nome !</p>
                </div>
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
        case 'padrao':
            echo "
            <header>
            <div>
                <h1>Tarefas</h1>
                <p>Bem-vindo, $nome !</p>
                </div>
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
