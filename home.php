<?php include __DIR__ . '/head.php' ?>

<body>
    <div class="main-container position-relative">

        <div class="langflag">
            <a href="#" id="change_lang"><img src="img/flag.png" alt="language"></a>
        </div>

        <div class="container position-relative">

            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 data-lang="The Hangman">The Hangman</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center">

                    <a href="play-singleplayer">
                        <button class="btn player-button" data-toggle="tooltip" data-placement="left" title="one player" data-lang="one player" data-trans="title">
                            <i class="fas fa-user"></i>
                        </button>
                    </a>

                    <a href="play-multiplayer-insert">
                        <button class="btn player-button ml-2" data-toggle="tooltip" data-placement="right" title="two players" data-lang="two players" data-trans="title">
                            <i class="fa fa-user"></i>
                            <i class="fas fa-user"></i>
                        </button>
                    </a>

                </div>
            </div>

        </div>
    </div>

    <div class="line boxshadow">
        <div class="hanged-container"><img src="img/hanged.png" alt="hanged"></div>
    </div>

    <?php include __DIR__ . '/footer.php' ?>

</body>

</html>