<?php
/*
Plugin Name: Live Sports Odds
Plugin URI: https://www.linkedin.com/in/john-bastian-dinglasan-555291170/
Update URI: https://www.linkedin.com/in/john-bastian-dinglasan-555291170/
Description: Live Sports Odds
Version: 1.0.0
Author: John Bastian Dinglasan
Author URI: https://www.linkedin.com/in/john-bastian-dinglasan-555291170/
*/

function sample_live_odds_api(){

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://odds.p.rapidapi.com/v1/odds?sport=basketball&region=uk&mkt=h2h&dateFormat=iso&oddsFormat=decimal",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: odds.p.rapidapi.com",
            "x-rapidapi-key: 34bbb5516emsh3d8082e932009a3p152bf4jsn0f7fd2c39200"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $json_array=json_decode($response,true); 

    curl_close($curl);

        ?>
            <style type="text/css">
                .team_ctn {
                    padding: 20px;
                    margin-bottom: 20px;
                    background: #27185d;
                }
                .team_ctn label {
                    color: white;
                    font-family: inherit;
                    margin: 0;
                }
                .team_one {
                    padding: 8px;
                    background: #d9433b;
                    display: flex;
                    align-items: center;
                    min-height: 44px;
                    margin-bottom:  10px;
                }
                .team_two {
                    padding: 8px;
                    background: #d9433b;
                    display: flex;
                    align-items: center;
                    min-height: 44px;
                }
                .team_ctn span {
                    color: white;
                    padding: 8px;
                }
                .team_ctn h3 {
                    color: white;
                    font-family: inherit;
                }
                .team_ctn h5 {
                    color: white;
                    font-family: inherit;
                }
                .sitess {
                    padding: 20px;
                    background: #d9433b;
                    margin-bottom: 20p;
                    border-bottom: 1px solid white;
                }
                .bookmaker_header {
                    padding-top: 24px;
                }
            </style>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            
            <div class="container">
                <div class="row odd_container">
                    <div class="col-lg-12">
                        <div class="teams">
                            <?php
                                foreach($json_array['data'] as $result)
                                {
                                    ?>
                                     <div class="team_ctn">
                                        <div class="teams_details">
                                             <h3>TEAMS</h3>
                                            <div class="team_one">
                                                <label>HOME:</label>&nbsp;&nbsp;
                                                <label><?php print_r($result['teams']['0']); ?></label>
                                            </div>  
                                            <div class="team_two">
                                                <label>AWAY:</label>&nbsp;&nbsp;
                                               <label> <?php print_r($result['teams']['1']); ?> </label>
                                            </div> 
                                        </div>
                                     

                                        <?php
                                            ?>
                                                <div class="bookmaker_header">
                                                    <h3>BOOKMAKERS</h3>
                                                </div>
                                            <?php 
                                            foreach($result['sites'] as $sites){

                                                ?>
                                                <div class="sitess">
                                                    <h5><?php print_r($sites['site_nice']); ?></h5>
                                                    <div class="home">
                                                        <label>HOME</label>
                                                        <span><?php print_r($sites['odds']['h2h'][0]); ?></span>
                                                    </div>  
                                                    <div class="away">
                                                       <label>Away</label>
                                                       <span><?php print_r($sites['odds']['h2h'][0]); ?></span>
                                                    </div>
                                                </div>
                                                <?php
                                            }

                                         ?> 
                                    </div>

                                    <?php
                                }
                            ?>      
                    </div>
                    <div class="col-lg-4">
                        
                    </div>
                </div>
            </div>

        <?php


}
add_shortcode('display_shortcode' , 'sample_live_odds_api');