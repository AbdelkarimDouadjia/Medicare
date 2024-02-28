const searchBar = document.querySelector(".messages-area .search input");
const searchBtn = document.querySelector(".messages-area .search button");

searchBtn.onclick = () => {
  searchBar.classList.toggle("active");
  searchBar.focus();
  searchBtn.classList.toggle("active");
  searchBar.value = "";
}
