<?php
class Product {
	public $Id; 
	public $CPF_Requeridor; 
	public $CPF_Administrator; 
	public $Nome; 
	public $Descricao; 
	public $PaisOrigem;
	public $UltimoPreco;
	public $Tipo;
	public $QuantidadeEstoque ;
	public $Categories;
	
	function  __construct()
	{
		$this->Categories= new EnumCategories();
	}
	function __destruct() 
	{
		
	}
		
	public function GetAllOfficialProducts($categorie)
	{
		$AllProducts = array();
		$connection = Server::conect();
		
		if($categorie != null)
			$query = mysql_query("select * from Produto P inner join Categoria C on P.Id = C.id_produto where P.tipo = 'oficial' and categoria =" .$categorie, $connection);
		else
			$query = mysql_query("select * from Produto where tipo = 'oficial'", $connection);
	
		$count = 0;
		while($count < mysql_num_rows($query))
		{
			$product = new Product();
			$product->Id = mysql_result($query, $count, "id");
			$product->CPF_Requeridor = mysql_result($query, $count, "cpf_requeridor");
			$product->CPF_Administrator =  mysql_result($query, $count, "cpf_administrador");
			$product->Nome =  mysql_result($query, $count, "nome");
			$product->Descricao =  mysql_result($query, $count, "descricao");
			$product->PaisOrigem =  mysql_result($query, $count, "pais_origem");
			$product->UltimoPreco =  mysql_result($query, $count, "ultimo_preco_dolar");
			$product->Tipo =  mysql_result($query, $count, "tipo");
			$product->QuantidadeEstoque =  mysql_result($query, $count, "quantidade_estoque");
	
			$AllProducts[$count] = $product;
	
			$count = $count + 1;
		}
		return $AllProducts;
	}

	public function InsertProductAdministrator($v_cpf, $v_nome, $v_desc, $v_pais, $v_preco, $v_quantidade)
	{
		$connection = Server::conect();
		
		$query = mysql_query("call cadastrar_produto(".$v_cpf.", ".$v_nome.", ". $v_desc.", ". $v_pais.", ". $v_preco.", ". $v_quantidade.")", $connection);
		$v_id =  mysql_insert_id($connection);
		
		$product = new Product();
		$product->Id = $v_id;
		$product->CPF_Administrator = $v_cpf;
		$product->Nome = $v_nome;
		$product->Descricao = $v_desc;
		$product->PaisOrigem = $v_pais;
		$product->UltimoPreco = $v_preco;
		$product->QuantidadeEstoque = $v_quantidade;
		
		return $product;
	} 
	
	public function UpdateProductAdministrator($v_cpf, $v_nome, $v_desc, $v_pais, $v_preco, $v_quantidade, $v_tipo)
	{
		$connection = Server::conect();
		
		$query = mysql_query("update Produto set cpf_administrador = ". $v_cpf. 
				", nome = ". $v_nome .", descricao=".$v_desc.", pais_origem = ".$v_pais.
				", ultimo_preco_dolar = ".$v_preco.", tipo =".$v_tipo.", quantidade_estoque= ". $v_quantidade.
				" where id = ".$Id, $connection);
		if($query)
		{
			$CPF_Administrator = $v_cpf;
			$Nome = $v_nome;
			$Descricao = $v_desc;
			$PaisOrigem = $v_pais;
			$UltimoPreco = $v_preco;
			$QuantidadeEstoque = $v_quantidade;
			return true;
		}
		else
		{
			return false;
		}
	} 
}

class EnumCategories {
	public static $AllCategories = array();
	public $Categories = array();
	
	public function _EnumCategories()
	{
		$this->AllCategories[0] = "None";
		$this->AllCategories[1] = "CD";
		$this->AllCategories[2] = "DVD";
	}
	
	public function AddCategorie($index)
	{
		$this->Categories[$index] = $this->AddCategorie[$index];
	}
}

?>
