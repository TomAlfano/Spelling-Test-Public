        <!-- Script to manage the changes to colour schemes and font changes -->
        <script>
          function colourChange(selected_colour) {
            if(selected_colour == 'default'){
              document.body.style.backgroundColor = "white";
              document.body.style.color = "black";
              var elements = document.getElementsByClassName("test_links");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.boxShadow = "10px 10px 15px #ededed";
                element.style.backgroundColor = "#f6f6f6";
                element.style.color = "black";
              }
              var elements = document.getElementsByClassName("all_test_items");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.boxShadow = "10px 10px 15px #ededed";
                element.style.backgroundColor = "#f6f6f6";
                element.style.color = "black";
              }
            } else if(selected_colour == 'cream'){
              document.body.style.backgroundColor = "#fffbe7";
              document.body.style.color = "darkblue";
              var elements = document.getElementsByClassName("test_links");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.boxShadow = "10px 10px 15px #ededed";
                element.style.backgroundColor = "#f6f6f6";
                element.style.color = "darkblue";
              }
              var elements = document.getElementsByClassName("all_test_items");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.boxShadow = "10px 10px 15px #ededed";
                element.style.backgroundColor = "#f6f6f6";
                element.style.color = "darkblue";
              }
            } else if(selected_colour == 'orange'){
              document.body.style.backgroundColor = "#ffbd66";
              document.body.style.color = "#090045";
              var elements = document.getElementsByClassName("test_links");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.boxShadow = "10px 10px 15px #db7100";
                element.style.backgroundColor = "#f6f6f6";
                element.style.color = "#090045";
              }
              var elements = document.getElementsByClassName("all_test_items");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.boxShadow = "10px 10px 15px #db7100";
                element.style.backgroundColor = "#f6f6f6";
                element.style.color = "#090045";
              }
            } else if(selected_colour == 'dark'){
              document.body.style.backgroundColor = "#242424";
              document.body.style.color = "#e3e3e3";
              var elements = document.getElementsByClassName("test_links");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.boxShadow = "10px 10px 15px black";
                element.style.backgroundColor = "#242424";
                element.style.color = "#e3e3e3";
              }
              var elements = document.getElementsByClassName("all_test_items");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.boxShadow = "10px 10px 15px black";
                element.style.backgroundColor = "#242424";
                element.style.color = "#e3e3e3";
              }
              var elements = document.getElementsByClassName("test_button");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.color = "black";
              }
            };
            localStorage.setItem('selected_colour', selected_colour);
          }

          function fontFamilyChange(selected_font){
            if(selected_font == 'arial'){
              document.body.style.fontFamily = "Arial";
              var elements = document.getElementsByClassName("dropbtn");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.fontFamily = "Arial";
              }
            } else if(selected_font == 'comic_sans'){
              document.body.style.fontFamily = "Comic Sans MS, Comic Sans, cursive";
              var elements = document.getElementsByClassName("dropbtn");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.fontFamily = "Comic Sans MS, Comic Sans, cursive";
              }
            } else if(selected_font == 'monaco'){
              document.body.style.fontFamily = "Monaco";
              var elements = document.getElementsByClassName("dropbtn");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.fontFamily = "Monaco";
              }
            };
            localStorage.setItem('selected_font', selected_font);
          }

          function fontSizeChange(selected_font_size){
            if(selected_font_size == 'default'){
              document.body.style.fontSize = "initial";
              var otherelements = document.getElementsByClassName("colourbtn");
              var elements = document.getElementsByClassName("dropbtn");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.fontSize = "initial";
              }
              for (var i = 0; i < otherelements.length; i++) {
                var otherelement = otherelements[i];
                otherelement.style.fontSize = "large";
              }
            } else if(selected_font_size == 'large'){
              document.body.style.fontSize = "large";
              var otherelements = document.getElementsByClassName("colourbtn");
              var elements = document.getElementsByClassName("dropbtn");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.fontSize = "large";
              }
              for (var i = 0; i < otherelements.length; i++) {
                var otherelement = otherelements[i];
                otherelement.style.fontSize = "large";
              }
            } else if(selected_font_size == 'xlarge'){
              document.body.style.fontSize = "x-large";

              var elements = document.getElementsByClassName("dropbtn");
              var otherelements = document.getElementsByClassName("colourbtn");
              for (var i = 0; i < elements.length; i++) {
                var element = elements[i];
                element.style.fontSize = "x-large";
              }
              for (var i = 0; i < otherelements.length; i++) {
                var otherelement = otherelements[i];
                otherelement.style.fontSize = "x-large";
              }
            };
            localStorage.setItem('selected_font_size', selected_font_size);
          }
        </script>
        <!-- Script to check for previous changes to schemes and font sizes then loads them if they are saved -->
        <script>
          try{
            var colour = localStorage.getItem("selected_colour");
            colourChange(colour);
            console.log(colour);

          } catch(err){
            console.log("Default Colour Scheme");
          };
          try{
            var font_family = localStorage.getItem("selected_font");
            fontFamilyChange(font_family);
            console.log(font_family);

          } catch(err){
            console.log("Default Font Family");
          };
          try{
            var font_size = localStorage.getItem("selected_font_size");
            fontSizeChange(font_size);
            console.log(font_size);

          } catch(err){
            console.log("Default Font Size");
          }
        </script>

      </div>
    </div>
    <footer>
      <!-- By Thomas Alfano-Hughes -->
    </footer>
  </body>
</html>
