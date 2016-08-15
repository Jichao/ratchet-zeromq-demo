var ab = require('autobahn');
var conn = new ab.Session('ws://localhost:7070',
    function() {
        conn.subscribe('keke', function(topic, data) {
            console.log('New article published to category "' + topic + '" : ' + data.title);
        });
    },
    function() {
        console.warn('WebSocket connection closed');
    },
    {'skipSubprotocolCheck': true}
);
