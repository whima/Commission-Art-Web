//Website Theme
const ThemeButton = document.getElementById("themebutton");
const ButtonBall = document.getElementById("ButtonBall");

const LinkTheme = localStorage.getItem("theme");
if(LinkTheme === "dark"){
  document.body.classList.add(LinkTheme);
}

 const savedBall = localStorage.getItem("ballPosition");
  if (savedBall === "LTD") {
    ButtonBall.classList.add("LTD");
  }

console.log("ThemeButton =", ThemeButton);
console.log("ButtonBall =", ButtonBall);

ThemeButton.addEventListener("click", function() {
  document.body.classList.toggle("dark");

  if (document.body.classList.contains("dark")) {
  localStorage.setItem("theme", "dark");

  } else {
  localStorage.setItem("theme", ""); 
  }

  ButtonBall.classList.toggle("LTD");

  if (ButtonBall.classList.contains("LTD")) {
      localStorage.setItem("ballPosition", "LTD");
    } else {
      localStorage.setItem("ballPosition", "DTL");
    }
});

//About Page
const arrow = document.getElementById("arrow");
const pfpAbout = document.getElementById("pfpAbout");
const Rightbox_A = document.getElementById("Rightbox_A");

if(arrow) {
  arrow.addEventListener("click", () => {
    arrow.classList.toggle("active");
    pfpAbout.classList.toggle("Deactive");
    Rightbox_A.classList.toggle("center");
    });
};


//Contact Form
const ContactForm = document.getElementById("ContactForm");
const ErrorBox = document.getElementById("eLNotif");
const GreenBox = document.getElementById("WNotif");

if(ContactForm){
  ContactForm.addEventListener("submit", function(event) {
  let Validasi = true;

  const inputCheck = ContactForm.querySelectorAll("input, textarea");

  ErrorBox.style.display = "none";
  ErrorBox.textContent = "";

  GreenBox.style.display = "none";
  GreenBox.textContent = "";

  inputCheck.forEach(input => {
    const errorNotif = input.nextElementSibling;
    errorNotif.textContent = "";
    input.classList.remove("error-border");

    if (input.value.trim() === ""){
        errorNotif.textContent = `${input.name} can't be empty`;
        input.classList.add("error-border")
        Validasi = false;
    }
    });

  if(Validasi) {
    event.preventDefault();
    GreenBox.style.display = "block"
    GreenBox.textContent = "Thx For Your Request :) (Message has been sent!)"
    ContactForm.reset();
  }
  else {
    event.preventDefault();
    ErrorBox.style.display = "block";
    ErrorBox.textContent = "All form must be filled!";
  }
});
};
