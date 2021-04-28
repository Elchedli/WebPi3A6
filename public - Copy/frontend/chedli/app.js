function getMessages(){
    const requeteAjax = new XMLHttpRequest();
    // location.replace("../../test.php");
    requeteAjax.open("GET", "../../handler.php");
    requeteAjax.onload = function(){
        const resultat = JSON.parse(requeteAjax.responseText);
        console.log(resultat);
        const html = resultat.reverse().map(function(message){
            return `
                <div class="message">
                  <span class="author">${message.sender}</span> : 
                  <span class="content">${message.contenu_msg}</span>
                </div>
          `
        }).join('');
        const messages = document.querySelector('.messages');
        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;
    }
    requeteAjax.send();
}

function postMessage(event){
    event.preventDefault();
    const author = document.querySelector('#author');
    const content = document.querySelector('#content');
    const data = new FormData();
    data.append('author', author.value);
    data.append('content', content.value);
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open('POST', '../../handler.php?task=write');
    requeteAjax.onload = function(){
        content.value = '';
        content.focus();
        getMessages();
    }
    requeteAjax.send(data);
}

document.querySelector('form').addEventListener('submit', postMessage);
const interval = window.setInterval(getMessages, 3000);
getMessages();