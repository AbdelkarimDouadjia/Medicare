//! Sticky Header
const headerRef = document.getElementById("header");
const menuRef = document.getElementById("menu");
function handleStickyHeader() {
  if (window.scrollY > 80) {
    headerRef.classList.add("sticky__header");
  } else {
    headerRef.classList.remove("sticky__header");
  }
}

function toggleMenu() {
  menuRef.classList.toggle("show__menu");
}

window.addEventListener("scroll", handleStickyHeader);


// Tabs change
document.addEventListener("DOMContentLoaded", function () {
  // Get the buttons and tabs
  const myBookingBtn = document.getElementById("myBookingBtn");
  const profileSettingsBtn = document.getElementById("profileSettingsBtn");
  const myBookingTab = document.getElementById("myBookingTab");
  const profileSettingsTab = document.getElementById("profileSettingsTab");
  const chatTab = document.getElementById("chatTab");
  const chatBtn = document.getElementById("chatBtn");
  const createBookingTab = document.getElementById("createBookingTab");
  const createBookingBtn = document.getElementById("createBookingBtn");

  // Function to toggle tabs
  function toggleTab(tab, button) {
    myBookingTab.classList.remove("active-tab");
    profileSettingsTab.classList.remove("active-tab");
    chatTab.classList.remove("active-tab");
    createBookingTab.classList.remove("active-tab");

    tab.classList.add("active-tab");

    // Remove active-button class from all buttons
    myBookingBtn.classList.remove("active-button");
    profileSettingsBtn.classList.remove("active-button");
    chatBtn.classList.remove("active-button");
    createBookingBtn.classList.remove("active-button");

    // Add active-button class to the clicked button
    button.classList.add("active-button");
  }

  // Event listeners for button clicks
  myBookingBtn.addEventListener("click", function () {
    toggleTab(myBookingTab, myBookingBtn);
  });

  profileSettingsBtn.addEventListener("click", function () {
    toggleTab(profileSettingsTab, profileSettingsBtn);
  });

  chatBtn.addEventListener("click", function () {
    toggleTab(chatTab, chatBtn);
  });

  createBookingBtn.addEventListener("click", function () {
    toggleTab(createBookingTab, createBookingBtn);
  });
});
