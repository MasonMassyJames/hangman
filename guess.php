<?php include __DIR__ . '/head.php'; ?>

<body>
    <div class="outer-container">

    <a href="start" class="back-home-btn"><button value="home">home</button></a>

    <main>

        <?php
        if (isset($_SESSION["word"]) || isset($word)) {  ?>

            <div class="container">

                <!-- ANCHOR INTRO -->
                <div class="row mb-4">
                    <div class="col-12 flex_center_column">
                        <h2 class="mb-0 pb-4"><i class="fas fa-user fa3x red_light">&nbsp;</i><?php echo $player ?></h2>
                        <p id="intro-msg" class="text-center mb-0"><?php echo $trans['try to guess'][$lang]; ?></p>
                    </div>
                </div>

                <!-- ANCHOR GUESS WORD LINES -->
                <div class="row mb-5 guess-word-container">
                    <div class="col-12 text-center">
                        <div class="box-guess">

                            <p id="guess-invite-msg" class="shadow-none">
                                <?php echo $trans['word to guess'][$lang]; ?>
                            </p>

                            <p id="guess-word" class="guess-word">
                                <?php echo implode(' ', $lines); ?>
                            </p>

                        </div>
                    </div>
                </div>

                <!-- ANCHOR FORM INSERT LETTER -->
                <div class="row mb-4">

                    <div class="col-12 flex_center_column">

                        <form id="form_send_letter" action="check-letter" method="post">

                            <input type="hidden" name="l" value="l" />
                            <input type="hidden" id="form_tries" name="tries" value="<?php echo $tries; ?>" />
                            <input type="hidden" id="form_lines" name="lines" value="<?php echo htmlspecialchars(json_encode($lines)); ?>" />

                            <label><?php echo $trans['insert and try'][$lang]; ?></label><br>

                            <input id="form_insert" type="text" name="letter" size="3" autocomplete="off" autofocus style="text-align: center;" maxlength="1" onkeyup="checkInput(this.value)" />&nbsp;
                            <button id="submit" class="" type="submit" value="insert" disabled><?php echo $trans['try'][$lang]; ?></button>

                        </form>

                    </div><!-- .col-12 -->
                </div>

                <!-- ANCHOR TRIES -->
                <div class="row">
                    <div class="col-12 flex_center">

                        <p class="mb-0 pr-2"><small><?php echo $trans['tries'][$lang]; ?></small></p>
                        <div class="div-tries">
                            <?php
                            for ($i = 0; $i < $tries; $i++) {
                                echo '<i class="fas fa-circle"></i> ';
                            }
                            ?>

                        </div>

                    </div>
                </div>

                <!-- ANCHOR ALERT WRONG INPUT -->
                <div id="alert-container" style="display:none">
                    <div class="alert">
                        <?php echo $trans['insert letter only'][$lang]; ?>
                    </div>
                </div>

            <?php } else {  ?>

                <h2>ERROR</h2>
                <a href="start" class="mb-5"><button>HOME</button></a>

            <?php } ?>

        </div>

            <!-- ANCHOR HANGED IMAGES -->
            <div class="line2 boxshadow">
                <div class="line2-container">
                    <img class="img-hanged2" src="img/0.png" alt="hanged">
                </div>
            </div>

    </main>

    </div>

    <?php include __DIR__ . '/footer.php'; ?>

    <script>
        // SECTION JS
        $(function() {

            let initialTries = $("#form_tries").val();

            $('#form_send_letter').on('submit', function(e) {

                e.preventDefault();
                // serialize form
                let formData = $(this).serialize();
                let url = $(this).attr('action');
                let formParent = $(this).parent();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    dataType: "json",
                    success: function(res) {

                        $('#form_insert').val('');
                        $('#form_insert').focus();
                        $('#form_tries').val(res.tries);
                        let lines = res.lines;
                        $('#form_lines').val(JSON.stringify(lines));
                        $('#guess-word').html(lines.join(' '));

                        // ANCHOR JS TRIES
                        let triesHtml = '';

                        for (let i = 0; i < res.tries; i++) {
                            triesHtml += '<i class="fas fa-circle"></i> ';
                        }

                        for (let c = 0; c < initialTries - res.tries; c++) {
                            triesHtml += '<i class="far fa-circle"></i> ';
                        }

                        $('.div-tries').html(triesHtml);

                        // ANCHOR JS IMAGES
                        $('.img-hanged2').attr('src', 'img/' + (initialTries - res.tries) + '.png');

                        // ANCHOR JS LINES - WIN - LOOSE
                        if (lines.indexOf("_") == -1) {

                            $('#submit').attr('disabled', true);
                            $('#intro-msg').html(res.tryToGuess_or_hanged_msg);
                            $('#guess-invite-msg').html(res.wordToGuess_or_wordWas_msg);
                            $('#guess-word').html(res.word);

                            let outcomeHtml = `

                                <h1><i class="far fa-smile-beam"></i>&nbsp;${LANG['you win'][lang]}</h1>
                                <a href="start"><button>${LANG['play again'][lang]}</button></a>

                            `;

                            $('form').hide();
                            formParent.html(outcomeHtml);

                        } else if (res.tries == 0) {

                            $('#submit').attr('disabled', true);

                            $('#intro-msg').html(res.tryToGuess_or_hanged_msg);
                            $('#guess-invite-msg').html(res.wordToGuess_or_wordWas_msg);
                            $('#guess-word').html(res.word);

                            let outcomeHtml = `

                                <h1><i class="far fa-sad-tear"></i>&nbsp;${LANG['you lose'][lang]}</h1>
                                <a href="start"><button>${LANG['play again'][lang]}</button></a>

                            `;

                            $('form').hide();
                            formParent.html(outcomeHtml);

                        }
                    },

                    error: function(err) {
                        console.log(err);
                    }

                }); // .ajax

            }); // .listener

        }); //.DOC READY
    </script>

</body>

</html>