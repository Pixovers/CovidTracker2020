        <div class="cookie-container">
             <p  class="mt-2">
                We use cookies in this website to give you the best experience on our
                site and show you relevant ads. To find out more, read our
                <a href="http://www.covidtracker2020.live/pages/blog/cookie-policy-for-covid-tracker-2020/">Cookie Policy </a> and <a href="http://www.covidtracker2020.live/pages/blog/privacy-policy-for-covid-tracker-2020/">Privacy Policy</a>.
             </p>
        
             <button class="cookie-btn">
                Okay
             </button>
        </div>
        
        <script>
            const cookieContainer = document.querySelector(".cookie-container");
            const cookieButton = document.querySelector(".cookie-btn");
            
            cookieButton.addEventListener("click", () => {
              cookieContainer.classList.remove("active"); //shh
              localStorage.setItem("cookieBannerDisplayed", "true");
            });
            
            setTimeout(() => {
              if (!localStorage.getItem("cookieBannerDisplayed")) {
                cookieContainer.classList.add("active");
              }
            }, 2000);
        </script>