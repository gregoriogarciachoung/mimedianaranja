<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Chat online</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="js/prototype.js"></script>
	<link rel="stylesheet" href="css/chat.css">
  </head>
  <body>
<main>
<aside>
<h1>Habla con todos</h1>
<h3>Muchas personas no quieren esperar a que las agreges</h3>
</aside>
<section>
<div id="content">
</div>
<p>
  <form action="" method="get" onsubmit="comet.doRequest($('txtusu').value, $('word').value);$('word').value='';return false;">
    <input type="text" name="txtusu" id="txtusu" value="<?php echo $_GET['usuario'] ?>" readonly="readonly" style="border:0"/>
	<input type="text" name="word" id="word" value="" />
    <input type="submit" name="submit" value="Enviar" />
  </form>
</p>
</section>
</main>
<script type="text/javascript">
var Comet = Class.create();
var esteusu = document.querySelector("#txtusu").value;
Comet.prototype = {

  timestamp: 0,
  url: './backend.php',
  noerror: true,

  initialize: function() { },

  connect: function()
  {
    this.ajax = new Ajax.Request(this.url, {
      method: 'get',
      parameters: { 'timestamp' : this.timestamp },
      onSuccess: function(transport) {
        // handle the server response
        var response = transport.responseText.evalJSON();
        this.comet.timestamp = response['timestamp'];
        this.comet.handleResponse(response);
        this.comet.noerror = true;
      },
      onComplete: function(transport) {
        // send a new ajax request when this request is finished
        if (!this.comet.noerror)
          // if a connection problem occurs, try to reconnect each 5 seconds
          setTimeout(function(){ comet.connect() }, 5000); 
        else
          this.comet.connect();
        this.comet.noerror = false;
      }
    });
    this.ajax.comet = this;
  },

  disconnect: function()
  {
  },

  handleResponse: function(response)
  {
    $('content').innerHTML += '<div>' + response['msg'] + '</div>';
  },

  doRequest: function(usu, request)
  {
    new Ajax.Request(this.url, {
      method: 'get',
      parameters: { 'msg' : usu+": "+request }
    });
  }
}
var comet = new Comet();
comet.connect();
</script>

</body>
</html>