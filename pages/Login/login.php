<?php
session_start();

if (!class_exists('Conexao')) {
    class Conexao
    {
        private $host = '127.0.0.1:3307';
        private $dbname = 'stock_mate';
        private $user = 'root';
        private $pass = '';

        public function conectar()
        {
            try {
                $conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexao;
            } catch (PDOException $e) {
                echo '<p>' . $e->getMessage() . '</p>';
                return null;
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Cria uma instância de conexão
    $conexao = (new Conexao())->conectar();
    if ($conexao) {
        $sql = "SELECT * FROM COLABORADORES WHERE COL_EMAIL = ? AND COL_SENHA = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$email, $senha]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['cargo'] = $result['COL_CARGO']; // Definindo o cargo do usuário na sessão

            // Redirecionar para a página correta após o login
            header('location: ../Estoque/index.php');
            exit;
        } else {
            header('location: index.php');
            exit;
        }
    } else {
        echo "Erro ao conectar ao banco de dados.";
    }
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: ../Estoque/index.php');
    exit;
} else {
    // Usuário não autenticado
    header('location: index.php');
    exit;
}
?>
