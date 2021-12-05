const passwordFields = document.querySelectorAll('.form input[type="password"]'),
toggleBtns = document.querySelectorAll('.form .field i');

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

const searchBar = document.querySelector('.users .search input'),
searchBtn = document.querySelector('.users .search button');

searchBtn.onclick = () => {
  searchBar.classList.toggle('active');
  searchBar.focus();
  searchBtn.classList.toggle('active');
}