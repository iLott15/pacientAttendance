
<!-- Sidebar Scripts -->
<script>

  document.addEventListener("DOMContentLoaded", function() {
      //Variables:
      let toggleSidebar = document.querySelector(".menu-btn");
      let mainSidebar = document.querySelector(".main_sidebar");
      let fullContent = document.querySelector(".wrapper-content");
      let fullFooter = document.querySelector(".main-footer");
      let footerText = document.querySelector(".footer-text");
      let bigLogo = document.querySelector(".big_logo");
      let miniLogo = document.querySelector(".mini_logo");

      toggleSidebar.addEventListener("click", function() {
          mainSidebar.classList.toggle("active");
          slideContent();
          slideFooter();
          changeLogo();
      });
      //Function Slide Content:
      function slideContent() {
        if (mainSidebar.classList.contains("active")) {
          fullContent.style.margin = "0 0 0 70px";
          
        } else {
          fullContent.style.margin = "0 0 0 200px";
        }
      }
      //Function Slide Footer:
      function slideFooter() {
        if (mainSidebar.classList.contains("active")) {
          fullFooter.style.margin = "0";
          footerText.style.margin = "0 0 0 90px";
        } else {
          fullFooter.style.margin = "0";
          footerText.style.margin = "0 0 0 220px";
        }
      }
      //Function Change Logo:
      function changeLogo() {
        if (mainSidebar.classList.contains("active")) {
          bigLogo.style.display = "none";
          miniLogo.style.display = "flex";
        } else {
          bigLogo.style.display = "flex";
          miniLogo.style.display = "none";
        }
      }

      // Chamando as funções pela primeira vez
      slideContent();
      slideFooter();
      changeLogo();
  });
</script>

<!-- ICONS -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>