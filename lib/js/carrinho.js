window.onload = listar;
temp='';
function addCarrinho(nome, valor, cod)
{
    temp = localStorage.getItem('data');
    temp += "[item]"+nome+"|"+valor+"|"+cod;
    localStorage.setItem('data', temp);
    window.location.href = "carrinho.php";
}
function listar ()
{
   if (document.getElementById("listTable"))
   {
      data = localStorage.getItem('data');
      var quantidade = document.getElementById("listTable").rows.length;
      while (quantidade>1){
         for(var cont=1;cont<=quantidade;cont++){
            document.getElementById("listTable").deleteRow(cont);
            quantidade = document.getElementById("listTable").rows.length;
         }
      }
      var itens = data.split("[item]");
      var total=0;
      var table = '<thead><tr><td>Produto</td><td>Valor</td></tr></thead><tbody>';
      for(var i=1;i<itens.length;i++){
         var valores = itens[i].split("|");
      table += '<tr><td>'+ valores[0] +'</td><td>'+ valores[1] +'</td></tr>';
      total+= parseFloat(valores[1]);
      }
      table+='</tbody>';
      if (total!=0)
      {
         document.getElementById("listTable").innerHTML = table;
         document.getElementById("totalValue").innerHTML = total.toFixed(2);
      }
   }
}
function finalizar ()
{
   data = localStorage.getItem('data');
   var itens = data.split("[item]");
   var codigos = '';
   var total = 0;
   for(var i=1;i<itens.length;i++){
      var valores = itens[i].split("|");
      codigos += valores[2] +", ";
	  total+= parseFloat(valores[1]);
   }
   codigos = codigos.substr(0, codigos.length-2);
   localStorage.setItem('codigos', codigos);
   localStorage.setItem('total', total);
   window.location.href = "finalizar_compra.php";
}

function limpar(i)
{
   localStorage.setItem('data', '');
   if (i==1)
   {
      window.location.href = "carrinho.php";
   }
   
}