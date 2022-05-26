$(document).ready(function () {
    var dropdown = document.getElementsByClassName("dropdown-btn");
    
    for (let i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
          this.getElementsByTagName("i")[0].classList.add("fa-caret-down");
          this.getElementsByTagName("i")[0].classList.remove("fa-caret-up");
        } else {
          dropdownContent.style.display = "block";
          this.getElementsByTagName("i")[0].classList.add("fa-caret-up");
          this.getElementsByTagName("i")[0].classList.remove("fa-caret-down");
        }
      });
    }
});