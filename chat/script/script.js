
function messege(text){
  jQuery('#chat-result').append(text);
}

jQuery(document).ready(function () {
var socket = new WebSocket("ws://localhost:8090/chat/server.php");

socket.onopen = function () {
    messege("<div>Соединение установлено</div>>");
};

socket.onerror = function (error) {
    messege("<div> Ошибка при соединении" + (error.message ? error.message: "") + "</div>");
};

socket.onclose = function (){
    messege("<div> Соединение закрыто </div>");
};
socket.onmessage = function (event){
    var data = JSON.parse(event.data);
    messege("<div> + data.type + "-" + data.message + </div>");
};

$("#chat").on('submit',function () {
    var message = {
        chat_message:$("#chat-message").val(),
        chat_user:$("#chat-user").val(),
    };
    $("#chat-user").attr("type","hidden");
    socket.send(JSON.stringify(message));
    return false;
    });

});