<?php
class MySQL {
        var $host;
        var $user;
        var $pass;
        var $db ;

        var $query;
        var $link;
        var $result;
        
        function MySQL(){
        }

        function connect(){
                //Recebendo configuração dos dados de ambiente
                $this->host = $_ENV['DATABASE_HOST'].":".$_ENV['DATABASE_PORT'];
                $this->user = $_ENV['DATABASE_USER'];
                $this->pass = $_ENV['DATABASE_PASSWORD'];
                $this->db   = $_ENV['DATABASE'];
                
                $this->link = mysqlI_connect($this->host,$this->user,$this->pass,$this->db);
		//mysqli_set_charset($this->link,'utf8');
                
                if(!$this->link){
                        echo "<div class='alertMessage error SE'>ERRO NA CONEXÃO.<br>"
                                ."<b>MySQL retornou: </b> ".mysqli_error($this->link)."<br></div>";
                        die();
                }
        }

        function sql($query){
                $this->connect();
                $this->query = $query;
                if($this->result=mysqli_query($this->link, $this->query)){
                        return $this->result;
                } else {
                        die("<div class='alertMessage error SE'><h2>OCORREU UM ERRO AO EXECUTAR A QUERY SQL ABAIXO:</h2><br>".$query."<<br><br><b>MySQL Retornou: ".mysqli_error($this->link)."<b></div>");
                }
        }

        function disconnect(){
                return mysqli_close($this->link);
        }
}
?>