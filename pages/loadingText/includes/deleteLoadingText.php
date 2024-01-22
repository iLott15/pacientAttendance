<?php
if($action=='deleteLoadingText'){
    if(userPermission($_SESSION['userId']) == 15){
			
		// GET VARIABLES VIA GET
		$loadingTextId = mysqli_real_escape_string($mySQL->link,$_GET['loadingTextId']);
		//END GET VARIABLES VIA GET
		$query = $mySQL->sql("DELETE FROM 
                                	loading_texts 
                            	WHERE 
                                    loadingTextId = '".$loadingTextId."'
							");
		changeLog($system, $page, 'Deletou o item - '.$loadingTextId);											
		header("Location: loadingText.php?action=listLoadingText&delLT");
							
	}else{
		echo "<div class=\"col-md-12\">
				<div class=\"alert alert-danger alert-dismissable\">
	                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
	                <h4>	<i class=\"icon fa fa-fan\"></i> Ops!</h4>
	                Desculpa, mas você não tem permissão para efetuar este comando. Para voltar <a href=\"javascript:window.history.go(-1)\">clique aqui</a>
	            </div>
	        </div>
	    </div>";
	}	    
}

if (isset($_GET['delLT'])) {
	echo "
		<div class=\"row\" style=\" margin-left: 2px; margin-right: 2px; margin-bottom: -60px;\">
			<div class=\"col-md-12\">
				<div class=\"alert alert-success alert-dismissable\">
          			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
          			<h4>	<i class=\"icon fa fa-check\"></i> Ok!</h4>
          			Deletado com sucesso!
        		</div>
      		</div>
   		</div>"
 ;
}
?>