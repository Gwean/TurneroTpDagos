
  function addOrder() {
    var orderNumber = document.getElementById('IDPEDIDO').value;
    do_xhr('POST', './add_order.php', 'ordinal=' + orderNumber, response => {
      console.log(response);
      document.getElementById('IDPEDIDO').value = orderNumber - -1;
    });
  }

  function changeState(state) {
    var orderNumber = document.getElementById('IDPEDIDOEDIT').value;
    do_xhr(
      'POST',
      './change_state.php',
      'ordinal=' + orderNumber + '&state=' + state,
      response => {
        console.log(response);
        document.getElementById('IDPEDIDOEDIT').value = '';
      }
    );
  }

  function do_xhr(method, addr, args, callback) {
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      console.log(this.status);
      if (this.status == 200) {
        callback(this.responseText);
      }
    };
    if (method == 'POST') {
      xhttp.open(method, addr, true);
      xhttp.setRequestHeader(
        'Content-type',
        'application/x-www-form-urlencoded'
      );
      xhttp.send(args);
    } else if (method == 'GET') {
      xhttp.open(method, addr + '?' + args, true);
      xhttp.send();
    } else {
      throw method + ' is not a valid method in this context';
    }
  }