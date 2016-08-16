var autobahn = require('autobahn');
var connection = new autobahn.Connection({
  url: 'ws://127.0.0.1:7070/',
  realm: 'realm1'
});
connection.onopen = function (session) {
  function onevent(data) {
    var message = 'New article published to category "' + data[0].category + '" : ' + data[0].title;
    var divNode = document.createElement("div");
    var textNode = document.createTextNode(message);
    divNode.appendChild(textNode);
    document.body.appendChild(divNode);
  }
  session.subscribe('keke', onevent);
};
connection.open();
