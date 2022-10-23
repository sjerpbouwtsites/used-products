<?php

function listFolderFiles($dir)
{
    $ffs = scandir($dir);

    array_shift($ffs);
    array_shift($ffs);

    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;


    foreach ($ffs as $ff) {
        if (in_array($ff, ['index.php', '.git'])) continue;
        echo '<li class="projecten-lijst">';
        $geen_streepje = str_replace("-", " ", $ff);

        $proj_files = scandir($dir . $ff);

        echo "<h2 class='project-name'>$geen_streepje</h2>";

        foreach ($proj_files as $index => $pf) {
            if ($index < 2) continue;
            $is_tab = preg_match('/pdf|doc|docx|gp/', $pf);
            $is_video = preg_match('/mp4|mov/', $pf);
            $is_audio = preg_match('/mp3/', $pf);
            $split_at_dot = explode('.', $pf);
            $file_name = $split_at_dot[0];
            $file_ext = $split_at_dot[1];
            if ($is_tab) {
                echo "<div class='some-wrap'>";
                echo "
                        <a class='mooie-lijst-links tab-link' target='_blank' href='/used-products/$ff/$pf'>$file_name $file_ext</a>
                        ";
                echo "</div>";
            }
            if ($is_video) {
                echo "<div class='some-wrap'>";
                echo "
            <a class='mooie-lijst-links video-link' target='_blank' href='/used-products/$ff/$pf'>$file_name $file_ext</a>
            ";
                echo "<video controls width='360'>

                <source src='/used-products/$ff/$pf'
                        type='video/$file_ext'>

            </video>";
                echo "</div>";
            }
            if ($is_audio) {
                echo "<div class='some-wrap'>";
                echo "
            <a class='mooie-lijst-links audio-link' target='_blank' href='/used-products/$ff/$pf'>$file_name $file_ext</a>
            ";
                echo "<audio controls width='360'>

                <source src='/used-products/$ff/$pf'
                        type='audio/$file_ext'>

            </audio>";
                echo "</div>";
            }
        }



        echo '</li>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Used products bronnen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cantarell&family=Fira+Sans:ital,wght@0,400;0,700;1,400;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #d96b52;
            margin: 0;
            font-family: 'Cantarell', sans-serif;
            height: 100vh;
            overflow-y: scroll;
        }

        .site-titel,
        .ondertitel {
            margin: 0;
            width: 50%;
        }

        .site-titel,
        .ondertitel {
            font-family: 'Fira Sans', sans-serif;
            color: #353535;
            font-weight: bold;
            line-height: 1;
        }

        .ondertitel {
            width: 50%;
            text-align: left;
            align-self: end;
        }

        .buitenkant {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
        }

        .binnenkant {
            width: 1600px;
            margin-top: 60px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-direction: column;
            max-width: calc(100% - 40px);
            margin-left: auto;
            margin-right: auto;
        }

        .project-name {
            font-weight: 900;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-variant: small-caps;
            color: #212121
        }

        .brood-tekst {
            color: white;
            margin: 30px auto;
            line-height: 1.15;
        }

        a {
            color: #353535;
            font-weight: bold;
            text-decoration: none;
        }

        .mooie-lijst-wrap {
            margin: 0 -20px;
            max-width: 100%;
        }

        .mooie-lijst {
            font-size: 2em;
            color: #35353566;
            display: flex;
            flex-direction: row;
            margin-left: 20px;
            margin-right: 20px;
            width: 1600px;
            max-width: calc(100% - 40px);
            justify-content: space-around;
            flex-wrap: wrap;
        }

        @media (max-width: 600px) {
            .mooie-lijst {
                font-size: 1.4em;
                padding-left: 0;
            }
        }

        video,
        audio,
        img {
            max-width: 100%;
            height: auto;
        }

        .some-wrap {
            margin-bottom: 20px;
        }

        .mooie-lijst-links {
            color: #353535;
            font-weight: bold;
            line-height: 1;
            padding-bottom: .05em;
        }

        .mooie-lijst-links:hover {
            text-decoration: underline;
        }

        .mooie-lijst-links.audio-link,
        .mooie-lijst-links.video-link {
            margin-bottom: .5em;
            display: block;
        }

        .mooie-lijst-links::before {
            content: " 🔗 "
        }
    </style>
</head>

<body>

    <div class="buitenkant">
        <div class="binnenkant">
            <h1 class='site-titel'>Used products bronnen</h1>
            <p class='ondertitel'>Voor schrijf toegang vraag Sjerp</p>

            <div class='mooie-lijst-wrap'>
                <ol class='mooie-lijst'>
                    <?php listFolderFiles(__DIR__ . "/"); ?>
                </ol>
            </div>
            <p class='brood-tekst'>
                <a href='mailto:ik@sjerpvanwouden.nl'>Mail Sjerp.</a><br><br>
                groeten Sjerp
            </p>
        </div>
    </div>

</body>

</html>