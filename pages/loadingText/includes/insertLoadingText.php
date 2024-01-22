<?php 
if(isset($_POST['insertLoadingText'])){
    if(userPermission($_SESSION['userId']) < 14) {
?>   
    <script>window.location='error.php?action=001';</script>
<?php     
    }
	
	// GET VARIABLES VIA POST
    $loadingTextDescription = mysqli_real_escape_string($mySQL->link,$_POST['loadingTextDescription']);
    $loadingTextActor = mysqli_real_escape_string($mySQL->link,$_POST['loadingTextActor']);

    $query = $mySQL->sql("INSERT INTO 
                            loading_texts 
                            (
                                loadingTextDescription,
                                loadingTextActor
                            )
                            VALUES 
                            (			
                                '".$loadingTextDescription."',						
                                '".$loadingTextActor."'
                            )
                        ");
        $loadingTextId = mysqli_insert_id($mySQL->link);
        changeLog($system, $page, 'Criou Nova Mensgem - '.$loadingTextId);		
                        
        header("Location: loadingText.php?action=listLoadingText&inLT");	

}
if(isset($_GET['inLT'])){
	echo "
		<div class=\"row\" style=\" margin-left: 2px; margin-right: 2px; margin-bottom: -60px;\">
			<div class=\"col-md-12\">
				<div class=\"alert alert-success alert-dismissable\">
          			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
          			<h4>	<i class=\"icon fa fa-check\"></i> Ok!</h4>
          			Cadastro de Mensagem feito com sucesso!
        		</div>
      		</div>
   		</div>
   		<br><br>";

}
?>