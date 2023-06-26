<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./files/style.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    </head>

    <body>
        <header>

        </header>

        <main class="que-page">
            <div class="hero">
                <div class="text">
                    <h1>Efteling Wachtijden</h1>
                </div>
                <div class="custom-shape-divider-bottom-1662291872">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                        <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                        <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                    </svg>
                </div>
            </div>



            <?php
                $images = array('hero-2.jpg', 'hero-3.jpg', 'hero-5.jpg');

                $i = rand(0, count($images)-1);
                $heroImage = $images[$i];
            ?>
            <style>
                .que-page .hero { <?php echo 'background-image: url(./files/images/'.$heroImage.');'; ?> }
            </style>

            <div class="content"> 

                <?php


                    if (true == false) {
                        $curl = curl_init();

                        curl_setopt_array($curl, [
                            CURLOPT_URL => "https://unofficial-efteling-api.p.rapidapi.com/queue",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => [
                                "X-RapidAPI-Host: unofficial-efteling-api.p.rapidapi.com",
                                "X-RapidAPI-Key: c270ff25bbmshfdb1e857975e48ap137282jsna1c2b008976b"
                            ],
                        ]);

                        $response = curl_exec($curl);
                        $err = curl_error($curl);
    
                        curl_close($curl);
    
                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
    
                            $dataArray = json_decode($response, true);
    
                            $myfile = fopen("./files/que.json", "w") or die("Unable to open file!");
                            $txt = $response;
                            fwrite($myfile, $txt);
                            fclose($myfile);
    
                            foreach ($dataArray as $item) {
                                $id = $item['id'];
                                $wait = $item['wait'];
                                $name = $item['name'];
                                
                                echo "
                                <div class='block'>
                                    <p>ID: $id</p> 
                                    <p>Name: $name</p>
                                    <p>Queue Length: ";
                                    if ($wait != "-") {    
                                        echo $wait;
                                    } else {
                                        echo "N.V.T.";
                                    }
                                    echo "</p>
                                </div>";
                            }
                        }
                    }

                    $json = file_get_contents('https://queue-times.com/nl/parks/160/queue_times.json');
                    $dataArray = json_decode($json, true);
                    
                    foreach ($dataArray['lands'] as $land) {
                        foreach ($land['rides'] as $ride) {
                            $id = $ride['id'];
                            $wait = $ride['wait_time'];
                            $name = $ride['name'];
                            $open = $ride['is_open'];
                            
                            echo "
                            <div class='block'>
                                <!--<p>ID: $id</p>-->
                                <p>$name</p><p>
                                <div>";
                                    if ($wait == "-" || $open == false) {
                                        echo "<p>Wachtrij </p>";
                                    } else {
                                        echo "<p>Wachtrij van </p>";
                                    }

                                    if ($wait == "-" || $open == false) {    
                                        echo "<p class='que-red'>N.V.T.</p>";
                                    } else if ($wait > 10) {
                                        echo "<p class='que-yellow'>".$wait." min</p>";
                                    } else if ($wait > 20) {
                                        echo "<p class='que-orange'>".$wait." min</p>";
                                    } else if ($wait > 40) {
                                        echo "<p class='que-red'>".$wait." min</p>";
                                    } else {
                                        echo "<p class='que-green'>".$wait." min</p>";
                                    }
                            echo "</div>
                            </div>";
                        }
                    }

                ?>
            </div>
        </main>
        
        <footer>

        </footer>
    </body>
</html>
