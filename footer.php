     <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

     <script>
         const LANG = <?php echo json_encode($trans); ?>;
         let lang = <?php echo json_encode($_SESSION['lang']); ?>;

         $(function() {

             if (typeof(lang) === "undefined") {
                 lang = 'en';
             }
             translate(lang);

             $('[data-toggle="tooltip"]').tooltip();

             $('#change_lang').on('click', function(e) {
                 e.preventDefault();

                 if (lang == 'en') {
                     lang = 'it';
                 } else {
                     lang = 'en';
                 }

                 $.ajax({
                     type: "POST",
                     url: "change-lang",
                     data: {
                         lang: lang
                     },
                     dataType: "json",
                     success: function(res) {
                         console.log(res);
                     }
                 });

                 translate(lang);

             });
         });

         function translate(lang = 'en') {
             // Get all elements that have data-lang attribute
             $('[data-lang]').each(function() {
                 // Get the value of the data-lang attribute
                 let key = $(this).data('lang');
                 // Get the value of the data-lang attribute
                 let value = LANG[key][lang];
                 // Get what to translate
                 let placement = $(this).data('trans')
                 if (!placement) {
                     $(this).html(value);
                 } else {
                     $(this).attr(placement, value);
                     if (placement == 'title') {
                         $(this).tooltip('_fixTitle');
                     }
                 }
             });
         }

         function checkInput(value, length = '') {
             var button = document.getElementById('submit');
             const regex = /^[a-zA-Zéùàòèùì]+$/;
             var divalert = document.getElementById('alert-container');

             var match = value.match(regex);
             if (value == '') {
                 divalert.style.display = 'none';
                 button.disabled = true;
             } else if (!match) {
                 divalert.style.display = 'block';
                 button.disabled = true;
             } else if (length !== '' && value.length < length) {
                 console.log(value.length);
                 console.log(length);
                 console.log(value.length < length);
                 //  divalert.style.display = 'block';
                 button.disabled = true;
             } else {
                 divalert.style.display = 'none';
                 button.disabled = false;
             }

         }
     </script>