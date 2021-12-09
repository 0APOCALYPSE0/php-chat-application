// controlling possword input styles...
const passwordFields = document.querySelectorAll('.form input[type="password"]'),
toggleBtns = document.querySelectorAll('.form .field i');

if(toggleBtns !== null){
  toggleBtns.forEach((toggleBtn, index) => {
    toggleBtn.addEventListener('click', () => {
      if(passwordFields[index].type === 'password'){
        passwordFields[index].type = 'text';
        toggleBtns[index].classList.add('active');
      }else{
        passwordFields[index].type = 'password';
        toggleBtns[index].classList.remove('active');
      }
    });
  });
}

// controlling search bar styles...
const searchBar = document.querySelector('.users .search input'),
searchBtn = document.querySelector('.users .search button');

if(searchBtn !== null){
  searchBtn.onclick = () => {
    searchBar.classList.toggle('active');
    searchBar.focus();
    searchBtn.classList.toggle('active');
    searchBar.value = '';
  }
}

// sending sign up form or login form data using ajax....
const signupForm = document.querySelector('.signup form'),
      loginForm = document.querySelector('.login form'),
      form = (signupForm !== null) ? signupForm : loginForm;
let continueBtn=null, errorText=null;

if(form !== null){
  continueBtn = form.querySelector('.button input');
  errorText = form.querySelector('.error-txt');
}

if(form !== null){
  form.onsubmit = (e) => {
    e.preventDefault(); // preventing form from submtting
  }
}

if(continueBtn !== null){
  continueBtn.onclick = () => {
    // using ajax to send form data to backend
    let xhr = new XMLHttpRequest();
    let url = signupForm !== null ? 'php/signup.php' : "php/login.php";
    xhr.open('POST', url, true);
    xhr.onload = () => {
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          if(data === 'success'){
            location.href = 'users.php';
          }else{
            errorText.textContent = data;
            errorText.style.display = 'block';
          }
        }
      }
    };
    // create a formData object so we can send this form data to php using ajax call...
    let formData = new FormData(form);
    xhr.send(formData);
  }
}

//adding searchBar functionality...
if(searchBar !== null){
  searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    if(searchTerm !== ''){
      searchBar.classList.add('active');
    }else{
      searchBar.classList.remove('active');
    }
    if(searchTerm !== ''){
      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'php/search.php', true);
      xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            usersList.innerHTML = data;
          }
        }
      };
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('searchTerm='+searchTerm);
    }
  }
}

// using ajax to fetch latest list of newely added users...
const usersList = document.querySelector('.users .users-list');

if(usersList !== null){
  setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/users.php', true);
    xhr.onload = () => {
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          if(!searchBar.classList.contains('active')){
            usersList.innerHTML = data;
          }
        }
      }
    };
    xhr.send();
  }, 500);
}

//sending message to user using ajax in chat page...
const chatForm = document.querySelector('.typing-area'),
      inputField = chatForm !== null ? chatForm.querySelector('.input-field') : null,
      sendBtn = chatForm !== null ? chatForm.querySelector('button') : null;

if(chatForm !== null){
  chatForm.onsubmit = (e) => {
    e.preventDefault(); // preventing form from submtting
  }
}

if(sendBtn !== null){
  sendBtn.onclick = () => {
    // using ajax to send form data to backend
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/insert-chat.php', true);
    xhr.onload = () => {
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          inputField.value = '';
          scrollToBottom();
        }
      }
    };
    // create a formData object so we can send this form data to php using ajax call...
    let formData = new FormData(chatForm);
    xhr.send(formData);
  }
}

//fetching chats from backends and appending to .chat-box div...
const chatBox = document.querySelector('.chat-box');
if(chatBox !== null){
  setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/get-chat.php', true);
    xhr.onload = () => {
      if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          chatBox.innerHTML = data;
          if(!chatBox.classList.contains('active')){
            scrollToBottom();
          }
        }
      }
    };
    // create a formData object so we can send this form data to php using ajax call...
    let formData = new FormData(chatForm);
    xhr.send(formData);
  }, 500);
}

//user function to scroll down all the messages to bottom...
function scrollToBottom(){
  chatBox.scrollTo = chatBox.scrollHeight;
}

//stopping scrollBottom function when user trying to scroll up...
if(chatBox !== null){
  chatBox.onmouseenter = () => {
    chatBox.classList.add('active');
  }
  chatBox.onmouseleave = () => {
    chatBox.classList.remove('active');
  }
}