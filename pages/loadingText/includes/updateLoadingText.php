<?php 
if(isset($_POST['updateLoadingText'])){
    if(userPermission($_SESSION['userId']) < 14) {
?>   
    <script>window.location='error.php?action=001';</script>
<?php     
    }
	
	// GET VARIABLES VIA POST
    $loadingTextId = mysqli_real_escape_string($mySQL->link,$_POST['loadingTextId']);
    $loadingTextDescription = mysqli_real_escape_string($mySQL->link,$_POST['loadingTextDescription']);
    $loadingTextActor = mysqli_real_escape_string($mySQL->link,$_POST['loadingTextActor']);
    

    $query = $mySQL->sql("UPDATE  
                            loading_texts 
                        SET
                            loadingTextDescription = '".$loadingTextDescription."',
                            loadingTextActor = '".$loadingTextActor."'
                        WHERE
                            loadingTextId = '".$loadingTextId."'
                        ") or die("<h4 class='widgettitle title-danger'> Erro ao editar item no banco de dados </h4></br>");
        changeLog($system, $page, 'Editou a Mensgem - '.$loadingTextId);		
                        
        header("Location: loadingText.php?action=editLoadingText&loadingTextId=$loadingTextId&upLT");	

}
if(isset($_GET['upLT'])){
	echo "
		<div class=\"row\" style=\" margin-left: 2px; margin-right: 2px; margin-bottom: -60px;\">
			<div class=\"col-md-12\">
				<div class=\"alert alert-success alert-dismissable\">
          			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
          			<h4>	<i class=\"icon fa fa-check\"></i> Ok!</h4>
          			Edição de Mensagem feita com sucesso!
        		</div>
      		</div>
   		</div>
   		<br><br>";

}
?>