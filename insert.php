<?php

require_once __DIR__ . '/bootstrap.php';
include 'head.php';

?>

<body>

    <div class="main-container">

        <div class="container">

            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="mb-4">
                        <i class="fas fa-user fa3x" style="color:#4a4c8e">&nbsp;</i>
                        <?php echo $trans['player one'][$lang]; ?>
                    </h2>
                    <p class="mb-0"><?php echo $trans['insert word to guess'][$lang]; ?></p>

                </div>
            </div>

            <div class="row">

                <div class="col-12 flex_center_column">

                    <form action="insert.php" method="post" class="position-relative" autocomplete="off">
                        <img class="eye-icon" src="img\eye.png" alt="eye">
                        <input type="password" class="mb-4" id="word-input" name="word" value="" onkeyup="checkInput(this.value, 4);" autofocus autocomplete="off" maxlength="26" />

                        <input type="hidden" name="ins" value="ins" />

                        <div class="text-center">
                            <button id="submit" type="submit" value="insert" disabled>
                                <i class="fas fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </form>

                </div>

                <div id="alert-container" class="absolute-insert" style="display:none">
                    <div class="alert">
                        <div>
                            <?php echo $trans['insert a word with letter only'][$lang]; ?>
                        </div>
                        <div class="alert-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <?php include 'footer.php' ?>

    <script>
        $(function() {
            
            $('.eye-icon').on('touchstart mousedown',function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $('#word-input').attr('type', 'text');
            });
            $('.eye-icon').on('touchend mouseup', function() {
                $('#word-input').attr('type', 'password');
            });

            $('form').on('submit', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                // serialize the form data
                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: 'insert-word',
                    data: formData,
                    dataType: "json",
                    success: function (res) {
                        if (res.status === 'success') {
                            window.location.href = "play-multiplayer";
                        } else {
                            alert(LANG["insert a word with letter only"][lang]);
                        }
                    },
                    error: function (res) {
                        alert(LANG["insert a word with letter only"][lang]);
                    }
                });
            });

        });
    </script>

</body>

</html>