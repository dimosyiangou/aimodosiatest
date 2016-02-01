
<!-- 
Demo Websocket: Client Code
-------------------------
    @Author: ANHVNSE02067
    @Website: www.nhatanh.net
    @Email: anhvnse@gmail.com
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Echo server - Websocket Demo</title>
    <style type="text/css">
    *{margin: 0; padding: 0;}
    body{
        background-color: black;
        color: white;
        font-family: monospace;
        font-size: 16px;
    }
    #screen, #input{
        padding: 10px;
        border: 1px solid #666;
        width: 650px;
        margin: 0 auto;
    }
    #screen{
        margin-top: 10px;
        height: 300px;
        scroll: auto;
    }
    #screen p{
        margin: 2px;
    }
    input, button{
        font-size: 20px;
        padding: 3px;
    }
    .client{
        color: green;
        font-weight: bold;
    }
    .server{
        color: red;
        font-weight: bold;
    }
    </style>
    <script src="jquery-1.11.0.js"></script>
    <script>
        // Client here
        var socket = null;
        var uri = "ws://localhost";
        function connect(){
            socket = new WebSocket(uri);
            if(!socket || socket == undefined) return false;
            socket.onopen = function(){
                writeToScreen('Connected to server '+uri);
            }
            socket.onerror = function(){
                writeToScreen('Error!!!');
            }
            socket.onclose = function(){
                $('#send').prop('disabled', true);
                $('#close').prop('disabled', true);
                $('#connect').prop('disabled', false);
                writeToScreen('Socket closed!');
            }
            socket.onmessage = function(e){
                writeToScreen('<span class="server">Server: </span>'+e.data);
            }
            // Enable send and close button
            $('#send').prop('disabled', false);
            $('#close').prop('disabled', false);
            $('#connect').prop('disabled', true);
        }
        function close(){
            socket.close();
        }
        function writeToScreen(msg){
            var screen = $('#screen');
            screen.append('<p>'+msg+'</p>');
            screen.animate({scrollTop: screen.height()}, 10);
        }
        function clearScreen(){
            $('#screen').html('');
        }
        function sendMessage(){
            if(!socket || socket == undefined) return false;
            var mess = $.trim($('#message').val());
            if(mess == '') return;
            writeToScreen('<span class="client">Client: </span>'+mess);
            socket.send(mess);
            // Clear input
            $('#message').val('');
        }
        $(document).ready(function(){
            $('#message').focus();
            $('#frmInput').submit(function(){
                sendMessage();
            });
            $('#connect').click(function(){
                connect();
            });
            $('#close').click(function(){
                close();
            });
            $('#clear').click(function(){
                clearScreen();
            });
        });
    </script>
</head>
<body>
    <form id="frmInput" action="" onsubmit="return false;">
        <div id="screen">
            <p>Demo echo server</p>
            <p>----------------</p>
        </div>
        <div id="input">
            <input type="text" id="message" placeholder="Message here..">
            <button type="submit" id="send" disabled>Send</button>
            <button type="button" id="connect">Connect</button>
            <button type="button" id="close" disabled>Close</button>
            <button type="button" id="clear">Clear</button>
        </div>
    </form>
</body>
</html>
